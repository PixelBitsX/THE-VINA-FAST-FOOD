/* Enviar formularios via AJAX */
const formularios_ajax=document.querySelectorAll(".FormularioAjax");
formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",function(e){
        
        e.preventDefault(); //para que la pagina no se refresque

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Quieres realizar la acción solicitada",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed){

                let data = new FormData(this);
                let method=this.getAttribute("method");
                let action=this.getAttribute("action");
                let encabezados= new Headers();

                let config={
                    method: method,
                    headers: encabezados,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                fetch(action,config)
                .then(respuesta => respuesta.json())
                .then(respuesta =>{ 
                    return alertas_ajax(respuesta);
                });
            }
        });

    });
});

/*Alertas de los formularios que se envían via AJAX */
function alertas_ajax(alerta){
    if(alerta.tipo=="simple"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        });

    }else if(alerta.tipo=="recargar"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                location.reload();
            }
        });

    }else if(alerta.tipo=="limpiar"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                document.querySelector(".FormularioAjax").reset();
            }
        });

    }else if(alerta.tipo=="limpiar_registrar"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                document.querySelector(".FormularioAjax").reset();
                window.location.reload();
            }
        });

    }else if(alerta.tipo=="redireccionar"){
        swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href=alerta.url;
            }
        });
    }
}

/*Alertas para los botones de cerrar sesión*/
document.querySelectorAll('.cerrar_sesion').forEach(boton => {
    boton.addEventListener("click", function(e){
        e.preventDefault();

        Swal.fire({
            title: '¿Está seguro de cerrar la sesión?',
            text: "Si cierra la sesión deberá introducir de nuevo sus datos para acceder a las funciones del sistema",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed){
                let url = this.getAttribute("href");
                window.location.href = url;
            }
        });
    });
});



