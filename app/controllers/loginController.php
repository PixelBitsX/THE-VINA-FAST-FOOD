<?php

    namespace app\controllers;
    use app\models\DB;

    class loginController extends DB{

        /*Controlador para la sesion */
        public function iniciarSesionControlador(){
            
            /*Limpiar Inyección de SQL*/
            $usuario= $this->limpiarCadena($_POST['login_usuario']);
            $contrasena= $this->limpiarCadena($_POST['login_contrasena']);
            
            /*Verificar Campos obligatorios*/
            if($usuario=="" || $contrasena==""){
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Campos vacíos',
                            text: 'Por favor asegúrese de llenar correctamente los campos antes de enviar el formulario',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                ";
            }else{
                if($this->verificarDatos("(?=.*[0-9].*[0-9])(?=.{8,}).*", $usuario)){
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Usuario inválido',
                                text: 'Por favor asegúrese introducir un usuario que concuerde con el formato solicitado',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>
                    ";


                }else{
                    if($this->verificarDatos("[a-zA-ZáéíóúüÁÉÍÓÚñÑ\d\*\.\$\&\%\+]{8,15}", $contrasena)){
                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Contraseña inválida',
                                    text: 'Por favor asegúrese introducir una contraseña que concuerde con el formato solicitado',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                        ";
                    }else{
                        /*verificamos que el usuario esté registrado en la base de datos */
                        $check_usuario= $this->ejecutarConsulta("SELECT * FROM usuarios WHERE usuario_usuario = '$usuario'");

                        if($check_usuario -> rowCount() ==1){

                            $check_usuario= $check_usuario->fetch(); /*Para hacer un arrays con los datos que coincidieron en la BD */
                            
                            if(
                                $check_usuario['usuario_usuario'] == $usuario && 
                                password_verify($contrasena, $check_usuario['contrasena_usuario'])
                                
                            ){
                                /*Creamos las variables de sesión */
                                $_SESSION['id']= $check_usuario['id_usuario'];
                                $_SESSION['nombre']= $check_usuario['nombre_usuario'];
                                $_SESSION['apellido']= $check_usuario['apellido_usuario'];
                                $_SESSION['usuario']= $check_usuario['usuario_usuario'];
                                $_SESSION['foto']= $check_usuario['foto_usuario'];

                                /*para verificar si el reenvio se puede hacer con PHP puro o Javascript */
                                if(headers_sent()){
                                    echo "
                                    <script> window.location.href='".APP_URL."dashboard'</script> ";
                                }else{
                                    header("Location:".APP_URL."dashboard");
                                }
                            }else{
                                echo"
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Contraseña incorrecta',
                                            text: 'La contraseña que ha introducido es incorrecta, por favor verifiquela e intente nuevamente',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script>
                                ";
                            }
                        }else{
                            echo"
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Usuario no registrado',
                                        text: 'El usuario que ha introducido no se encuentra registrado en el sistema',
                                        confirmButtonText: 'Aceptar'
                                    });
                                </script>
                            ";
                        }
                    }
                }
            }
        }

        public function cerrarSesionControlador(){
            
            session_destroy(); /*Destruimos la sesión */

            if(headers_sent()){
                echo "
                <script> window.location.href='".APP_URL."home'</script> ";
            }else{
                header("Location:".APP_URL."home");
            }
        }
    }
?>