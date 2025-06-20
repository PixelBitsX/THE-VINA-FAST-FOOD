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
                                        <label class="form-label">Detalle:</label>
                                        <input type="text" class="form-control" name="detalle_promocion" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9\s]{0,255}$">
                                        <small class="form-text text-muted">Ejemplo: combo doble perro sencillo y doble hamburguesa con refresco</small>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="mb-3">
                                    <label class="form-label">Elementos de la Promoción:</label>
                                    <div id="elementos-promocion-container">
                                        <div class="row g-3 align-items-end elemento-promocion-row mb-3 border p-2 rounded">
                                    <div class="col-md-3">
                                        <label class="form-label">Tipo:</label>
                                        <div class="form-check form-switch custom-switch-v1 mb-2">
                                            <input type="checkbox" class="form-check-input input-primary switch-tipo-elemento" 
                                                id="switchTipoElemento_0" data-row-id="0" value="producto" checked> 
                                            <span class="form-check-label-text" for="switchTipoElemento_0">Producto</span>
                                            <input type="hidden" name="tipo_elemento[]" class="hidden-tipo-elemento" value="producto"> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label class="form-label">Elemento:</label>
                                        <select class="form-control select-elemento" name="id_elemento[]" required>
                                            <option value="">Seleccione un tipo primero</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label class="form-label">Cantidad:</label>
                                        <input type="number" class="form-control cantidad-elemento" name="cantidad_elemento[]" min="1" value="1" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Descuento (%):</label>
                                        <input type="number" class="form-control descuento-elemento" name="descuento_elemento[]" min="0" max="100" value="0" required>
                                        <small class="form-text text-muted">Max 100%</small>
                                    </div>
                                    
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-danger btn-sm eliminar-elemento">
                                            <i class="ti ti-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                                    <button type="button" class="btn btn-info btn-sm mt-2" id="btn-agregar-elemento">
                                        <i class="ti ti-plus"></i> Añadir Elemento
                                    </button>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="form-label">Costo Total de Promoción (Estimado):</label>
                                    <p id="costo_total_promocion" class="form-control-plaintext fs-4 text-success">$0.00</p>
                                </div>
                                <hr class="my-4">
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
                                echo $insPromocion->listarPromocionesPaginador($pagina_actual, 10, $vista[0], $busqueda, $orden);
                            } else {
                                echo $insPromocion->listarPromocionesPaginador($pagina_actual, 10, $vista[0], "", "");
                            }
                        ?>
                    </div>
                </div>
            </div>