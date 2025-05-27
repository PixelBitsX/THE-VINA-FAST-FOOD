<?php
    require_once "autoload.php";
    require_once "config/app.php";
    require_once "app/views/inc/session_start.php"; /*El archivo que inicia la sesión*/

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "app/views/inc/head.php";?> 
</head>
<body>
    <?php
        use app\controllers\viewsController;/*llamamos al controlador para la vista */
        use app\controllers\loginController;/*llamamos al controlador para la sesion */
        
        
        if(isset($_POST['login_usuario']) && isset($_POST['login_contrasena'])){
        $insLogin= new loginController();
        $insLogin -> iniciarSesionControlador();
        }
        $vista= new viewsController(); /*hacemos la instancia a la clase */
        $vista -> obtenerVistasControlador();
    ?> 

    <?php require_once "app/views/inc/script.php"; ?>
</body>
</html>