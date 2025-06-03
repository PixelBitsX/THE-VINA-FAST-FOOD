<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>REGISTRO DE PROMOCIONES</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="FormularioAjax validate-me" data-validate action="<?php echo APP_URL ?>app\controllers\promocionController.php" method="POST" autocomplete="on" enctype="multipart/form-data" ><div class="modal-body">
                                <input type="hidden" name="modulo_promocion" value="registrar">
                                <div class="row g-3">
                                    <div class="form-group col-lg-4">
                                        <label class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre_promocion" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ\s]{5,50}$" required>
                                        <small class="form-text text-muted">Ejemplo: Combo Doble Hamburguesa</small>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="form-label">Fecha de inicio:</label>
                                        <input type="date" class="form-control" name="fecha_inicio_promocion" required>
                                        <small class="form-text text-muted">Ejemplo: 01/01/2025</small>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="form-label">Fecha de finalizacion:</label>
                                        <input type="date" class="form-control" name="fecha_fin_promocion" required>
                                        <small class="form-text text-muted">Ejemplo: 12/12/2025</small>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="form-label">Descuento:</label>
                                        <input type="text" class="form-control" name="descuento_promocion" pattern="^\d{2,3}$" required>
                                        <small class="form-text text-muted">Ejemplo: "50"</small>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="form-label">Detalle:</label>
                                        <input type="text" class="form-control" name="detalle_promocion" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9\s]{0,255}$">
                                        <small class="form-text text-muted">Ejemplo: combo doble perro sencillo y doble hamburguesa con refresco</small>
                                    </div>
                                </div>
                                <div class="modal-footer text-center justify-content-center">
                                    <button type="reset" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Limpiar</button>
                                    <button type="submit" class="btn btn-success d-inline-flex"><i class="ti ti-file-check"></i>Guardar</button>
                                </div>
                            </div>
                        </form>
                        </div>
                </div>
            </div>
            <?php
                if(isset($_GET['views'])){
                    $vista = explode("/", $_GET['views']);
                } else {
                    $vista = ["login"]; 
                }

                use app\models\promocionModels;
                $insPromocion = new promocionModels();
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
                            
                            $pagina_actual = isset($vista[1]) ? (int)$vista[1] : 1; 

                            if (isset($_POST['actualizar_tabla'])) {
                                $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : "";
                                $orden = isset($_POST['orden_busqueda']) ? $_POST['orden_busqueda'] : "";
                                // Pasamos $pagina_actual en lugar de $vista[1]
                                echo $insPromocion->listarPromocionesPaginador($pagina_actual, 10, $vista[0], $busqueda, $orden);
                            } else {
                                // Pasamos $pagina_actual en lugar de $vista[1]
                                echo $insPromocion->listarPromocionesPaginador($pagina_actual, 10, $vista[0], "", "");
                            }
                        ?>
                    </div>
                </div>
            </div>