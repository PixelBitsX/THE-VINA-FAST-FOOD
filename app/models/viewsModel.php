<?php
    namespace app\models; /*Agg el nombre de espacio para que se agg automaticamente con el autoload */

    class viewsModel{
        protected function obtenerVistasModelo($vista){
            //creamos la lista de vistas disponibles en el sistema
            $listaBlanca=[
                "dashboard", "logOut",  "gestionar-pedidos", "gestionar-promociones",
                "gestionar-usuarios",  "actualizar-usuario", "actualizar-usuario-foto", 
            ];

            $contenido = "404"; // Valor por defecto
        
            if(in_array($vista, $listaBlanca)){
                if(is_file("./app/views/content/". $vista ."-view.php")){
                    $contenido= $vista;
                }
            } else {
                switch ($vista) {
                    case 'login':
                    case 'index':
                        $contenido = "login";
                        break;
                    case 'bajo-construccion':
                        $contenido = "bajo-construccion";
                        break;
                    case 'contactanos':
                        $contenido = "contactanos";
                        break;
                    case 'error-500':
                        $contenido = "error-500";
                        break;
                    case 'home':
                        $contenido = "home";
                        break;
                    case 'olvidar-contrasena-1':
                        $contenido = "olvidar-contrasena-1";
                        break;
                    case 'olvidar-contrasena-2':
                        $contenido = "olvidar-contrasena-2";
                        break;
                    case 'olvidar-contrasena-3':
                        $contenido = "olvidar-contrasena-3";
                        break;
                    case 'proximamente':
                        $contenido = "proximamente";
                        break;
                    case 'registrar-usuario':
                        $contenido = "registrar-usuario";
                        break;
                    case 'restaurar-contrasena':
                        $contenido = "restaurar-contrasena";
                        break;
                }
            }
        
            return $contenido;
        }
    }
?>