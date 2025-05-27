<!-- [FORMULARIO PARA ACTUALIZAR USUARIOS] Comienzo -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
        <div class="card">
            <div class="card-header text-center">
                <?php 

                    use app\controllers\loginController;
                    $insLogin= new loginController();
                    if(isset($_GET['views'])){
                    $url= explode("/", $_GET['views']);
                    }

                    $id=$insLogin->limpiarCadena($url[1]);

                    if($id==$_SESSION['id']){
                        echo' <h4>EDITAR MI PERFIL</h4>';
                    }
                    else{
                        echo'  <h4>EDITAR USUARIOS</h4>';
                    }
                    include "app/views/inc/boton-atras.php";
                    $datos= $insLogin->seleccionarDatos("Unico", "usuarios", "id_usuario", $id);
                    
                    if($datos->rowCount()==1){
                        $datos=$datos->fetch();
                ?>
            </div>
            <!-- [CONTENIDO DEL FORMULARIO DE ACTUALIZAR USUARIOS] Comienzo-->
            <form class="FormularioAjax validate-me" data-validate action="<?php echo APP_URL ?>app\controllers\usuarioController.php" method="POST" autocomplete="on" enctype="multipart/form-data" ><!-- El atributo de enctype se usa para enviar archivos como fotos-->
                <div class="card-body">

                    <!--input para que el controlador sepa los archivos que deberá llamar con respecto a la petición de la vista-->
                    <input type="hidden" name="modulo_usuario" value="actualizar">
                    <input type="hidden" name="id_usuario" value="<?php echo $datos['id_usuario']; ?>">

                    <div class="row g-3">
                        <div class="form-group col-lg-4">
                            <label class="form-label">Cédula:</label>
                            <input type="text" class="form-control" name="usuario_cedula" value="<?php echo $datos['cedula_usuario']; ?>" pattern="^(\d{7,9})$" required>
                            <small class="form-text text-muted">Ejemplo: "1234567/12345678"</small>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="usuario_nombre" value="<?php echo $datos['nombre_usuario']; ?>" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$" required>
                            <small class="form-text text-muted">Ejemplo: Pedro</small>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Apellido:</label>
                            <input type="text" class="form-control" name="usuario_apellido" value="<?php echo $datos['apellido_usuario']; ?>" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$" required>
                            <small class="form-text text-muted">Ejemplo: Pérez</small>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="form-group col-lg-4">
                            <label class="form-label">Correo electrónico:</label>
                            <input type="text" class="form-control" name="usuario_correo" value="<?php echo $datos['correo_usuario']; ?>" pattern="" required>
                            <small class="form-text text-muted">Formato: ejemplo@gmail.com</small>
                        </div>
                        
                        <div class="form-group col-lg-4">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="usuario_telefono" value="<?php echo $datos['telefono_usuario']; ?>" pattern="^\d{11}$" required>
                            <small class="form-text text-muted">Ejemplo: 04160000000</small>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Rol del usuario:</label>
                            <select class="form-control" name="usuario_rol" required>
                                <option>Usuario</option>
                                <option>Administrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="form-group col-lg-4">
                            <label class="form-label">Nombre de usuario:</label>
                            <input type="text" class="form-control" name="usuario_usuario" value="<?php echo $datos['usuario_usuario']; ?>" pattern="^(?=.*[0-9].*[0-9])(?=.{8,}).*$" required>
                            <small class="form-text text-muted">Ejemplo: ejemplo12</small>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="usuario_contrasena1" pattern="^(?=(?:[^a-zA-Z]*[a-zA-Z]){5})(?=(?:[^\d]*\d){2})(?=(?:[^$*+%&]*[$*+%&]){1})[a-zA-Z\d$*+%&]{8,15}$">
                            <small class="form-text text-muted">OPCIONAL SI QUIERE ACTUALIZARLA</small>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Confirmar contraseña:</label>
                            <input type="password" class="form-control" name="usuario_contrasena2" pattern="^(?=(?:[^a-zA-Z]*[a-zA-Z]){5})(?=(?:[^\d]*\d){2})(?=(?:[^$*+%&]*[$*+%&]){1})[a-zA-Z\d$*+%&]{8,15}$">
                            <small class="form-text text-muted">OPCIONAL SI QUIERE ACTUALIZARLA</small>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="form-group col-lg-4">
                            <label class="form-label">Usuario del administrador:</label>
                            <input type="text" class="form-control" name="usuario_admin" pattern="^(?=.*[0-9].*[0-9])(?=.{8,}).*$" required>
                            <small class="form-text text-muted">Ejemplo: Usuario123</small>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label">Contraseña del administrador:</label>
                            <input type="password" class="form-control" name="contrasena_admin" pattern="^(?=(?:[^a-zA-Z]*[a-zA-Z]){5})(?=(?:[^\d]*\d){2})(?=(?:[^$*+%&]*[$*+%&]){1})[a-zA-Z\d$*+%&]{8,15}$" required>
                            <small class="form-text text-muted">Ejemplo: Contraseña12.</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center justify-content-center">
                    <button type="reset" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Limpiar</button>
                    <button type="submit" class="btn btn-success d-inline-flex"><i class="ti ti-file-check"></i>Guardar</button>
                </div>
            </form>
            <?php
                }else{ 
                    include "app/views/inc/alerta-error.php";
                }
            ?>
            <!-- [CONTENIDO DEL FORMULARIO DE ACTUALIZAR USUARIOS"] Fin-->
        </div>
        </div>
    </div>
</div>




<!-- [FORMULARIO PARA ACTUALIZAR USUARIOS] Fin -->