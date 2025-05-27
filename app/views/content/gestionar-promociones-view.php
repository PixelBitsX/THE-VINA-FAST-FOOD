<!-- [ Inicio de la vista de "Gestionar Promociones" ] -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <!-- [FORMULARIO DE LAS PROMOCIONES] Comienzo -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>REGISTRO DE PROMOCIONES</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- [CONTENIDO DEL FORMULARIO DE PROMOCIONES"] Comienzo-->
                            <form class="FormularioAjax validate-me" data-validate action="<?php echo APP_URL ?>app\controllers\promocionController.php" method="POST" autocomplete="on" enctype="multipart/form-data" ><!-- El atributo de enctype se usa para enviar archivos como fotos-->
                                <div class="modal-body">

                                    <!--input para que el controlador sepa los archivos que deberá llamar con respecto a la petición de la vista-->
                                    <input type="hidden" name="modulo_promocion" value="registrar">

                                    <div class="row g-3">
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre_promocion" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{5,50}$" required>
                                            <small class="form-text text-muted">Ejemplo: Combo Doble Hamburguesa</small>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Fecha de inicio:</label>
                                            <input type="text" class="form-control" name="fecha_incio_promocion" pattern="^(\d{10})/" required>
                                            <small class="form-text text-muted">Ejemplo: 01/01/2025</small>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Fecha de finalizacion:</label>
                                            <input type="text" class="form-control" name="fecha_fin_promocion" pattern="^(\d{10})/" required>
                                            <small class="form-text text-muted">Ejemplo: 12/12/2025</small>
                                        </div>
                                        <div class="row g-3">
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Descuento:</label>
                                            <input type="text" class="form-control" name="descuento_promocion" pattern="^(\d{2,3}%)$" required>
                                            <small class="form-text text-muted">Ejemplo: "50%"</small>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Detalle:</label>
                                            <input type="text" class="form-control" name="detalle_promocion" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{250}$" required>
                                            <small class="form-text text-muted">Ejemplo: combo doble perro sencillo y doble hamburguesa con refresco</small>
                                        </div>
                                    </div>

                                    <div class="modal-footer text-center justify-content-center">
                                    <button type="reset" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Limpiar</button>
                                    <button type="submit" class="btn btn-success d-inline-flex"><i class="ti ti-file-check"></i>Guardar</button>
                                    </div>
                                </div>
                            </form>
                            <!-- [CONTENIDO DEL FORMULARIO DE PROMOCIONES"] Fin-->
                        </div>
                    </div>
                </div>
            <!-- [FORMULARIO DE LAS PROMOCIONES] Fin -->

            <!-- [LISTA DE PROMOCIONES] COMIENZO -->
                <?php
                    if(isset($_GET['views'])){
                        $vista= explode("/", $_GET['views']);
                    }else{
                        $vista=["login"]; 
                    }

                    use app\models\promocionModels;
                    $insPromocion= new promocionModels();
                    
                ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center position-relative">
                            <button type="button" class="btn btn-success position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="ti ti-file-plus"></i>Agregar</button>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div>
                                            <h4>LISTA DE PROMOCIONES REGISTRADAS</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-5 col-md-4">
                                        <form id="form-busqueda-Promociones" class="input-group" method="">
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
                                                <option value="nombre_promocion">Nombre</option>
                                                <option value="fecha_inicio_promocion">Fecha de Inicio</option>
                                                <option value="fecha_fin_promocion">Fecha de Finalizacion</option>
                                                <option value="descuento_promocion">Descuento</option>
                                                <option value="descripcion_promocion">Descripcion</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="tabla-Promociones-container">
                            <?php
                            if (isset($_POST['actualizar_tabla'])) {
                                $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : "";
                                $orden = isset($_POST['orden_busqueda']) ? $_POST['orden_busqueda'] : "";
                                echo $insPromocion->listarPromocionesPaginador($vista[1], 10, $vista[0], $busqueda, $orden);
                            } else {
                                echo $insPromocion->listarPromocionesPaginador($vista[1], 10, $vista[0], "", "");
                            }
                            ?>
                        </div>
                    </div>
                </div>


<!-- [ Fin de la vista de "Gestionar Promociones" ] -->




