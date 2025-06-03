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
            $detalle= $this->limpiarCadena($_POST['detalle_promocion']);   
            
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
            if($this->verificarDatos("^[a-zA-ZáéíóúüÁÉÍÓÚñÑ\s]{5,50}$", $nombre)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Nombre no válido",
                    "texto" => "El nombre no debe contener numeros ni carácteres especiales, además, debe tener un longitud de entre 5 a 50 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }else{
                /*Para comprobar que el nombre no se encuentra registrado */
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

            $fechaInicioValida = \DateTime::createFromFormat('Y-m-d', $fechainicio);
            if ($fechaInicioValida === false || $fechaInicioValida->format('Y-m-d') !== $fechainicio) {
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha de inicio no válida",
                    "texto" => "La fecha de inicio no debe ser luego de la fecha de finalización.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            $fechaFinValida = \DateTime::createFromFormat('Y-m-d', $fechafin);
            if ($fechaFinValida === false || $fechaFinValida->format('Y-m-d') !== $fechafin) {
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha de finalización no válida",
                    "texto" => "La fecha de finalización debe ser una fecha posterior a la de inicio.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            // --- VALIDACIÓN ADICIONAL: La fecha de fin no puede ser anterior a la fecha de inicio ---
            if ($fechaInicioValida > $fechaFinValida) {
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fechas inválidas",
                    "texto" => "La fecha de finalización no puede ser anterior a la fecha de inicio.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }
            
            
            if($this->verificarDatos("^\d{2,3}$", $descuento)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Descuento no válido",
                    "texto" => "El descuento debe escribirse en porcentajes, debe tener un longitud de 3 carácteres como maximo",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            if ($detalle != "") {
                if ($this->verificarDatos("^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9\s]{0,255}$", $detalle)) {
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Detalle no válido",
                    "texto" => "el detalle no debe superar los 255 caracteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
                }
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

            $registrar_promocion= $this-> guardarDatos('promociones', $datos_registro_promociones);

            if($registrar_promocion -> rowCount()==1){
                $alerta=[
                    "tipo" => "limpiar_registrar",
                    "titulo" => "Promocion registrada",
                    "texto" => "La promocion ha sido registrado exitosamente",
                    "icono" => "success",
                ];
                
            }else{
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Promocion no registrada",
                    "texto" => "La promocion no se registró exitosamente",
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
                $consulta_datos = "SELECT * FROM promociones WHERE (
                    nombre_promocion LIKE '%$busqueda%' OR
                    fecha_inicio_promocion LIKE '%$busqueda%' OR
                    fecha_fin_promocion LIKE '%$busqueda%' OR
                    descuento_promocion LIKE '%$busqueda%' OR
                    detalle_promocion LIKE '%$busqueda%'
                ) ORDER BY $order_by LIMIT $inicio, $registros";

                $consulta_total = "SELECT COUNT(id_promocion) FROM promociones WHERE (
                    nombre_promocion LIKE '%$busqueda%' OR
                    fecha_inicio_promocion LIKE '%$busqueda%' OR
                    fecha_fin_promocion LIKE '%$busqueda%' OR
                    descuento_promocion LIKE '%$busqueda%' OR
                    detalle_promocion LIKE '%$busqueda%'
                )";
            } else {
                $consulta_datos = "SELECT * FROM promociones ORDER BY $order_by LIMIT $inicio, $registros";

                $consulta_total = "SELECT COUNT(id_promocion) FROM promociones";
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
                                    <th>Descuento</th>
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
                            <td>' . $filas['fecha_inicio_promocion'] . '</td>
                            <td>' . $filas['fecha_fin_promocion'] . '</td>
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
                        </tr>';
                    $contador++;
                }

                $pagina_final = $contador - 1;

            } else {
                if ($total >= 1) {
                    $tabla .= '
                                <tr>
                                    <td colspan="7">
                                        <div class="d-grid gap-2 mt-2">
                                            <a href="' . $url . '1/"><button class="btn btn-primary" type="button">Recargar la página</button></a>
                                        </div>
                                    </td>
                                </tr>';
                } else {
                    $tabla .= '
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center">No hay registros en el sistema</div>
                                    </td>
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
                            </div>';
            return $tabla;
        }

        /*Eliminar promociones */
        public function eliminarPromocionesModel(){
            
            /*Limpiar Inyección de SQL*/
            $id= $this->limpiarCadena($_POST['id_promocion']);

            /*hacemos la consulta */
            $datos= $this->ejecutarConsulta("SELECT * FROM promociones WHERE id_promocion= '$id'");

            /*verificamos que la promocion seleccionada exista */
            if($datos ->rowCount()<=0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Error al eliminar",
                    "texto" => "La promocion que ha intentado eliminar no se Pudo eliminar de la base de datos",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();

            }else{
                $datos=$datos ->fetch();/*hacemos el arrays */
            }

            $eliminarpromocion= $this->eliminarDatos("promociones", "id_promocion", $id);
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
            $id_promocion = $this->limpiarCadena($_POST['id_promocion']); 

            $check_promocion = $this->ejecutarConsulta("SELECT * FROM promociones WHERE id_promocion = '$id_promocion'");

            /*Verificamos que la promoción seleccionada exista */
            if($check_promocion->rowCount() <= 0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Promoción no encontrada",
                    "texto" => "La promoción que ha intentado actualizar no se encuentra en la base de datos.",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            } else {
                $datos_promocion_original = $check_promocion->fetch();/*Hacemos el array */
            }

            /*Limpiar Inyección de SQL - Obtener los nuevos datos del formulario*/
            $nombre= $this->limpiarCadena($_POST['nombre_promocion']);
            $fecha_inicio = $this->limpiarCadena($_POST['fecha_inicio_promocion']);
            $fecha_fin = $this->limpiarCadena($_POST['fecha_fin_promocion']);
            $descuento = $this->limpiarCadena($_POST['descuento_promocion']);
            $detalle = $this->limpiarCadena($_POST['detalle_promocion']);
            
            /*Verificar Campos obligatorios*/
            if(
                $nombre == "" || $fecha_inicio == "" || $fecha_fin == "" || $descuento == ""
            ){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No puedes enviar el formulario con campos obligatorios vacíos.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            /*Verificación de Formatos y Duplicados*/
            if($this->verificarDatos("^[a-zA-ZáéíóúüÁÉÍÓÚñÑ\s]{5,50}$", $nombre)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Nombre no válido",
                    "texto" => "El nombre no debe contener números ni caracteres especiales, y debe tener una longitud de entre 5 a 50 caracteres.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            } else {
                // Comprobar si el NUEVO nombre ya existe, PERO NO si es el mismo nombre ORIGINAL de esta promoción
                if (strtolower($nombre) != strtolower($datos_promocion_original['nombre_promocion'])) {
                    $check_nombre = $this->ejecutarConsulta("SELECT nombre_promocion FROM promociones WHERE nombre_promocion='$nombre'");
                    if($check_nombre->rowCount() > 0){
                        $alerta=[
                            "tipo" => "simple",
                            "titulo" => "El nombre ya existe",
                            "texto" => "El nombre que está ingresando ya se encuentra registrado para otra promoción, por favor elija otro.",
                            "icono" => "error",
                        ];
                        return json_encode($alerta);
                        exit();
                    }
                }
            }
            
            if($this->verificarDatos("^\d{4}-\d{2}-\d{2}$", $fecha_inicio)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha de inicio no válida",
                    "texto" => "El formato de la fecha de inicio debe ser YYYY-MM-DD.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }
            
            if($this->verificarDatos("^\d{4}-\d{2}-\d{2}$", $fecha_fin)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha de fin no válida",
                    "texto" => "El formato de la fecha de fin debe ser YYYY-MM-DD.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("^\d{1,3}$", $descuento)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Descuento no válido",
                    "texto" => "El descuento debe ser un número de 1 a 3 dígitos (ej. 5, 50, 100) sin caracteres especiales.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }
            
            if($this->verificarDatos("^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9\s]{0,255}$", $detalle)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Detalle no válido",
                    "texto" => "El detalle no debe superar los 255 caracteres y solo puede contener letras y espacios.",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            /*Hacemos el Array*/
            $datos = [
                [
                    "campo_nombre" => "nombre_promocion",
                    "campo_marcador" => ":Nombre",
                    "campo_valor" => $nombre
                ],
                [
                    "campo_nombre" => "fecha_inicio_promocion",
                    "campo_marcador" => ":Fecha_inicio",
                    "campo_valor" => $fecha_inicio
                ],
                [
                    "campo_nombre" => "fecha_fin_promocion",
                    "campo_marcador" => ":Fecha_fin",
                    "campo_valor" => $fecha_fin
                ],
                [
                    "campo_nombre" => "descuento_promocion",
                    "campo_marcador" => ":Descuento",
                    "campo_valor" => $descuento
                ],
                [
                    "campo_nombre" => "detalle_promocion",
                    "campo_marcador" => ":Detalle",
                    "campo_valor" => $detalle
                ]
            ];

            $condicion = [
                "condicion_campo" => "id_promocion",
                "condicion_marcador" => ":id_promocion",
                "condicion_valor" => $id_promocion
            ];

            $actualizar_promocion = $this->actualizarDatos(
                "promociones",
                $datos,
                $condicion
            );

            /*Verificar si la actualización fue exitosa*/
            if($actualizar_promocion){
                if($actualizar_promocion->rowCount() == 1){
                    $alerta=[
                        "tipo" => "redireccionar",
                        "url" => APP_URL . "gestionar-promociones",
                        "titulo" => "Promoción actualizada",
                        "texto" => "La promoción **".$nombre."** ha sido actualizada exitosamente.",
                        "icono" => "success",
                    ];
                } else {
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "No se pudo actualizar",
                        "texto" => "No se realizó ningún cambio o hubo un problema al actualizar la promoción.",
                        "icono" => "info",
                    ];
                }
            } else {
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Error interno del servidor",
                    "texto" => "No se pudo procesar la actualización. Por favor, intente de nuevo más tarde o contacte al soporte.",
                    "icono" => "error",
                ];
            }
            return json_encode($alerta);
        }

        /*seleccionar promociones*/
        public function seleccionarDatosPromocion($id_promocion) {
        $conexion = $this->conectar();
        $query = "SELECT * FROM promociones WHERE id_promocion = ?";
        $datos = $conexion->prepare($query);
        $datos->bindParam(1, $id_promocion, \PDO::PARAM_INT);
        $datos->execute();
        return $datos;
        }
    }
?>
