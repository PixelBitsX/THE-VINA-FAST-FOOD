<!-- [ Inicio de la vista de "Actualizar foto de perfil de los usuarios" ] -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <!-- [FORMULARIO DE LAS FOTOS DE PERFIL] Comienzo -->
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
                            echo' <h4>EDITAR MI FOTO PERFIL</h4>';
                        }
                        else{
                            echo'  <h4>EDITAR FOTO DE PERFIL</h4>';
                        }
                        include "app/views/inc/boton-atras.php";

                        $datos= $insLogin->seleccionarDatos("Unico", "usuarios", "id_usuario", $id);
                        
                        if($datos->rowCount()==1){
                            $datos=$datos->fetch();
                    ?>
                </div>
                <!-- [CONTENIDO DEL FORMULARIO DE USUARIOS"] Comienzo-->
                    <div class="card-body">
                        <div class="row g-3">
                            
                            <?php 
                                if(!is_file("app/views/fotos/".$datos['foto_usuario'])){
                                    echo'
                                        <div class="col-lg-2 text-center">
                                            <img src=" '.APP_URL.'app/views/fotos/default.png" alt="foto-perfil" width="100px" class="rounded-circle">
                                        </div>
                                    ';
                                }else{
                                    echo'
                                        <form class="FormularioAjax col-lg-2 text-center" action="'.APP_URL.'app\controllers\usuarioController.php" method="POST" autocomplete="off" enctype="multipart/form-data" ><!-- El atributo de enctype se usa para enviar archivos como fotos-->
                                            <div class="row">
                                                <img src=" '.APP_URL.'app/views/fotos/'.$datos['foto_usuario'].'" alt="foto-perfil" width="100px" class="rounded-circle">
                                            </div>
                                            <br>
                                            <input name="modulo_usuario" type="hidden" value="eliminarFoto">
                                            <input name="id_usuario" type="hidden" value="'.$datos['id_usuario'].'">
                                            <button type="submit" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Eliminar foto</button>
                                        </form>
                                        ';
                                }
                            ?>
                            
                            <form class="FormularioAjax col-lg-10" action="<?php echo APP_URL ?>app\controllers\usuarioController.php" method="POST" autocomplete="off" enctype="multipart/form-data" ><!-- El atributo de enctype se usa para enviar archivos como fotos-->
                                
                                <input name="modulo_usuario" type="hidden" value="actualizarFoto">
                                <input name="id_usuario" type="hidden" value=" <?php echo $datos['id_usuario'] ?>">

                                    <label class="form-label">Foto de perfil</label>
                                    <input name="usuario_foto" id="usuario_foto" type="file" class="form-control">
                                    <small class="form-text text-muted">Sólo formatos de tipo PNG y JPG con un peso máximo de 5MB</small>
                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-outline-success" type="submit">Actualizar foto</button>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-center justify-content-center">
                        <?php
                            }else{ 
                                include "app/views/inc/alerta-error.php";
                            }
                        ?>
                    </div>
                <!-- [CONTENIDO DEL FORMULARIO DE USUARIOS"] Fin-->
            </div>
            <!-- [FORMULARIO DE LAS FOTOS DE PERFIL] Comienzo -->
        </div>
    </div>
</div>
<!-- [ Fin de la vista de "Actualizar foto de perfil de los usuarios" ] -->
            
