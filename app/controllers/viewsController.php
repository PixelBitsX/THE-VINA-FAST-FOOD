<?php
namespace app\controllers;
use app\models\viewsModel;
use app\controllers\loginController;

class viewsController extends viewsModel{

    public function obtenerVistasControlador(){

        if(isset($_GET['views'])){
            $vista= explode("/", $_GET['views']);
        }else{
            $vista=["login"]; 
        }

        if($vista!=""){
            $NombreVista= $this-> obtenerVistasModelo($vista[0]); // Obtener el nombre de la vista del modelo
        }else{
            $NombreVista="login";
        }

        if(
            $NombreVista=="login" || $NombreVista=="404" || $NombreVista=="proximamente" ||
            $NombreVista=="contactanos" || $NombreVista=="error-500" || $NombreVista=="home" ||
            $NombreVista=="olvidar-contrasena-1" || $NombreVista=="olvidar-contrasena-2" || $NombreVista=="olvidar-contrasena-3" ||
            $NombreVista=="registrar-usuario" || $NombreVista=="restaurar-contrasena" || $NombreVista=="bajo-construccion"
            
        ){
            $archivoAIncluir =  "app/views/content/" . $NombreVista . "-view.php";
            if(is_file($archivoAIncluir)){
                
                require_once $archivoAIncluir;
            
            } else {
                $archivoAIncluir =  "app/views/content/404-view.php"; // O manejar el error apropiadamente
                require_once $archivoAIncluir;
            }

        }else{
            /*sino, se irá a la vista existente*/
            $archivoAIncluir = "app/views/content/" . $NombreVista . "-view.php";
            
            if(is_file($archivoAIncluir)){

                /*Comprobamos si el usuario ha iniciado o no sesión */
                if(
                    !isset($_SESSION['id']) || !isset($_SESSION['nombre']) || !isset($_SESSION['usuario']) ||
                    $_SESSION['id']=="" || $_SESSION['nombre']=="" || $_SESSION['usuario']==""
                ){
                    $insLogin= new loginController();
                    $insLogin -> cerrarSesionControlador();
                    exit;
                }
                require_once "app/views/inc/sidebar.php"; 
                require_once "app/views/inc/header.php"; 
                require_once $archivoAIncluir;
                require_once "app/views/inc/footer.php";
            } else {
                 $archivoAIncluir =  "app/views/content/404-view.php"; // O manejar el error apropiadamente
                require_once $archivoAIncluir;
            }
            
            
            
        }

        /*Para agg el archivo sólo si la vista es la del home */
        if($NombreVista=="home"){
            echo "<link rel='stylesheet' href='app/assets/css/landing.css'>";
        }

        //  No es necesario hacer echo de $vista aquí. Las declaraciones require_once ya imprimen el contenido de la vista.
        
    }

    
}


?>