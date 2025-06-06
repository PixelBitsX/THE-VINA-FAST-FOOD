// Este código irá en tu nuevo archivo 'promociones.js'
document.addEventListener('DOMContentLoaded', function() {

    // Función para actualizar el texto y el valor oculto del switch
    function updateSwitchLabelAndValue(checkbox) {
        const textLabel = checkbox.closest('.form-check-switch').querySelector('.form-check-label-text') || 
                          checkbox.nextElementSibling; // Intenta encontrar el span, si no, el label original
        const hiddenInput = checkbox.closest('.form-check-switch').querySelector('.hidden-tipo-elemento') || 
                            checkbox.nextElementSibling.nextElementSibling; // Encuentra el hidden input

        if (checkbox.checked) {
            if (textLabel) textLabel.textContent = "Producto";
            if (hiddenInput) hiddenInput.value = "producto";
        } else {
            if (textLabel) textLabel.textContent = "Insumo";
            if (hiddenInput) hiddenInput.value = "insumo";
        }
    }

    // Listener para todos los switches existentes y futuros
    document.querySelectorAll('.switch-tipo-elemento').forEach(function(checkbox) {
        // Inicializar el texto al cargar la página
        updateSwitchLabelAndValue(checkbox);

        // Añadir el listener para el evento 'change'
        checkbox.addEventListener('change', function() {
            updateSwitchLabelAndValue(this);
            // Aquí también deberías llamar a la función para cargar la lista de productos/insumos
            // loadElementsIntoSelect(this.closest('.elemento-promocion-row')); 
            // (La crearemos más adelante)
        });
    });

    // Código para el botón "Añadir Elemento" y manejo de nuevos renglones
    const elementosContainer = document.getElementById('elementos-promocion-container');
    const btnAgregarElemento = document.getElementById('btn-agregar-elemento');
    let rowCounter = 0; // Para IDs únicos

    if (elementosContainer && btnAgregarElemento) {
        // Inicializar el contador basado en elementos existentes si hay (ej. en edición)
        rowCounter = elementosContainer.querySelectorAll('.elemento-promocion-row').length;

        // Listener para añadir un nuevo renglón
        btnAgregarElemento.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'row g-3 align-items-end elemento-promocion-row mb-3 border p-2 rounded';
            newRow.innerHTML = `
                <div class="col-md-3">
                    <label class="form-label">Tipo:</label>
                    <div class="form-check form-switch custom-switch-v1 mb-2">
                        <input type="checkbox" class="form-check-input input-primary switch-tipo-elemento" 
                               id="switchTipoElemento_${rowCounter}" data-row-id="${rowCounter}" value="producto" checked>
                        <span class="form-check-label-text" for="switchTipoElemento_${rowCounter}">Producto</span>
                        <input type="hidden" name="tipo_elemento[]" class="hidden-tipo-elemento" value="producto">
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Elemento:</label>
                    <select class="form-control select-elemento" name="id_elemento[]" required>
                        <option value="">Cargando...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Cantidad:</label>
                    <input type="number" class="form-control cantidad-elemento" name="cantidad_elemento[]" min="1" value="1" required>
                </div>
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger btn-sm eliminar-elemento">
                        <i class="ti ti-trash"></i> Eliminar
                    </button>
                </div>
            `;
            elementosContainer.appendChild(newRow);

            // Importante: Añadir listeners a los nuevos elementos
            const newSwitch = newRow.querySelector('.switch-tipo-elemento');
            updateSwitchLabelAndValue(newSwitch); // Inicializar el nuevo switch
            newSwitch.addEventListener('change', function() {
                updateSwitchLabelAndValue(this);
                // loadElementsIntoSelect(newRow); // Cargar lista para el nuevo renglón
            });

            // Listener para el botón eliminar
            newRow.querySelector('.eliminar-elemento').addEventListener('click', function() {
                newRow.remove();
            });

            // Llama a la función para cargar los productos/insumos al añadir un nuevo renglón
            // loadElementsIntoSelect(newRow); 

            rowCounter++; // Incrementar el contador para el próximo renglón
        });
        
        // Listener para eliminar elementos existentes al cargar la página (para edición)
        elementosContainer.querySelectorAll('.eliminar-elemento').forEach(function(button) {
            button.addEventListener('click', function() {
                button.closest('.elemento-promocion-row').remove();
            });
        });
    }
});