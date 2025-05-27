<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\models\usuarioModels;

	if(isset($_POST['modulo_usuario'])){

		$insUsuario = new usuarioModels();

		if($_POST['modulo_usuario']=="registrar"){
			echo $insUsuario->registrarUsuarioModel();
		}
		
		if($_POST['modulo_usuario']=="eliminar"){
			echo $insUsuario->eliminarUsuarioModel();
		}

		if($_POST['modulo_usuario']=="actualizar"){
			echo $insUsuario->actualizarUsuarioModel();
		}

		if($_POST['modulo_usuario']=="actualizarFoto"){
			echo $insUsuario->actualizarFotoUsuarioModel();
		}

		if($_POST['modulo_usuario']=="eliminarFoto"){
			echo $insUsuario->eliminarFotoUsuarioModel();
		}

    }else{
        /*Si viene por get se procede a destruir la sesión y mandar al usuario al login */
        session_destroy();
        header("Location: " .APP_URL. "login");
    }





?>