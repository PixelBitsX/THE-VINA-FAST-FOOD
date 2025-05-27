<?php

    namespace app\models;
    use app\models\DB;

    class promocionModels extends DB{
        
        /*Registrar usuarios */
        public function registrarPromocionModel(){

            /*Limpiar Inyección de SQL*/
            $nombre= $this->limpiarCadena($_POST['nombre_promocion']);
            $fecha_inicio= $this->limpiarCadena($_POST['fecha_inicio_promocion']);
            $fecha_fin= $this->limpiarCadena($_POST['fecha_fin_promocion']);
            $descuento= $this->limpiarCadena($_POST['descuento_promocion']);
            $detalle= $this->limpiarCadena($_POST['detalle_promocion']);

            
            /*Verificar Campos obligatorios*/
            if(
                $nombre == "" || $fecha_inicio == "" || $fecha_fin == "" || $descuento == "" ||
                $detalle == ""
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
            if($this->verificarDatos("^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$", $nombre)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Cédula no válida",
                    "texto" => "El nombre no debe contener numeros ni carácteres especiales, tampoco puede superar longitud de 30 letras",
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
                    "titulo" => "Nombre existente",
                    "texto" => "El nombre está ingresando ya se encuentra registrado, por favor elija otro",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
                }
            }
            if($this->verificarDatos("^\d{10}/", $fecha_inicio)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Fecha Invalida",
                    "texto" => "El formato de la fecha indicada es incorrecta",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            if($this->verificarDatos("^\d{10}/", $fecha_fin)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "El formato de la fecha es invalida",
                    "texto" => "El apellido no debe contener números ni caracteres especiales, además, debe tener un longitud de entre 3 a 30 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            if($this->verificarDatos("\d{2,3}", $descuento)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Formato invalido",
                    "texto" => "el formato debe estar expresado en porcetaje",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{250}", $detalle)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Limite de escritura superado",
                    "texto" => "No debe superar el limite de 250 caracteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }

            /*Inicio de los arrays de los datos obtenidos*/
            $datos_registro_promociones=[
                [
                    "campo_nombre"=>"nombre_promocion",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombre
                ],
                [
                    "campo_nombre"=>"fecha_inicio_promocion",
                    "campo_marcador"=>":FechaInicio",
                    "campo_valor"=>$fecha_inicio
                ],
                [
                    "campo_nombre"=>"fecha_fin_promocion",
                    "campo_marcador"=>":FechaFin",
                    "campo_valor"=>$fecha_fin
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
                    "texto" => "La promocion ha sido registrada exitosamente",
                    "icono" => "success",
                ];
                
            }else{
                    $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Promocion no registrada",
                    "texto" => "La promocion no fue registrada",
                    "icono" => "error",
                ];
                
            }
            return json_encode($alerta);
        }

        /*Listar usuarios */
        public function listarPromocionPaginador($pagina, $registros, $url, $busqueda, $orden = ""){
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
            $order_by = "nombre_usuario ASC";
            if ($orden != "") {
                $order_by = $orden;
            }

            if (isset($busqueda) && $busqueda != "") {
                $consulta_datos = "SELECT * FROM usuarios WHERE(
                        (id_usuario!='" . $_SESSION['id'] . "' AND id_usuario!='1') AND
                        (
                        nombre_usuario LIKE '%$busqueda%' OR
                        apellido_usuario LIKE '%$busqueda%' OR
                        correo_usuario LIKE '%$busqueda%' OR
                        telefono_usuario LIKE '%$busqueda%' OR
                        rol_usuario LIKE '%$busqueda%' OR
                        usuario_usuario LIKE '%$busqueda%' 
                        )
                    )
                    ORDER BY $order_by LIMIT $inicio, $registros";

                $consulta_total = "SELECT COUNT(id_usuario) FROM usuarios WHERE(
                        (id_usuario!='" . $_SESSION['id'] . "' AND id_usuario!='1') AND
                        (
                        nombre_usuario LIKE '%$busqueda%' OR
                        apellido_usuario LIKE '%$busqueda%' OR
                        correo_usuario LIKE '%$busqueda%' OR
                        telefono_usuario LIKE '%$busqueda%' OR
                        rol_usuario LIKE '%$busqueda%' OR
                        usuario_usuario LIKE '%$busqueda%' 
                        )
                    )";
            } else {
                $consulta_datos = "SELECT * FROM usuarios WHERE id_usuario!='" . $_SESSION['id'] . "' AND
                    id_usuario!='1' ORDER BY $order_by LIMIT $inicio, $registros";

                $consulta_total = "SELECT COUNT(id_usuario) FROM usuarios WHERE id_usuario!='" . $_SESSION['id'] . "' AND
                    id_usuario!='1'";
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
                                    <th>Cédula</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Nombre de usuario</th>
                                    <th>Rol</th>
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
                            <td>' . $filas['cedula_usuario'] . '</td>
                            <td>
                                <div class="row">
                                    <div class="col-auto ">
                                        <a href="' . APP_URL . 'actualizar-usuario-foto/' . $filas['id_usuario'] . '">
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
                                        <h6 class="mb-0">' . $filas['nombre_usuario'] . ' ' . $filas['apellido_usuario'] . '</h6>
                                        <p class="text-muted f-12 mb-0">' . $filas['correo_usuario'] . '</p>
                                    </div>
                                </div>
                            </td>
                            <td>' . $filas['telefono_usuario'] . '</td>
                            <td>' . $filas['usuario_usuario'] . '</td>
                            <td><span class="badge bg-light-success rounded-pill f-12">' . $filas['rol_usuario'] . '</span></td>
                            <td class="text-center">
                                <ul class="list-inline me-auto mb-0">
                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Editar">

                                        <a href="' . APP_URL . 'actualizar-usuario/' . $filas['id_usuario'] . '">
                                            <i class="ti ti-edit-circle f-18"></i>
                                        </a>
                                        
                                    </li>
                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Eliminar">
                                        <form class="FormularioAjax validate-me" data-validate action="' . APP_URL . 'app/controllers/usuarioController.php" method="POST" autocomplete="off">

                                            <input type="hidden" name="modulo_usuario" value="eliminar">
                                            <input type="hidden" name="id_usuario" value="' . $filas['id_usuario'] . '">
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
                $tabla .= '<p class="text-center">Mostrando usuarios desde el ' . $pagina_inicio . ' al ' . $pagina_final . ' de un total de ' . $total . '</p>';
                $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 5);
            }
            $tabla .= '
                        </div>
                    </div>
                </div>';
            return $tabla;
        }

        /*Eliminar usuarios */
        public function eliminarUsuarioModel(){
            
            /*Limpiar Inyección de SQL*/
            $id= $this->limpiarCadena($_POST['id_usuario']);

            /*Verificamos que no sea el superusuario */
            if($id==1){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario inválido",
                    "texto" => "El usuario principal del sistema no se puede eliminar",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            /*hacemos la consulta */
            $datos= $this->ejecutarConsulta("SELECT * FROM usuarios WHERE id_usuario= '$id'");

            /*verificamos que el usuario seleccionado exista */
            if($datos ->rowCount()<=0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario no encontrado",
                    "texto" => "El usuario que ha intentado eliminar no se encuentra en la base de datos",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();

            }else{
                $datos=$datos ->fetch();/*hacemos el arrays */
            }

            $eliminarUsuario= $this->eliminarDatos("usuarios", "id_usuario", $id);
            if($eliminarUsuario ->rowCount()==1){ /*Para verificar si se hizo la eliminación o no */
                
                if(is_file("../views/fotos/".$datos['foto_usuario'])){ /*verificamos que se creó */
                    chmod("../views/fotos/".$datos['foto_usuario'], 0777); /*le damos permiso a la carpeta para eliminar */
                    unlink("../views/fotos/".$datos['foto_usuario']); /*borramos el archivos */
                }
                
                $alerta=[
                    "tipo" => "recargar",
                    "titulo" => "Usuario eliminado",
                    "texto" => "El usuario de ".$datos['nombre_usuario']." ".$datos['apellido_usuario']." ha sido eliminado con éxito",
                    "icono" => "success"
                ];
                
            }else{
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario no encontrado",
                    "texto" => "El usuario no existe en la Base de Datos",
                    "icono" => "error"
                ];
            }
            return json_encode($alerta);
        }

        /*Actualizar usuarios */
        public function actualizarUsuarioModel(){
            
            /*Limpiar Inyección de SQL*/
            $id= $this->limpiarCadena($_POST['id_usuario']);

            /*hacemos la consulta */
            $datos= $this->ejecutarConsulta("SELECT * FROM usuarios WHERE id_usuario= '$id'");

            /*verificamos que el usuario seleccionado exista */
            if($datos ->rowCount()<=0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario no encontrado",
                    "texto" => "El usuario que ha intentado actualizar no se encuentra en la base de datos",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();

            }else{
                $datos=$datos ->fetch();/*hacemos el arrays */
            }
            
            $usuario_admin= $this->limpiarCadena($_POST['usuario_admin']);
            $contrasena_admin= $this->limpiarCadena($_POST['contrasena_admin']);

            if($usuario_admin == "" || $contrasena_admin == ""){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Campos del administrador vacíos",
                    "texto" => "No puedes enviar el formulario con campos de contraseña y usuario del administrador vacíos",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            /*Verificando que el tipo de dato y longitud del texto*/
            if($this->verificarDatos("(?=.*[0-9].*[0-9])(?=.{8,}).*", $usuario_admin)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario del administrador no válido",
                    "texto" => "El usuario del administrador no debe contener carácteres especiales, debe tener un longitud de 8 a 13 carácteres y debe contener al menos dos digitos al final de la contraseña",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            if($this->verificarDatos("(?=(?:[^a-zA-Z]*[a-zA-Z]){5})(?=(?:[^\d]*\d){2})(?=(?:[^$*+%&]*[$*+%&]){1})[a-zA-Z\d$*+%&]{8,15}", $contrasena_admin)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Contraseña del administrador no válida",
                    "texto" => "La contraseña del administrador debe contener mínimo 5 letras, 2 carácteres de tipo numeral y un caracter especial($*+%&)",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }

            /*verificamos que el administrador esté registrado en la base de datos */
            $check_admin= $this->ejecutarConsulta("SELECT * FROM usuarios WHERE 
                usuario_usuario='$usuario_admin' AND id_usuario='". $_SESSION['id']."' ");

            if($check_admin->rowCount()==1){
                $check_admin=$check_admin->fetch();

                if(
                    $check_admin['usuario_usuario'] != $usuario_admin ||
                    !password_verify($contrasena_admin, $check_admin['contrasena_usuario'])
                ){
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "Usuario o contraseña incorrectos",
                        "texto" => "El usuario o contraseña del administrador son incorrectos",
                        "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
                }

            }else{
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario del admin no existe",
                    "texto" => "El usuario del administrador es incorrecto",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            /*Limpiar Inyección de SQL*/
            $cedula= $this->limpiarCadena($_POST['usuario_cedula']);
            $nombre= $this->limpiarCadena($_POST['usuario_nombre']);
            $apellido= $this->limpiarCadena($_POST['usuario_apellido']);
            $correo= $this->limpiarCadena($_POST['usuario_correo']);
            $telefono= $this->limpiarCadena($_POST['usuario_telefono']);
            $rol= $this->limpiarCadena($_POST['usuario_rol']);
            $usuario= $this->limpiarCadena($_POST['usuario_usuario']);
            $contrasena1= $this->limpiarCadena($_POST['usuario_contrasena1']);
            $contrasena2= $this->limpiarCadena($_POST['usuario_contrasena2']);

            
            /*Verificar Campos obligatorios*/
            if(
                $cedula == "" || $nombre == "" || $apellido == "" || $correo == "" || 
                $rol == "" || $telefono == "" || $usuario == "" 
            ){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No puedes enviar el formulario con los campos del usuario vacíos",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            if($datos['cedula_usuario'] != $cedula){
                /*Verificando que el tipo de dato y longitud del texto*/
                if($this->verificarDatos("(\d{7,9})", $cedula)){
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "Cédula no válida",
                        "texto" => "La cédula no debe contener letras ni carácteres especiales, además, debe tener un longitud de entre 7 a 9 carácteres",
                        "icono" => "error",
                        ];
                        return json_encode($alerta);
                        exit();
                }else{
                    /*Para comprobar que la cedula no se encuentra ya registrada */
                    $check_cedula= $this->ejecutarConsulta("SELECT cedula_usuario FROM usuarios WHERE cedula_usuario='$cedula'");
                    if($check_cedula->rowCount()>0){
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "Cedula ya existente",
                        "texto" => "La cedula que está ingresando ya se encuentra registrada dentro de la base de datos del sistema, por favor elija otra",
                        "icono" => "error",
                        ];
                        return json_encode($alerta);
                        exit();
                    }
                }
            }

            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}", $nombre)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Nombre no válido",
                    "texto" => "El nombre no debe contener números ni caracteres especiales, además, debe tener un longitud de entre 3 a 30 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }

            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}", $apellido)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Apellido no válido",
                    "texto" => "El apellido no debe contener números ni caracteres especiales, además, debe tener un longitud de entre 3 a 30 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }

            if($this->verificarDatos("\d{11}", $telefono)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Teléfono no válido",
                    "texto" => "El teléfono no debe contener letras ni carácteres especiales, además, debe tener un longitud de 11 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }

            if($datos['correo_usuario'] != $correo){
                if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    $check_correo= $this->ejecutarConsulta("SELECT correo_usuario FROM usuarios WHERE correo_usuario='$correo'");
                    if($check_correo->rowCount()>0){
                        $alerta=[
                            "tipo" => "simple",
                            "titulo" => "Correo ya existente",
                            "texto" => "El correo que está ingresando ya se encuentra registrado dentro de la base de datos del sistema, por favor elija otro",
                            "icono" => "error",
                            ];
                            return json_encode($alerta);
                            exit();
                    }
                }else{
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "Correo no válido",
                        "texto" => "El correo no debe contener carácteres especiales a excepción del @ y el punto, además, debe tener un longitud de 5 a 50 carácteres. Su terminación debe ser en gmail|hotmail|outlook|yahoo",
                        "icono" => "error",
                        ];
                        return json_encode($alerta);
                        exit();
                }
            }
            if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,13}", $rol)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Rol no seleccionado",
                    "texto" => "Debe elegir entre alguna de los dos opciones de rol para el usuario",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }
            if($this->verificarDatos("\d{11}", $telefono)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Teléfono no válido",
                    "texto" => "El teléfono no debe contener letras ni carácteres especiales, además, debe tener un longitud de 11 carácteres",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }

            if($contrasena1 !="" || $contrasena2 != ""){

                if($this->verificarDatos("(?=(?:[^a-zA-Z]*[a-zA-Z]){5})(?=(?:[^\d]*\d){2})(?=(?:[^$*+%&]*[$*+%&]){1})[a-zA-Z\d$*+%&]{8,15}", $contrasena1)){
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "Contraseña no válida",
                        "texto" => "Las contraseñas deben contener mínimo 5 letras, 2 carácteres de tipo numeral y un caracter especial($*+%&)",
                        "icono" => "error",
                        ];
                    return json_encode($alerta);
                    exit();

                }else{

                    if($contrasena1 != $contrasena2){
                        $alerta=[
                            "tipo" => "simple",
                            "titulo" => "Las contraseñas no coinciden",
                            "texto" => "Ambas contraseñas deben ser iguales para poder actualizar el usuario",
                            "icono" => "error",
                            ];
                        return json_encode($alerta);
                        exit();

                    }else{
                        /*Usamos este metodo para procesar e incriptar la contraseña */
                        $contrasena=password_hash($contrasena1, PASSWORD_BCRYPT, ["cost"=>10]);
                    }
                    
                }
                
            }else{
                $contrasena= $datos['contrasena_usuario'];
            }

            if($this->verificarDatos("(?=.*[0-9].*[0-9])(?=.{8,}).*", $usuario)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario no válido",
                    "texto" => "El usuario no debe contener carácteres especiales, debe tener un longitud de 8 a 13 carácteres y debe contener al menos dos digitos al final de la contraseña",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }else{
                /*verificamos que el usuario no esté registrado en la base de datos */
                if($datos['usuario_usuario'] != $usuario){
                    $check_usuario= $this->ejecutarConsulta("SELECT usuario_usuario FROM usuarios WHERE usuario_usuario='$usuario'");
                    if($check_usuario->rowCount()>0){
                        $alerta=[
                            "tipo" => "simple",
                            "titulo" => "Usuario ya existente",
                            "texto" => "El usuario que está ingresando ya se encuentra registrado dentro de la base de datos del sistema, por favor elija otro",
                            "icono" => "error",
                            ];
                        return json_encode($alerta);
                        exit();
                    }
                }
            }

            $datos_actualizacion_usuarios=[
                [
                    "campo_nombre"=>"cedula_usuario",
                    "campo_marcador"=>":cedula",
                    "campo_valor"=>$cedula
                ],
                [
                    "campo_nombre"=>"nombre_usuario",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombre
                ],
                [
                    "campo_nombre"=>"apellido_usuario",
                    "campo_marcador"=>":Apellido",
                    "campo_valor"=>$apellido
                ],
                [
                    "campo_nombre"=>"correo_usuario",
                    "campo_marcador"=>":Correo",
                    "campo_valor"=>$correo
                ],
                [
                    "campo_nombre"=>"telefono_usuario",
                    "campo_marcador"=>":Telefono",
                    "campo_valor"=>$telefono
                ],
                [
                    "campo_nombre"=>"rol_usuario",
                    "campo_marcador"=>":Rol",
                    "campo_valor"=>$rol
                ],
                [
                    "campo_nombre"=>"usuario_usuario",
                    "campo_marcador"=>":Usuario",
                    "campo_valor"=>$usuario
                ],
                [
                    "campo_nombre"=>"contrasena_usuario",
                    "campo_marcador"=>":Contrasena",
                    "campo_valor"=>$contrasena
                ]
            ];
            $condicion=[
                "condicion_campo"=>"id_usuario",  //  ¡Correcto!
                "condicion_marcador"=>":id",
                "condicion_valor"=>$id
            ];

            if($this-> actualizarDatos("usuarios", $datos_actualizacion_usuarios, $condicion)){
                
                /*Para cambiar en tiempo real los datos del usuario que ha iniciado sesion*/
                if($id == $_SESSION['id']){
                    $_SESSION['nombre']= $nombre;
                    $_SESSION['apellido']= $apellido;
                    $_SESSION['usuario']= $usuario;
                }
                
                $alerta=[
                    "tipo" => "recargar",
                    "titulo" => "Usuario actualizado",
                    "texto" => "El usuario ha sido actualizado exitosamente",
                    "icono" => "success",
                ];
                
            }else{
                
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario no actualizado",
                    "texto" => "El usuario no ha sido actualizado",
                    "icono" => "error",
                ];
                
            }
            return json_encode($alerta);
            
        }

        /*Actualizar foto de perfil */
        public function actualizarFotoUsuarioModel(){

            /*Limpiar Inyección de SQL*/
            $id= $this->limpiarCadena($_POST['id_usuario']);

            /*hacemos la consulta */
            $datos= $this->ejecutarConsulta("SELECT * FROM usuarios WHERE id_usuario= '$id'");

            /*verificamos que el usuario seleccionado exista */
            if($datos ->rowCount()<=0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Foto no encontrada",
                    "texto" => "La foto que ha intentado actualizar no se encuentra en la base de datos",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();

            }else{
                $datos=$datos ->fetch();/*hacemos el arrays */
            }

            /*Directorio de fotos de los usuarios*/
            $dir_fotos= "../views/fotos/";

            /*Función para comprobar si se seleccionó una imagen*/
            if(
                $_FILES['usuario_foto']['name']=="" &&
                $_FILES['usuario_foto']['size']<=0
            )
            {
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Foto no válida",
                    "texto" => "No puede enviar el campo vació o archivos diferentes al formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            /*Función para crear el directorio de las imágenes si este no existe */
            if(!file_exists($dir_fotos)){ /*Comprueba si el directorio no existe */
                if(!mkdir($dir_fotos, 0777)){ /*Crea el archivo y si no puede, manda una alerta */
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "Diectorio no creado",
                        "texto" => "El directorio para la foto no se pudo crear",
                        "icono" => "error",
                        ];
                    return json_encode($alerta);
                    exit();
                }
            }

            if(/*Función para verificar el formato de las imágenes*/
                mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/jpeg" &&
                mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/png" 
            ){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Formato inválido",
                    "texto" => "El formato del archivo seleccionado es incorrecto",
                    "icono" => "error",
                    ];
                return json_encode($alerta);
                exit();
            }

            if(/*Función para verificar el formato de las imágenes*/
                ($_FILES['usuario_foto']['size'])/1048576>5
            ){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Archico muy pesado",
                    "texto" => "El tamaño del archivo excede los 5MB permitidos por el sistema",
                    "icono" => "error",
                    ];
                    return json_encode($alerta);
                    exit();
            }

            /*Nombre de la foto */
            if($datos['foto_usuario']!=""){
                $foto=explode(".", $datos['foto_usuario']);
                $foto= $foto[0]; /*Debo chequear si se guarda con el nombre y apellido */
            }else{
                $foto= str_ireplace(" ","_", $datos['nombre_usuario']." ". $datos['apellido_usuario']);
                $foto= $foto."_".rand(0,1000); /*para cambiar el sufijo de la foto por si algún usuario repite el nombre */
            }
            
            /*Asinación del tipo de archivo */
            switch(mime_content_type($_FILES['usuario_foto']['tmp_name'])){
                case "image/jpeg":
                    $foto= $foto.".jpg";
                break;
                case "image/png":
                    $foto= $foto.".png";
                break;
            }

            /*Permisos de letura y escritura a la carpeta de fotos */
            chmod($dir_fotos, 0777);

            /*Mover el archivo */
            if(!move_uploaded_file($_FILES['usuario_foto']['tmp_name'], $dir_fotos.$foto)){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Foto no movida",
                    "texto" => "La imagen no puede ser movida a la carpeta destino",
                    "icono" => "error",
                ];
                return json_encode($alerta);
                exit();
            }

            /*Elimar la imagen anterior*/
            if(is_file($dir_fotos.$datos['foto_usuario']) && $datos['foto_usuario']!=$foto){
                chmod($dir_fotos.$datos['foto_usuario'], 0777); /*damos permiso de lectura y escritura */
                unlink($dir_fotos.$datos['foto_usuario'], 0777); /*elimnamos la foto */
            }

            $datos_actualizacion_usuarios=[
                [
                    "campo_nombre"=>"foto_usuario",
                    "campo_marcador"=>":foto",
                    "campo_valor"=>$foto
                ],
            ];
            $condicion=[
                "condicion_campo"=>"id_usuario", 
                "condicion_marcador"=>":id",
                "condicion_valor"=>$id
            ];

            if($this-> actualizarDatos("usuarios", $datos_actualizacion_usuarios, $condicion)){
                
                /*Para cambiar en tiempo real la foto del usuario que ha iniciado sesión*/
                if($id == $_SESSION['id']){
                    $_SESSION['foto']= $foto;
                }
                
                $alerta=[
                    "tipo" => "recargar",
                    "titulo" => "Foto actualizada",
                    "texto" => "La foto del usuario ".$datos['nombre_usuario']." ".$datos['apellido_usuario']." ha sido actualizada exitosamente",
                    "icono" => "success",
                ];
                
            }else{
                $alerta=[
                    "tipo" => "recargar",
                    "titulo" => "Foto no actualizada",
                    "texto" => "No hemos podido actualizar algunos datos del usuario",
                    "icono" => "warning",
                ];
            }
            return json_encode($alerta);

        }

        /*Eliminar foto de perfil */
        public function eliminarFotoUsuarioModel(){

            /*Limpiar Inyección de SQL*/
            $id= $this->limpiarCadena($_POST['id_usuario']);

            /*hacemos la consulta */
            $datos= $this->ejecutarConsulta("SELECT * FROM usuarios WHERE id_usuario= '$id'");

            /*verificamos que el usuario seleccionado exista */
            if($datos ->rowCount()<=0){
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Usuario no encontrado",
                    "texto" => "El usuario que ha intentado eliminar no se encuentra en la base de datos",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();

            }else{
                $datos=$datos ->fetch();/*hacemos el arrays */
            }

            /*Directorio de fotos de los usuarios*/
            $dir_fotos= "../views/fotos/";
            chmod($dir_fotos, 0777);/*damos permiso de lectura y escritura */

            if(is_file($dir_fotos.$datos['foto_usuario'])){
                chmod($dir_fotos.$datos['foto_usuario'], 0777);
                
                if(!unlink($dir_fotos.$datos['foto_usuario'])){
                    $alerta=[
                        "tipo" => "simple",
                        "titulo" => "Foto no eliminada",
                        "texto" => "No se ha podido eliminar la foto",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
            }else{
                $alerta=[
                    "tipo" => "simple",
                    "titulo" => "Foto no encontrada",
                    "texto" => "La foto que ha intentado eliminar no se encuentra en la base de datos",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            $datos_actualizacion_usuarios=[
                [
                    "campo_nombre"=>"foto_usuario",
                    "campo_marcador"=>":foto",
                    "campo_valor"=>""
                ],
            ];
            $condicion=[
                "condicion_campo"=>"id_usuario", 
                "condicion_marcador"=>":id",
                "condicion_valor"=>$id
            ];

            if($this-> actualizarDatos("usuarios", $datos_actualizacion_usuarios, $condicion)){
                
                /*Para cambiar en tiempo real la foto del usuario que ha iniciado sesión*/
                if($id == $_SESSION['id']){
                    $_SESSION['foto']="";
                }
                
                $alerta=[
                    "tipo" => "recargar",
                    "titulo" => "Foto eliminada",
                    "texto" => "La foto del usuario ".$datos['nombre_usuario']." ".$datos['apellido_usuario']." ha sido eliminada exitosamente",
                    "icono" => "success",
                ];
                
            }else{
                $alerta=[
                    "tipo" => "recargar",
                    "titulo" => "Foto no eliminada",
                    "texto" => "No hemos podido actualizar algunos datos del usuario, sin embargo la foto se eliminó con éxito",
                    "icono" => "warning",
                ];
            }
            return json_encode($alerta);


        }
    }
    

    

?>
