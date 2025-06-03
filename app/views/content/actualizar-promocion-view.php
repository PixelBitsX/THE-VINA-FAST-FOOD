<!-- [FORMULARIO PARA ACTUALIZAR USUARIOS] Comienzo -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
        <div class="card">
            <div class="card-header text-center">
                <?php
                    
                    use app\models\promocionModels;
                    
                    if(isset($_GET['views'])){
                        $url = explode("/", $_GET['views']);
                    } else {
                        $url = ["login"];
                    }
                    $id_promocion = (int)$url[1];

                    $insPromocionModel = new promocionModels();
                    $datos_promocion_stmt = $insPromocionModel->seleccionarDatosPromocion($id_promocion);
                    
                    include "app/views/inc/boton-atras.php";
                    
                    if($datos_promocion_stmt->rowCount() == 1){
                        $datos = $datos_promocion_stmt->fetch(); // Obtenemos los datos como array
                ?>
            </div>
            <h4>EDITAR PROMOCIÓN</h4>
            <form class="FormularioAjax validate-me" data-validate action="<?php echo APP_URL ?>app\controllers\promocionController.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="modulo_promocion" value="actualizar">
                    <input type="hidden" name="id_promocion" value="<?php echo $datos['id_promocion']; ?>">

                        <div class="row g-3">
                            <div class="form-group col-lg-4">
                                <label class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre_promocion" value="<?php echo htmlspecialchars($datos['nombre_promocion']); ?>" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ\s]{5,50}$" required>
                                <small class="form-text text-muted">Ejemplo: Combo Doble Hamburguesa</small>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="form-label">Fecha de inicio:</label>
                                <input type="date" class="form-control" name="fecha_inicio_promocion" value="<?php echo $datos['fecha_inicio_promocion']; ?>" required>
                                <small class="form-text text-muted">Ejemplo: 01/01/2025</small>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="form-label">Fecha de finalización:</label>
                                <input type="date" class="form-control" name="fecha_fin_promocion" value="<?php echo $datos['fecha_fin_promocion']; ?>" required>
                                <small class="form-text text-muted">Ejemplo: 12/12/2025</small>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="form-group col-lg-4">
                                <label class="form-label">Descuento:</label>
                                <input type="text" class="form-control" name="descuento_promocion" value="<?php echo $datos['descuento_promocion']; ?>" pattern="^\d{1,3}$" required> <small class="form-text text-muted">Ejemplo: "50" (de 0 a 100)</small>
                            </div>
                            <div class="form-group col-lg-8"> <label class="form-label">Detalle:</label>
                                <input type="text" class="form-control" name="detalle_promocion" value="<?php echo htmlspecialchars($datos['detalle_promocion']); ?>" pattern="^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9\s.,;?!-]{0,250}$"> <small class="form-text text-muted">Ejemplo: combo doble perro sencillo y doble hamburguesa con refresco</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center justify-content-center">
                        <button type="reset" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Limpiar</button>
                        <button type="submit" class="btn btn-success d-inline-flex"><i class="ti ti-file-check"></i>Guardar Cambios</button>
                    </div>
                </div>
            </form>
            <?php
                } else { // Si no se encontró la promoción
                    include "app/views/inc/alerta-error.php";
                }
            ?>
        </div>
        </div>
    </div>
</div>
<!-- [FORMULARIO PARA ACTUALIZAR USUARIOS] Fin -->