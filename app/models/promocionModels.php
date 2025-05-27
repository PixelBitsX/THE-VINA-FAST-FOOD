<?php

    namespace app\models;
    use app\models\DB;

    class promocionModels extends DB{
        
        /*Registrar Promociones */
        public function registrarPromocionesModel(){

            /*Limpiar Inyección de SQL*/
            $nombre= $this->limpiarCadena($_POST['nombre_promocion']);
            $fechainicio= $this->limpiarCadena($_POST['fecha_inicio_promocion']);
            $fechafin= $this->limpiarCadena($_POST['fecha_fin_promocion']);
            $descuento= $this->limpiarCadena($_POST['descuento_promocion']);
            
            
            /*Verificar Campos obligatorios*/
            if(
                $nombre == "" || $fechainicio == "" || $fechafin == "" || $descuento == "" 
            ){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No puedes enviar el formulario con campos vacíos",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            /*Verificando que el tipo de dato y longitud del texto*/
            if($this->verificarDatos("([a-zA-ZáéíóúüÁÉÍÓÚñÑ]{5,50})", $nombre)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Nombre no válido",
                    "texto" => "El nombre no debe contener numeros ni carácteres especiales, además, debe tener un longitud de entre 5 a 50 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }else{
                /*Para comprobar que la cedula no se encuentra ya registrada */
                $check_nombre= $this->ejecutarConsulta("SELECT nombre_promocion FROM promociones WHERE nombre_promocion='$nombre'");
                if($check_nombre->rowCount()>0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "El nombre ya existente",
                    "texto" => "El nombre que está ingresando ya se encuentra registrado, por favor elija otro",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
                }
            }
            
            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{10}", $fechainicio)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha no válida",
                    "texto" => "La fecha no debe contener más de 10 digitos",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            
            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}", $fechafin)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha no válida",
                    "texto" => "La fecha no debe contener más de 10 digitos",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            
            if($this->verificarDatos("\d{2, 3}", $descuento)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Descuento no válido",
                    "texto" => "El descuento debe escribirse en porcentajes, debe tener un longitud de 3 carácteres como maximo",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            
            
            $datos_registro_promociones=[
                [
                    "campo_nombre"=>"nombre_promocion",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombre
                ],
                [
                    "campo_nombre"=>"fecha_inicio_promocion",
                    "campo_marcador"=>":Fecha_inicio",
                    "campo_valor"=>$fechainicio
                ],
                [
                    "campo_nombre"=>"fecha_fin_promocion",
                    "campo_marcador"=>":Fecha_fin",
                    "campo_valor"=>$fechafin
                ],
                [
                    "campo_nombre"=>"descuento_promocion",
                    "campo_marcador"=>":Descuento",
                    "campo_valor"=>$descuento
                ],
            ];

            $registrar_promocion= $this-> guardarDatos('promociones', $datos_registro_promociones);

            if($registrar_promocion -> rowCount()==1){
                $alerta=[
                    "tipo" => "limpiar_registrar",
                    "titulo" => "Promocion registrada",
                    "texto" => "La promocion ha sido registrado exitosamente",
                    "icono" => "success",
                ];
                
            }else{
                if(is_file($dir_fotos.$foto)){ /*verificamos que se creó */
                    chmod($dir_fotos.$foto, 0777); /*le damos permiso a la carpeta para eliminar */
                    unlink($dir_fotos.$foto); /*borramos el archivos */
                }
                
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario no registrado",
                    "texto" => "El usuario no ha sido registrado exitosamente",
                    "icono" => "error",
                ];
                
            }
            return json_encode($alerta);
        }

        /*Listar Promociones */
        public function listarPromocionesPaginador($pagina, $registros, $url, $busqueda, $orden = ""){
            /*Evitamos inyección de SQL */
            $pagina = $this->limpiarCadena($pagina);
            $registros = $this->limpiarCadena($registros);
            $url = $this->limpiarCadena($url);
            $url = APP_URL . $url . "/";
            $busqueda = $this->limpiarCadena($busqueda);
            $orden = $this->limpiarCadena($orden);
            $tabla = "";

            $pagina = (isset($pagina) && $pagina > 0) ? (int)$pagina : 1;
            $inicio = ($pagina > 0) ? ($pagina * $registros) - $registros : 0;

            /*--Verificar si viene la variable orden y si no viene dejar un orden por defecto */
            $order_by = "nombre_promocion ASC";
            if ($orden != "") {
                $order_by = $orden;
            }

            if (isset($busqueda) && $busqueda != "") {
                $consulta_datos = "SELECT * FROM promociones WHERE(
                        (id_promocion!=') AND
                        (
                        nombre_promocion LIKE '%$busqueda%' OR
                        fecha_inicio_promocion LIKE '%$busqueda%' OR
                        fecha_fin_promocion LIKE '%$busqueda%' OR
                        descuento_promocion LIKE '%$busqueda%' OR
                        detalle_promocion LIKE '%$busqueda%' OR
                        )
                    )
                    ORDER BY $order_by LIMIT $inicio, $registros";

                $consulta_total = "SELECT COUNT(id_promocion) FROM promociones WHERE(
                        (id_promocion!=') AND
                        (
                        nombre_promocion LIKE '%$busqueda%' OR
                        fecha_inicio_promocion LIKE '%$busqueda%' OR
                        fecha_fin__promocion LIKE '%$busqueda%' OR
                        descuento_promocion LIKE '%$busqueda%' OR
                        detalle_promocion LIKE '%$busqueda%' OR
                        )
                    )";
            } else {
                $consulta_datos = "SELECT * FROM promociones WHERE id_promocion!='" "'
                ORDER BY $order_by LIMIT $inicio, $registros";

                $consulta_total = "SELECT COUNT(id_promocion) FROM promociones WHERE id_promocion!='" ;
            }

            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            $total = $this->ejecutarConsulta($consulta_total);
            $total = (int)$total->fetchColumn();

            $numeroPaginas = ceil($total / $registros);

            $tabla .= '
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Finalizacion</th>
                                    <th>descuento</th>
                                    <th>Detalle</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>';

            if ($total >= 1 && $pagina <= $numeroPaginas) {
                $contador = $inicio + 1;
                $pagina_inicio = $inicio + 1;
                foreach ($datos as $filas) {
                    $tabla .= '
                        <tr>
                            <td>' . $contador . '</td>
                            <td>' . $filas['nombre_promocion'] . '</td>
                            <td>
                                <div class="row">
                                    <div class="col-auto ">
                                        <a href="' . APP_URL . 'actualizar-usuario-foto/' . $filas['id_promocion'] . '">
                    ';

                    if (is_file("app/views/fotos/" . $filas['foto_usuario'])) {
                        $tabla .= ' <img src="' . APP_URL . 'app/views/fotos/' . $filas['foto_usuario'] . '" alt="user-image" max-width="5px" class="wid-40 rounded-circle" data-bs-toggle="tooltip" title="Editar foto">';
                    } else {
                        $tabla .= ' <img src="' . APP_URL . 'app/views/fotos/default.png" alt="user-image" max-width="5px" class="wid-40 rounded-circle" data-bs-toggle="tooltip" title="Agregar foto">';
                    }

                    $tabla .= '
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h6 class="mb-0">' . $filas['nombre_promocion'] . ' ' . $filas['fecha_inicio_promocion'] . '</h6>
                                        <p class="text-muted f-12 mb-0">' . $filas['Fecha_fin_promocion'] . '</p>
                                    </div>
                                </div>
                            </td>
                            <td>' . $filas['descuento_promocion'] . '</td>
                            <td>' . $filas['detalle_promocion'] . '</td>
                            <td><span class="badge bg-light-success rounded-pill f-12">' . '</span></td>
                            <td class="text-center">
                                <ul class="list-inline me-auto mb-0">
                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Editar">

                                        <a href="' . APP_URL . 'actualizar-promocion/' . $filas['id_promocion'] . '">
                                            <i class="ti ti-edit-circle f-18"></i>
                                        </a>
                                        
                                    </li>
                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Eliminar">
                                        <form class="FormularioAjax validate-me" data-validate action="' . APP_URL . 'app/controllers/promocionController.php" method="POST" autocomplete="off">

                                            <input type="hidden" name="modulo_promocion" value="eliminar">
                                            <input type="hidden" name="id_promocion" value="' . $filas['id_promocion'] . '">
                                            <button type="submit" class="avtar avtar-xs btn-link-danger btn-pc-default">
                                                <i class="ti ti-trash f-18"></i>
                                            </button>

                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    ';
                    $contador++;
                }

                $pagina_final = $contador - 1;
            } else {
                if ($total >= 1) {
                    $tabla .= '
                        <tr>
                            <td>
                                <div class="d-grid gap-2 mt-2">
                                    <a href="' . $url . '1/"><button class="btn btn-primary" type="button">Recargar la página</button></a>
                                </div>
                            <td/>
                        </tr>';
                } else {
                    $tabla .= '
                        <tr>
                            
                                <div class="text-center">No hay registros en el sistema</div>
                            
                        </tr>';
                }
            }
            $tabla .= '
                            </tbody>
                    </table>
                </div>
            </div>
                <div class="card-footer text-center bg-light border-0">
                ';
            if ($total >= 1 && $pagina <= $numeroPaginas) {
                $tabla .= '<p class="text-center">Mostrando Promociones desde el ' . $pagina_inicio . ' al ' . $pagina_final . ' de un total de ' . $total . '</p>';
                $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 5);
            }
            $tabla .= '
                        </div>
                    </div>
                </div>';
            return $tabla;
        }

        /*Eliminar promociones */
        public function eliminarPromocionesModel(){
            
            /*Limpiar Inyección de SQL*/
            $id= $this->limpiarCadena($_POST['nombre_promocion']);

            /*hacemos la consulta */
            $datos= $this->ejecutarConsulta("SELECT * FROM promociones WHERE id_promocion= '$id'");

            /*verificamos que la promocion seleccionada exista */
            if($datos ->rowCount()<=0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "promocion no encontrada",
                    "texto" => "La promocion que ha intentado eliminar no se encuentra registrada",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();

            }else{
                $datos=$datos ->fetch();/*hacemos el arrays */
            }

            $eliminarpromocion= $this->eliminarDatos("promociones", "nombre_promocion", $id);
            if($eliminarpromocion ->rowCount()==1){ /*Para verificar si se hizo la eliminación o no */
                
                $alerta=[
                    "tipo" => "recargar",
                    "titulo" => "promocion eliminada",
                    "texto" => "La promocion de ".$datos['nombre_promocion']." ha sido eliminado con éxito",
                    "icono" => "success"
                ];
                
            }else{
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "promocion no encontrada",
                    "texto" => "La promocion no se encuentra registrada",
                    "icono" => "error"
                ];
            }
            return json_encode($alerta);
        }

        /*Actualizar promociones */
        public function actualizarPromocionesModel(){
            
            /*Limpiar Inyección de SQL*/
            $id= $this->limpiarCadena($_POST['nombre_promocion']);

            /*hacemos la consulta */
            $datos= $this->ejecutarConsulta("SELECT * FROM promociones WHERE id_promocion= '$id'");

            /*verificamos que la promocion seleccionado exista */
            if($datos ->rowCount()<=0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Promocion no encontrada",
                    "texto" => "La promocion ha intentado actualizar no se encuentra en la base de datos",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();

            }else{
                $datos=$datos ->fetch();/*hacemos el arrays */
            }

            /*Limpiar Inyección de SQL*/
            $nombre= $this->limpiarCadena($_POST['nombre_promocion']);
            $fechainicio= $this->limpiarCadena($_POST['fecha_inicio_promocion']);
            $fechafin= $this->limpiarCadena($_POST['fecha_fin_promocion']);
            $descuento= $this->limpiarCadena($_POST['descuento_promocion']);
            $detalle= $this->limpiarCadena($_POST['detalle_promocion']);
            
            /*Verificar Campos obligatorios*/
            if(
                $nombre == "" || $fechainicio == "" || $fechafin == "" 
                $descuento == "" || $detalle == "" 
            ){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No puedes enviar el formulario con campos vacíos",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            /*Verificando que el tipo de dato y longitud del texto*/
            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{5,50}", $nombre)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Nombre no válido",
                    "texto" => "El nombre no debe contener numeros ni carácteres especiales, además, debe tener un longitud de entre 5 a 50 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }else{
                /*Para comprobar que la cedula no se encuentra ya registrada */
                $check_nombre= $this->ejecutarConsulta("SELECT nombre_promocion FROM promociones WHERE nombre_promocion='$nombre'");
                if($check_nombre->rowCount()>0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "El nombre ya existente",
                    "texto" => "El nombre que está ingresando ya se encuentra registrado, por favor elija otro",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
                }
            }
            
            if($this->verificarDatos("^(\d{10}/)$", $fechainicio)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha no válida",
                    "texto" => "La fecha no debe contener más de 10 digitos",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            
            if($this->verificarDatos("^(\d{10}/)$", $fechafin)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha no válida",
                    "texto" => "La fecha no debe contener más de 10 digitos",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            
            if($this->verificarDatos("^(\d{2,3}/)$", $descuento)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Descuento no válido",
                    "texto" => "El descuento debe escribirse en porcentajes, debe tener un longitud de 3 carácteres como maximo",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            
            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{250}", $detalle)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Detalle no válido",
                    "texto" => "el detalle no debe superar los 250 caracteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            
            $datos_registro_promociones=[
                [
                    "campo_nombre"=>"nombre_promocion",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombre
                ],
                [
                    "campo_nombre"=>"fecha_inicio_promocion",
                    "campo_marcador"=>":Fecha_inicio",
                    "campo_valor"=>$fechainicio
                ],
                [
                    "campo_nombre"=>"fecha_fin_promocion",
                    "campo_marcador"=>":Fecha_fin",
                    "campo_valor"=>$fechafin
                ],
                [
                    "campo_nombre"=>"descuento_promocion",
                    "campo_marcador"=>":Descuento",
                    "campo_valor"=>$descuento
                ],
                [
                    "campo_nombre"=>"detalle_promocion",
                    "campo_marcador"=>":Detalle",
                    "campo_valor"=>$detalle
                ],
            ];
        }
    }




?>
