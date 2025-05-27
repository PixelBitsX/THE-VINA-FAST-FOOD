<?php
	
	require_once "../../config/app.php";
	require_once "../../autoload.php";
	
	use app\models\promocionModels;

	if(isset($_POST['modulo_promocion'])){

		$insPromocion = new promocionModels();

		if($_POST['modulo_promocion']=="registrar"){
			echo $insPromocion->registrarPromocionModel();
		}
		
		if($_POST['modulo_promocion']=="eliminar"){
			echo $insPromocion->eliminarPromocionModel();
		}

		if($_POST['modulo_promocion']=="actualizar"){
			echo $insPromocion->actualizarPromocionModel();
		}

    }else{
        /*Si viene por get se procede a destruir la sesión y mandar al usuario al login */
        session_destroy();
        header("Location: " .APP_URL. "login");
    }





?>