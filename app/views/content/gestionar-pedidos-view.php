<!-- [ Inicio de la vista de "GESTIONAR PEDIDOS" ] -->
    <div class="pc-container">
        <div class="pc-content">
            <div class="row">

                <!-- [LISTA DE PEDIDOS] Comienzo -->
                    <div class="col-sm-12">
                        
                        <div class="card">
                            <div class="card-header position-relative">
                                <button type="button" class="btn btn-success position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="ti ti-file-plus"></i>Agregar</button>
                                <div class="text-center">
                                    <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                            <div><h4>LISTA DE PEDIDOS REGISTRADOS</h4></div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-sm-5 col-md-4">
                                            <div class="form-group">
                                            <label class="form-label">Buscador</label>
                                                <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Busca aquí..." data-bouncer-message="La cédula sólo debe contener números" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Ordenar por</label>
                                                <select class="form-control error" name="select" id="select" required="" aria-describedby="bouncer-error_select" aria-invalid="true">
                                                    <option label="Seleccione"></option>
                                                    <option>Cédula</option>
                                                    <option>Nombre</option>
                                                    <option>Fecha</option>
                                                    <option>Monto</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="dt-responsive table-responsive text-center">
                                <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cédula</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>0001</td>
                                        <td>Anderson</td>
                                        <td>Freitez</td>
                                        <td>30485684</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                        <td class="text-center">
                                            <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Ver">
                                                <a href="#" class="avtar avtar-xs btn-link-secondary btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-modal">
                                                <i class="ti ti-eye f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Editar">
                                                <a href="#" class="avtar avtar-xs btn-link-success btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-edit_add-modal">
                                                <i class="ti ti-edit-circle f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Eliminar">
                                                <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default">
                                                <i class="ti ti-trash f-18"></i>
                                                </a>
                                            </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>0002</td>
                                        <td>Yeismer</td>
                                        <td>Pérez</td>
                                        <td>12345678</td>
                                        <td>2011/04/25</td>
                                        <td>$450,800</td>
                                        <td class="text-center">
                                            <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Ver">
                                                <a href="#" class="avtar avtar-xs btn-link-secondary btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-modal">
                                                <i class="ti ti-eye f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Editar">
                                                <a href="#" class="avtar avtar-xs btn-link-success btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-edit_add-modal">
                                                <i class="ti ti-edit-circle f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Eliminar">
                                                <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default">
                                                <i class="ti ti-trash f-18"></i>
                                                </a>
                                            </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>0003</td>
                                        <td>Luis</td>
                                        <td>Torcates</td>
                                        <td>87654321</td>
                                        <td>2011/04/25</td>
                                        <td>$580,800</td>
                                        <td class="text-center">
                                            <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Ver">
                                                <a href="#" class="avtar avtar-xs btn-link-secondary btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-modal">
                                                <i class="ti ti-eye f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Editar">
                                                <a href="#" class="avtar avtar-xs btn-link-success btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-edit_add-modal">
                                                <i class="ti ti-edit-circle f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Eliminar">
                                                <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default">
                                                <i class="ti ti-trash f-18"></i>
                                                </a>
                                            </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>0004</td>
                                        <td>Pedro</td>
                                        <td>Briceño</td>
                                        <td>456987123</td>
                                        <td>2011/04/25</td>
                                        <td>$40,800</td>
                                        <td class="text-center">
                                            <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Ver">
                                                <a href="#" class="avtar avtar-xs btn-link-secondary btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-modal">
                                                <i class="ti ti-eye f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Editar">
                                                <a href="#" class="avtar avtar-xs btn-link-success btn-pc-default" data-bs-toggle="modal"
                                                data-bs-target="#customer-edit_add-modal">
                                                <i class="ti ti-edit-circle f-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Eliminar">
                                                <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default">
                                                <i class="ti ti-trash f-18"></i>
                                                </a>
                                            </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="card-footer text-center bg-light border-0">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item"><a class="page-link" href="#!">Anterior</a></li>
                                        <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#!">Siguiente</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                <!-- [LISTA DE PEDIDOS] Fin -->

                <form action="">
                    <!-- [FORMULARIO DE LOS PEDIDOS] Comienzo -->
                        <div class="modal fade bd-example-modal-lg" id="primer_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>REGISTRO DE PEDIDOS</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        
                                    </div>
                                    <div class="modal-body">

                                        <!-- [BOTONES DE "para llevar" y "Delivery"] Inicio-->
                                        <div class="position-relative">
                                            <div class="form-check form-switch custom-switch-v1 mb-2 position-absolute top-1 end-1">
                                                <input type="checkbox" class="form-check-input input-primary" id="checkLlevar">
                                                <label class="form-check-label" for="checkLlevar">¿Para llevar?</label>
                                            </div>
                                            <div class="form-check form-switch custom-switch-v1 mb-2 position-absolute top-0 end-0">
                                                <input type="checkbox" class="form-check-input input-primary" id="checkDelivery">
                                                <label class="form-check-label" for="checkDelivery">¿Delivery?</label>
                                            </div>
                                        </div> 
                                        <!-- [BOTONES DE "para llevar" y "Delivery"] Fin-->
                                        <br><br>
                                        <!-- [CONTENIDO DEL FORMULARIO DE PEDIDOS"] Inicio-->
                                        <fieldset>
                                            <legend>Datos del cliente</legend>  
                                            <div class="row g-3">
                                            <div class="col-lg-3">
                                                <div class="form-group error">
                                                    <label class="form-label">Cédula:</label>
                                                    <input type="number" name="cedula" id="cedula" class="form-control" placeholder="12345678" data-bouncer-message="La cédula sólo debe contener números" required="">
                                                    <small class="form-text text-muted">Por favor introduzca la cédula</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre:</label>
                                                    <input type="text" class="form-control" placeholder="Pedro">
                                                    <small class="form-text text-muted">Por favor introduzca el nombre</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label">Apellido:</label>
                                                    <input type="text" class="form-control" placeholder="Pérez">
                                                    <small class="form-text text-muted">Por favor introduzca el apellido</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group error">
                                                    <label class="form-label">Teléfono:</label>
                                                    <input type="number" name="telefono" id="telefono" class="form-control" placeholder="04160000000" data-bouncer-message="La cédula sólo debe contener números" required="">
                                                    <small class="form-text text-muted">Por favor introduzca el teléfono</small>
                                                </div>
                                            </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Productos</legend>
                                            <div class="row" id="productos_container">
                                                <div class="detalle_producto row g-3">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Categoría</label>
                                                            <select class="form-control error" name="select" id="select" required="" aria-describedby="bouncer-error_select" aria-invalid="true">
                                                                <option label="Seleccione"></option>
                                                                <option>Hamburguesas</option>
                                                                <option>Perros Calientes</option>
                                                                <option>Bebidas</option>
                                                                <option>Empanadas</option>
                                                            </select>
                                                            <small class="form-text text-muted">Por favor seleccione una categoría de productos</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Productos</label>
                                                            <select class="form-control error" name="select" id="select" required="" aria-describedby="bouncer-error_select" aria-invalid="true">
                                                                <option label="Seleccione"></option>
                                                                <option>Perro mixto</option>
                                                                <option>Big Viña</option>
                                                                <option>Doble Queso</option>
                                                                <option>Viña Doble</option>
                                                            </select>
                                                            <small class="form-text text-muted">Por favor seleccione un producto</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group error">
                                                            <label class="form-label">Cantidad:</label>
                                                            <input type="number" name="cedula" id="cedula" class="form-control" placeholder="" data-bouncer-message="La cédula sólo debe contener números" required="">
                                                            <small class="form-text text-muted">Por favor introduzca la cantidad</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Detalles</label>
                                                            <input type="text" class="form-control" placeholder="Por ejemplo: sin queso">
                                                            <small class="form-text text-muted">No exeda el máximo de 255 carácteres</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 d-flex align-items-center">
                                                        <button  type="button" onclick="agregarProducto()" class="btn btn-icon btn-success"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset id="opciones_insumos" style="display: none;">
                                            <legend>Insumos</legend>
                                            <div class="row" id="insumos_container">
                                                <div class="detalle_insumo row g-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Insumos</label>
                                                            <select class="form-control error" name="select" id="select" required="" aria-describedby="bouncer-error_select" aria-invalid="true">
                                                                <option label="Seleccione"></option>
                                                                <option>Envase grande</option>
                                                                <option>Envase mediano</option>
                                                                <option>Envase pequeño</option>
                                                                <option>Bolsa de asa</option>
                                                                <option>Cucharas plásticas</option>
                                                            </select>
                                                            <small class="form-text text-muted">Por favor seleccione una categoría de productos</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group error">
                                                            <label class="form-label">Cantidad</label>
                                                            <input type="number" name="cedula" id="cedula" class="form-control" placeholder="" data-bouncer-message="La cédula sólo debe contener números" required="">
                                                            <small class="form-text text-muted">Por favor introduzca la cantidad del insumo</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 d-flex align-items-center">
                                                        <button  type="button" onclick="agregarInsumo()" class="btn btn-icon btn-success"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset id="opciones_delivery" style="display: none;">
                                            <legend>Delivery</legend>
                                                <div class="row g-3" id="contenedorDelivery">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Rutas</label>
                                                            <select class="form-control error" name="select" id="select" required="" aria-describedby="bouncer-error_select" aria-invalid="true">
                                                                <option label="Seleccione"></option>
                                                                <option>Zona Norte</option>
                                                                <option>Zona Sur</option>
                                                                <option>Zona Este</option>
                                                                <option>Zona Oeste</option>
                                                            </select>
                                                            <small class="form-text text-muted">Por favor seleccione la ruta del delivery</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Repartidores</label>
                                                            <select class="form-control error" name="select" id="select" required="" aria-describedby="bouncer-error_select" aria-invalid="true">
                                                                <option label="Seleccione"></option>
                                                                <option>Martin Colmenarez</option>
                                                                <option>Daniel Rodríguez</option>
                                                                <option>Jorge Línarez</option>
                                                                <option>Marcos León</option>
                                                            </select>
                                                            <small class="form-text text-muted">Por favor seleccione la ruta del delivery</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Dirección de envío</label>
                                                            <input type="text" class="form-control" placeholder="Al lado de...">
                                                            <small class="form-text text-muted">Introduzca una buena descripción</small>
                                                        </div>
                                                    </div>
                                                </div>
                                        </fieldset>
                                        <!-- [CONTENIDO DEL FORMULARIO DE PEDIDOS"] Fin-->


                                    </div>
                                    <div class="modal-footer text-center justify-content-center">
                                        <div class="card-footer text-center bg-light border-0">
                                            <button type="reset" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Limpiar</button>
                                            <button type="button" class="btn btn-info d-inline-flex" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" ><i class="ti ti-receipt"></i>Comanda</button>
                                            <button type="button" class="btn btn-success d-inline-flex" data-bs-target="#segundo_modal" data-bs-toggle="modal"><i class="ti ti-receipt-2"></i>Registrar Pago</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- [FORMULARIO DE LOS PEDIDOS] Fin -->

                    <!-- [FORMULARIO DE LOS PAGOS] Inicio -->
                        <div class="modal fade bd-example-modal-lg" id="segundo_modal" tabindex="-1"  aria-labelledby="exampleModalToggleLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel2">
                                            REGISTRAR PAGO DEL PEDIDO
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" id="pagos_container">
                                            <fieldset class="detalle_pago row g-3">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="metodo_pago" class="form-label">Método de pago</label>
                                                        <select class="form-control error" name="metodo_pago" id="metodo_pago" required >
                                                            <option label="Seleccione"></option>
                                                            <option>Efectivo($)</option>
                                                            <option>Efectivo(BS)</option>
                                                            <option>Punto de Venta</option>
                                                            <option>Transferencia Bancaria</option>
                                                            <option>Zelle</option>
                                                            <option>Pago Móvil</option>
                                                        </select>
                                                        <small class="form-text text-muted">Por favor seleccione un método de pago</small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group error">
                                                        <label class="form-label">Monto</label>
                                                        <input type="number" name="monto" id="monto" class="form-control" placeholder="">
                                                        <small class="form-text text-muted">Por favor introduzca el monto del pago</small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Estado del Pago</label>
                                                        <select class="form-control error" name="select" id="select" required>
                                                            <option label="Seleccione"></option>
                                                            <option>Procesado</option>
                                                            <option>Pendiente</option>
                                                        </select>
                                                        <small class="form-text text-muted">Por favor seleccione un banco emisor</small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 d-flex align-items-center">
                                                    <button  type="button" onclick="agregarPago()" class="btn btn-icon btn-success"><i class="fas fa-plus"></i></button>
                                                </div>
                                                <div class="col-lg-4" id="campo_banco_emisor" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="form-label">Banco Emisor</label>
                                                        <select class="form-control error" name="select" id="select" required>
                                                            <option label="Seleccione"></option>
                                                            <option>Banco de Venezuela</option>
                                                            <option>Provincial</option>
                                                            <option>Banesco</option>
                                                            <option>Mercantil</option>
                                                            <option>Bicentenario</option>
                                                            <option>Banco Nacional de crédito</option>
                                                        </select>
                                                        <small class="form-text text-muted">Por favor seleccione un banco emisor</small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4" id="campo_referencia" style="display: none;">
                                                    <div class="form-group error">
                                                        <label class="form-label">Referencia</label>
                                                        <input type="number" name="referencia" id="referencia" class="form-control" placeholder="123456">
                                                        <small class="form-text text-muted">Por favor introduzca el referencia del pago</small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4" id="campo_banco_receptor" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="form-label">Banco Receptor</label>
                                                        <select class="form-control error" name="select" id="select" required>
                                                            <option label="Seleccione"></option>
                                                            <option>Banco de Venezuela</option>
                                                            <option>Provincial</option>
                                                            <option>Banesco</option>
                                                            <option>Mercantil</option>
                                                            <option>Bicentenario</option>
                                                            <option>Banco Nacional de crédito</option>
                                                        </select>
                                                        <small class="form-text text-muted">Por favor seleccione un banco emisor</small>
                                                    </div>
                                                </div>
                                                
                                                
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button class="btn btn-light-secondary d-inline-flex" data-bs-target="#primer_modal" data-bs-toggle="modal"><i class="ti ti-arrow-back-up"></i> Regresar</button>
                                        <button type="button" class="btn btn-info d-inline-flex" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" ><i class="ti ti-receipt"></i>Comanda</button>
                                        <div>
                                            <button type="reset" class="btn btn-danger d-inline-flex"><i class="ti ti-trash"></i>Limpiar</button>
                                            <button type="submit" class="btn btn-success d-inline-flex"><i class="ti ti-file-check"></i>Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- [FORMULARIO DE LOS PAGOS] Fin -->
                </form>

                <!-- [COMANDA] Comienzo-->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">THE VIÑA FAST FOOD C.A.</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            
                            <p class="f-w-900 mb-1">RIF/CI: V30485684</p>
                            <p class="f-w-900 mb-1">R.S: ANDERSON FREITEZ</p>
                            <p class="f-w-900 mb-1">Ref. Int: 0000001</p>
                            <p class="f-w-900 mb-1">Vend: Yeismer Pérez</p>
                            <div class="table-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-end">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-truncate f-w-900">Perro Mixto</span>
                                                </div>
                                                </td>
                                                <td class="text-center f-w-900">2</td>
                                                <td class="text-end f-w-900"><span class="text-danger">BS 460,24</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-truncate f-w-900">Vig Viña</span>
                                                </div>
                                                </td>
                                                <td class="text-center f-w-900">3</td>
                                                <td class="text-end f-w-900"><span class="text-danger">BS 850,24</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-truncate f-w-900">Salchipapas</span>
                                                </div>
                                                </td>
                                                <td class="text-center f-w-900">1</td>
                                                <td class="text-end f-w-900"><span class="text-danger">BS 200,24</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-truncate f-w-900">Bolsa de asa</span>
                                                </div>
                                                </td>
                                                <td class="text-center f-w-900">1</td>
                                                <td class="text-end f-w-900"><span class="text-danger">BS 10,00</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-truncate f-w-900">Delivery</span>
                                                </div>
                                                </td>
                                                <td class="text-center f-w-900">1</td>
                                                <td class="text-end f-w-900"><span class="text-danger">BS 180,25</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-truncate f-w-900">TOTAL</span>
                                                </div>
                                                </td>
                                                <td class="text-end f-w-900"></td>
                                                <td class="text-end f-w-900"><span class="text-danger">BS 1700,97</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-truncate f-w-900">EQUIVALENCIA</span>
                                                </div>
                                                </td>
                                                <td class="text-end f-w-900">Tasa BCV: BS 84,42</td>
                                                <td class="text-end f-w-900"><span class="text-danger">$ 20,15</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-light-danger btn-sm" data-bs-dismiss="offcanvas"> Cerrar </button>
                            </div>
                        </div>
                    </div>
                <!-- [COMANDA] Fin-->

            </div>
        </div>
    </div>
<!-- [ Fin de la vista de "GESTIONAR PEDIDOS" ] -->
