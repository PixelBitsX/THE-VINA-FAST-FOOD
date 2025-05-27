/*=========================================================================
COMIENZO [FUNCIONES PARA LA DINAMICIDAD DEL FORMULARIO DE PEDIDOS]
=========================================================================*/

/*[Función para evitar que ambos check esté clickeados] COMIENZO*/
    const checkUno = document.getElementById('checkLlevar');
    const checkDos = document.getElementById('checkDelivery');
    const opciones_delivery = document.getElementById('opciones_delivery');
    const opciones_insumos = document.getElementById('opciones_insumos');
    
    function sincronizarCheckboxes(checkbox1, checkbox2) {

        checkbox1.addEventListener('change', function() {
            if (checkbox1.checked) {
            checkbox2.checked = false;
            opciones_insumos.style.display='block';
            opciones_delivery.style.display='none';
            }else{
                opciones_insumos.style.display='none';
                opciones_delivery.style.display='none';
            }
        });

        checkbox2.addEventListener('change', function() {
            if (this.checked) {
            checkbox1.checked = false;
            opciones_insumos.style.display='block';
            opciones_delivery.style.display='block';
            }else{
                opciones_insumos.style.display='none';
                opciones_delivery.style.display='none';
            }
        });
        
    }

    if (checkUno && checkDos) {
    sincronizarCheckboxes(checkUno, checkDos);
    }
/*[Función para evitar que ambos check esté clickeados] FIN*/

/*[Función para agregar detalles PRODUCTOS] COMIENZO*/
    let productoContador = 2;
    function agregarProducto() {
        const container = document.getElementById('productos_container');
        const nuevoProducto = document.createElement('div');
        nuevoProducto.classList.add('detalle_producto');
        nuevoProducto.classList.add('row');
        nuevoProducto.classList.add('g-3');
        nuevoProducto.innerHTML = `
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
                    <button type="button" onclick="eliminarDetalle(this)" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></button>
                </div>
        `;
        container.appendChild(nuevoProducto);
        productoContador++;
    }
/*[Función para agregar detalles PRODUCTOS] FIN*/

/*[Función para agregar detalles de INSUMOS] COMIENZO*/
    let insumoContador = 2;
    function agregarInsumo() {
        const container = document.getElementById('insumos_container');
        const nuevoInsumo = document.createElement('div');
        nuevoInsumo.classList.add('detalle_insumo');
        nuevoInsumo.classList.add('row');
        nuevoInsumo.classList.add('g-3');
        nuevoInsumo.innerHTML = `
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
            <button type="button" onclick="eliminarDetalle(this)" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></button>
        </div>
        `;
        container.appendChild(nuevoInsumo);
        insumoContador++;
    }
/*[Función para agregar detalles de INSUMOS] FIN*/

/*[Función para agregar detalles de PAGOS] COMIENZO*/
    let pagoContador = 2;
    function agregarPago() {
        const container = document.getElementById('pagos_container');
        const nuevoPago = document.createElement('fieldset');
        nuevoPago.classList.add('detalle_pago');
        nuevoPago.classList.add('row');
        nuevoPago.classList.add('g-3');
        nuevoPago.innerHTML = `
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="metodo_pago_${pagoContador}" class="form-label">Método de pago</label>
                    <select class="form-control error metodo_pago_select" name="metodo_pago_${pagoContador}" id="metodo_pago_${pagoContador}" required >
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
                    <input type="number" name="monto_${pagoContador}" id="monto_${pagoContador}" class="form-control" placeholder="">
                    <small class="form-text text-muted">Por favor introduzca el monto del pago</small>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-label">Estado del Pago</label>
                    <select class="form-control error" name="estado_pago_${pagoContador}" id="estado_pago_${pagoContador}" required>
                        <option label="Seleccione"></option>
                        <option>Procesado</option>
                        <option>Pendiente</option>
                    </select>
                    <small class="form-text text-muted">Por favor seleccione un banco emisor</small>
                </div>
            </div>
            <div class="col-lg-1 d-flex align-items-center">
                <button type="button" onclick="eliminarDetalle(this)" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></button>
            </div>
            <div class="col-lg-4" id="campo_banco_emisor" style="display: none;">
                <div class="form-group">
                    <label class="form-label">Banco Emisor</label>
                    <select class="form-control error" name="banco_emisor_${pagoContador}" id="banco_emisor_${pagoContador}" required>
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
                    <input type="number" name="referencia_${pagoContador}" id="referencia_${pagoContador}" class="form-control" placeholder="123456">
                    <small class="form-text text-muted">Por favor introduzca el referencia del pago</small>
                </div>
            </div>
            <div class="col-lg-4" id="campo_banco_receptor" style="display: none;">
                <div class="form-group">
                    <label class="form-label">Banco Receptor</label>
                    <select class="form-control error" name="banco_receptor_${pagoContador}" id="banco_receptor_${pagoContador}" required>
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
        `;
        container.appendChild(nuevoPago);

        // Obtener el nuevo select y asignarle el event listener
        const nuevoMetodoPagoSelect = nuevoPago.querySelector(`#metodo_pago_${pagoContador}`);
        nuevoMetodoPagoSelect.addEventListener('change', mostrarCamposTransferencia);

        pagoContador++;
    }
/*[Función para agregar detalles de PAGOS] FIN*/

/*[Función para agregar campos en el detalle del pago] COMIENZO*/

    const pagosContainer = document.getElementById('pagos_container');
    const primerDetallePago = pagosContainer.querySelector('.detalle_pago');
    // Función para mostrar/ocultar campos según el método de pago
    function mostrarCamposTransferencia(event) {
        const metodoPago = event.target.value;
        const detallePago = event.target.closest('.detalle_pago');

        const bancoEmisor = detallePago.querySelector('#campo_banco_emisor');
        const bancoReceptor = detallePago.querySelector('#campo_banco_receptor');
        const referencia = detallePago.querySelector('#campo_referencia');

        if (metodoPago === 'Transferencia Bancaria' || metodoPago === 'Zelle' || metodoPago === 'Pago Móvil') {
            bancoEmisor.style.display = 'block';
            bancoReceptor.style.display = 'block';
            referencia.style.display = 'block';
        }else{
            bancoEmisor.style.display = 'none';
            bancoReceptor.style.display = 'none';
            referencia.style.display = 'none';
        }
    }
    // Asignar el event listener al select de método de pago del primer bloque
    if (primerDetallePago) {
        const primerMetodoPagoSelect = primerDetallePago.querySelector('#metodo_pago');
        if (primerMetodoPagoSelect) {
            primerMetodoPagoSelect.addEventListener('change', mostrarCamposTransferencia);
        }
    }
    document.addEventListener('DOMContentLoaded', gestionarFormularioPagos);

/*[Función para agregar campos en el detalle del pago] FIN*/

/*[Función para ELIMINAR DETALLES] COMIENZO*/
    function eliminarDetalle(botonEliminar) {
        const contenedor = botonEliminar.parentNode.parentNode;
        contenedor.remove();
        console.log(contenedor);
    }
/*[Función para ELIMINAR DETALLES] FIN*/

/*[FUNCIÓN PARA ENVIAR LOS FORMULARIO] Comienzo*/
    const formularioPedido = document.getElementById('miFormulario');
    formularioPedido.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(formularioPedido);
    const datosPedido = {};
    const productos = [];
    const pagos = [];
    const insumos = [];

    for (const [key, value] of formData.entries()) {
        if (key === 'cedula_cliente' || key === 'nombre_cliente' || key === 'apellido_cliente' || key === 'ruta_entrega' || key === 'repartidor_asignado') {
            datosPedido[key] = value;
        } else if (key.startsWith('categoria_producto')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!productos[index]) productos[index] = {};
            productos[index].categoria = value;
        } else if (key.startsWith('producto')) {
            const index = parseInt(key.split('_')[1]) - 1;
            if (!productos[index]) productos[index] = {};
            productos[index].producto = value;
        } else if (key.startsWith('cantidad_producto')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!productos[index]) productos[index] = {};
            productos[index].cantidad = value;
        } else if (key.startsWith('detalle_producto')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!productos[index]) productos[index] = {};
            productos[index].detalle = value;
        } else if (key.startsWith('metodo_pago')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!pagos[index]) pagos[index] = {};
            pagos[index].metodo = value;
        } else if (key.startsWith('banco_emisor')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!pagos[index]) pagos[index] = {};
            pagos[index].banco_emisor = value;
        } else if (key.startsWith('banco_receptor')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!pagos[index]) pagos[index] = {};
            pagos[index].banco_receptor = value;
        } else if (key.startsWith('monto_pago')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!pagos[index]) pagos[index] = {};
            pagos[index].monto = value;
        } else if (key.startsWith('estado_pago')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!pagos[index]) pagos[index] = {};
            pagos[index].estado = value;
        } else if (key.startsWith('insumo')) {
            const index = parseInt(key.split('_')[1]) - 1;
            if (!insumos[index]) insumos[index] = {};
            insumos[index].nombre = value;
        } else if (key.startsWith('cantidad_insumo')) {
            const index = parseInt(key.split('_')[2]) - 1;
            if (!insumos[index]) insumos[index] = {};
            insumos[index].cantidad = value;
        }
    }

    datosPedido.productos = productos.filter(item => item !== undefined);
    datosPedido.pagos = pagos.filter(item => item !== undefined);
    datosPedido.insumos = insumos.filter(item => item !== undefined);

    console.log("Datos del Formulario:");
    console.log(datosPedido);

    // Aquí podrías enviar los datos a un servidor o realizar otras acciones
    // formularioPedido.submit();
    });
/*[FUNCIÓN PARA ENVIAR LOS FORMULARIO] Comienzo*/

/*[FUNCIÓN PARA ENVIAR ELIMINAR LA BUSQUEDA] Comienzo
    document.getElementById('limpiar-busqueda').addEventListener('click', function() {
        document.getElementById('busqueda').value = ''; // Limpiar el campo de búsqueda
        document.getElementById('form-busqueda-usuarios').submit(); // Enviar el formulario
    });
/*[FUNCIÓN PARA ENVIAR ELIMINAR LA BUSQUEDA] Fin*/

/*=========================================================================
FIN [FUNCIONES PARA LA DINAMICIDAD DEL FORMULARIO DE PEDIDOS]
=========================================================================*/