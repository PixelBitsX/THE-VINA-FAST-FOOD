<?php

    namespace app\models;
    use \PDO;

    /*Para verificar que el archivo con las configuraciones del servidor existe */
    if(file_exists(__DIR__ ."/../../config/server.php")){
        require_once __DIR__ ."/../../config/server.php";

    }

    /*Almacenamos las configuraciones en variables de tipo private */
    class DB{
        private $servidorDB = DB_SERVER;
        private $nombreDB = DB_NAME;
        private $userDB = DB_USER;
        private $passwordDB = DB_PASS;
        
        /*Hacemos esta función para establecer la conexión a través a la BD con la clase PDO */
        protected function conectar(){
            $conexion = new PDO (
                /*Nombre del servidor / nombre de la BD / usuario de la BD / contraseña de la BD */
                "mysql:host=" . $this->servidorDB . ";dbname=". $this->nombreDB,
                $this->userDB, $this->passwordDB);
                $conexion->exec("SET CHARACTER SET utf8");
                return $conexion;
        }

        /*Metodo para preparar y ejecutar todas las consultas del sistema */
        protected function ejecutarConsulta($consulta){
            $sql = $this-> conectar()->prepare($consulta);
            $sql->execute();
            return $sql;
        }

        /* Metodo para limpiar cadenas */
		public function limpiarCadena($cadena){

            /*Arrays con palabras no admitidas */
			$palabras=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];

            
			$cadena=trim($cadena); /*Para borrar espacios en blanco*/
			$cadena=stripslashes($cadena); /*Eliminar los paréntesis */

			foreach($palabras as $palabra){
				$cadena=str_ireplace($palabra, "", $cadena); /*elimina la palabra expecificada */
			}

			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);

			return $cadena;
		}

		/*Metodo verificar datos (expresion regular) */
		protected function verificarDatos($filtro,$cadena){
			if(preg_match("/^".$filtro."$/", $cadena)){
				return false;
            }else{
                return true;
            }
		}

        /*Metodo para guardar datos en la BD */
        protected function guardarDatos($tabla, $datos){
            $query= "INSERT INTO $tabla (";

            $C=0;
            foreach($datos as $clave){
                if($C >= 1){ $query .=",";}
                $query.= $clave["campo_nombre"];
                $C++;
            }

            $query.=") VALUES (";

            $C=0;
            foreach($datos as $clave){
                if($C >= 1){ $query .=",";}
                $query.= $clave["campo_marcador"];
                $C++;
            }

            $query.=")";

            /*conectar() retorna la conexión que preparamos con prepare para la consulta de inserción en la variable $query */
            $sql = $this->conectar()->prepare($query);

            foreach($datos as $clave){
                $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
            }

            $sql->execute();
            return $sql;

        }

        /*Metodo para seleccionar datos en la BD */
        public function seleccionarDatos($tipo, $tabla, $campo, $id){
            //limpiamos los campos de la funcion con la funcion 'limpiar cadena'
            $tipo= $this->limpiarCadena($tipo);
            $tabla= $this->limpiarCadena($tabla);
            $campo= $this->limpiarCadena($campo);
            $id= $this->limpiarCadena($id);

            //verificamos si la consulta es de todos los campos o de uno en particular
            if($tipo =="Unico"){
                $sql=$this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo = :ID");
                $sql -> bindParam(":ID", $id);

            }elseif($tipo="Normal"){
                $sql= $this-> conectar()->prepare("SELECT $campo FROM $tabla");
            }

            $sql->execute(); //ejecutamos la consulta

            return $sql; 
        }

        /*Metodo para guardar datos en la BD */
        protected function actualizarDatos($tabla, $datos, $condicion){
            
            //comenzamos la consulta SQL
            $query= "UPDATE $tabla SET ";

            //recorremos el arrays con los campos de la misma
            $C=0;
            foreach($datos as $clave){
                if($C >= 1){ $query .=",";}
                $query.= $clave["campo_nombre"] ."=".  $clave["campo_marcador"];
                $C++;
            }

            $query.=" WHERE ". $condicion["condicion_campo"] ."=". $condicion["condicion_marcador"];

            //la preparamos para evitar la inyeccion de sql
            $sql= $this-> conectar()->prepare($query);

            //recorremos el array con la condicion de la misma
            foreach($datos as $clave){
                $sql-> bindParam($clave["campo_marcador"], $clave["campo_valor"]);
                $C++;
            }

            $sql-> bindParam($condicion["condicion_marcador"], $condicion["condicion_valor"]);
            $sql->execute(); //ejecutamos la consulta

            return $sql; 
            
        }

        /*Metodo para eliminar datos en la BD */
        protected function eliminarDatos($tabla, $campo, $id){
            $sql=$this->conectar()->prepare("DELETE FROM $tabla WHERE $campo = :id");
            $sql->bindParam(":id", $id);

            $sql->execute(); //ejecutamos la consulta

            return $sql; 

        }

        /*Metodo para generar la botonera de las listas de forma dinámica datos en la BD */
        protected function paginadorTablas($pagina, $numeroPagina, $url, $botones){
            $tabla='<nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">';

                        //para comprobar si estamos en la página 1 dpara desabilitar el boton de anterior
                        if($pagina <= 1){
                            $tabla.='<li class="page-item disabled"><a class="page-link" href="#!">Anterior</a></li>';
                        }
                        else{
                            $tabla.='
                                    <li class="page-item"><a class="page-link" href="'.$url.($pagina-1).'">Anterior</a></li>
                                    <li class="page-item"><a class="page-link" href="'.$url.'1/">1</a></li>
                                    <li>...</li>
                            ';
                        }

                        $ci=0;
                        for($i=$pagina; $i <= $numeroPagina; $i++){

                            if($ci >= $botones){
                                break;
                            }

                            if($pagina==$i){
                                $tabla.='<li class="page-item active"><a class="page-link" href="'.$url.$i.'/">'.$i.'</a></li>';
                                
                            }else{
                                $tabla.='<li class="page-item"><a class="page-link" href="'.$url.$i.'/">'.$i.'</a></li>';
                            }
                            $ci++;
                        }

                        if($pagina == $numeroPagina){
                            $tabla.='
                                    <li class="page-item disabled"><a class="page-link" href="#!">Siguiente</a></li>
                            ';
                        }else{
                            $tabla.='
                                <li>...</li>
                                <li class="page-item"><a class="page-link" href="'.$url.$numeroPagina.'/">'.$numeroPagina.'</a></li>
                                <li class="page-item"><a class="page-link" href="'.$url.($pagina+1).'">Siguiente</a></li>
                            ';
                        }

                        $tabla.='
                                </ul>
                            </nav>
                                ';

            return $tabla;
                        
        }

        

    }
