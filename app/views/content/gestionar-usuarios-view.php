<!-- [ Inicio de la vista de "Gestionar usuarios" ] -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <!-- [FORMULARIO DE LOS USUARIOS] Comienzo -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>REGISTRO DE USUARIOS</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- [CONTENIDO DEL FORMULARIO DE USUARIOS"] Comienzo-->
                            <form class="FormularioAjax validate-me" data-validate action="<?php echo APP_URL ?>app\controllers\usuarioController.php" method="POST" autocomplete="on" enctype="multipart/form-data" ><!-- El atributo de enctype se usa para enviar archivos como fotos-->
                                <div class="modal-body">

                                    <!--input para que el controlador sepa los archivos que deberá llamar con respecto a la petición de la vista-->
                                    <input type="hidden" name="modulo_usuario" value="registrar">

                                    <div class="row g-3">
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Cédula:</label>
                                            <input type="text" class="form-control" name="usuario_cedula" pattern="^(\d{7,9})$" required>
                                            <small class="form-text text-muted">Ejemplo: "1234567/12345678"</small>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" name="usuario_nombre" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$" required>
                                            <small class="form-text text-muted">Ejemplo: Pedro</small>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Apellido:</label>
                                            <input type="text" class="form-control" name="usuario_apellido" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$" required>
                                            <small class="form-text text-muted">Ejemplo: Pérez</small>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Correo electrónico:</label>
                                            <input type="text" class="form-control" name="usuario_correo" pattern="" required>
                                            <small class="form-text text-muted">Formato: ejemplo@gmail.com</small>
                                        </div>
                                        
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Teléfono:</label>
                                            <input type="text" class="form-control" name="usuario_telefono" pattern="^\d{11}$" required>
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
                                            <input type="text" class="form-control" name="usuario_usuario" pattern="^(?=.*[0-9].*[0-9])(?=.{8,}).*$" required>
                                            <small class="form-text text-muted">Ejemplo: ejemplo12</small>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Contraseña:</label>
                                            <input type="password" class="form-control" name="usuario_contrasena1" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ\d\*\.\$\&\%\+]{8,15}" required>
                                            <small class="form-text text-muted">Ejemplo: Contraseña12.</small>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Confirmar contraseña:</label>
                                            <input type="password" class="form-control" name="usuario_contrasena2" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ\d\*\.\$\&\%\+]{8,15}" required>
                                            <small class="form-text text-muted">Ejemplo: Contraseña12.</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label class="form-label">Foto de perfil</label>
                                        <input name="usuario_foto" id="usuario_foto" type="file" class="form-control">
                                        <small class="form-text text-muted">Sólo formatos de tipo PNG y JPG con un peso máximo de 5MB</small>
                                    </div>
                                </div>
                                <div class="modal-footer text-center justify-content-center">
                                    <button type="reset" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Limpiar</button>
                                    <button type="submit" class="btn btn-success d-inline-flex"><i class="ti ti-file-check"></i>Guardar</button>
                                </div>
                            </form>
                            <!-- [CONTENIDO DEL FORMULARIO DE USUARIOS"] Fin-->
                        </div>
                    </div>
                </div>
            <!-- [FORMULARIO DE LOS USUARIOS] Comienzo -->

            <!-- [LISTA DE USUARIOS] COMIENZO -->
                <?php
                    if(isset($_GET['views'])){
                        $vista= explode("/", $_GET['views']);
                    }else{
                        $vista=["login"]; 
                    }

                    use app\models\usuarioModels;
                    $insUsuario= new usuarioModels();
                    
                ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center position-relative">
                            <button type="button" class="btn btn-success position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="ti ti-file-plus"></i>Agregar</button>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div>
                                            <h4>LISTA DE USUARIOS REGISTRADOS</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-5 col-md-4">
                                        <form id="form-busqueda-usuarios" class="input-group" method="">
                                            <input type="text" class="form-control" placeholder="Ingresa tu búsqueda" name="busqueda" id="busqueda">
                                            <!--<button class="btn btn-outline-primary" type="submit">Buscar</button>
                                            <button class="btn btn-outline-secondary" type="button" id="limpiar-busqueda">Limpiar</button>
                                            <input type="hidden" name="actualizar_tabla" value="1">-->
                                        </form>
                                    </div>
                                    <div class="col-sm-5 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Ordenar por</label>
                                            <select class="form-control error" name="orden_busqueda" id="orden_busqueda" required="" aria-describedby="bouncer-error_select" aria-invalid="true">
                                                <option value="cedula_usuario">Cédula</option>
                                                <option value="nombre_usuario">Nombre</option>
                                                <option value="apellido_usuario">Apellido</option>
                                                <option value="usuario_usuario">Usuario</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="tabla-usuarios-container">
                            <?php
                            if (isset($_POST['actualizar_tabla'])) {
                                $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : "";
                                $orden = isset($_POST['orden_busqueda']) ? $_POST['orden_busqueda'] : "";
                                echo $insUsuario->listarUsuariosPaginador($vista[1], 10, $vista[0], $busqueda, $orden);
                            } else {
                                echo $insUsuario->listarUsuariosPaginador($vista[1], 10, $vista[0], "", "");
                            }
                            ?>
                        </div>
                    </div>
                </div>


<!-- [ Fin de la vista de "Gestionar usuarios" ] -->




