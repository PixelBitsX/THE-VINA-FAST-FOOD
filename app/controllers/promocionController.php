<?php

require_once "../../autoload.php";
require_once "../../config/APP.php";

use app\models\promocionModels;

if(isset($_POST['modulo_promocion'])){

    $insPromocion = new promocionModels();

    if($_POST['modulo_promocion']=="registrar"){
        echo $insPromocion->registrarPromocionesModel();
    }

    if($_POST['modulo_promocion']=="eliminar"){
        echo $insPromocion->eliminarPromocionesModel();
    }

    if($_POST['modulo_promocion']=="actualizar"){
        echo $insPromocion->actualizarPromocionesModel();
    }

}else{
    /*Si viene por get se procede a destruir la sesión y mandar al usuario al login */
    session_destroy();
    header("Location: " .APP_URL. "login");
}





?>