<button class="botonAtras btn btn-light-secondary d-inline-flex position-absolute top-0 start-0">
    <i class="ti ti-arrow-back-up"></i> Regresar
</button>


<script>
    let botonAtras= document.querySelector('.botonAtras');
    botonAtras.addEventListener("click", function(e){
        e.preventDefault();
        window.history.back();
    })
</script>