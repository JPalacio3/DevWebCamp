import Swal from 'sweetalert2';

(function () {

    let eventos = [];

    const resumen = document.querySelector('#registro-resumen');
    const eventosBoton = document.querySelectorAll('.evento__agregar');
    eventosBoton.forEach(boton => boton.addEventListener('click',seleccionarEvento));

    function seleccionarEvento(e) {

        // Aplicamos distrusturing para evitar repetir tanto la e
        const { target } = e;

        // Validar que se pueda seleccionar un máximo de 5 eventos
        if (eventos.length < 5) {
            //Deshabilitar le evento una vez que ha sido seleccionado
            target.disabled = true;

            eventos = [ ...eventos,{
                id: target.dataset.id,
                titulo: target.parentElement.querySelector('.evento__nombre').textContent.trim()
            } ]

            mostrarEventos();
        } else {
            Swal.fire({
                title: 'Límite de eventos alcanzado',
                text: 'Solo se permite un máximo de 5 eventos',
                icon: 'info',
                confirmButtonText: 'OK'
            })
        }

    }

    function mostrarEventos() {

        //Limpiar el HTML
        limpiarEventos();

        if (eventos.length > 0) {
            eventos.forEach(evento => {
                const eventoDOM = document.createElement('DIV')
                eventoDOM.classList.add('registro__evento')


                const titulo = document.createElement('H3')
                titulo.classList.add('registro__nombre')
                titulo.textContent = evento.titulo

                // Botón de eliminar un elemento previamente seleccionado
                const botonEliminar = document.createElement('BUTTON')
                botonEliminar.classList.add('registro__eliminar')
                botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`
                botonEliminar.onclick = function () {
                    eliminarEvento(evento.id);
                }

                // Renderizar en el HTML
                eventoDOM.appendChild(titulo);
                eventoDOM.appendChild(botonEliminar);
                resumen.appendChild(eventoDOM);

            })
        }
    }

    function eliminarEvento(id) {
        eventos = eventos.filter(evento => evento.id !== id);
        const botonAgregar = document.querySelector(`[data-id="${id}"]`);
        botonAgregar.disabled = false;
        mostrarEventos();
    }

    function limpiarEventos() {
        while (resumen.firstChild) {
            resumen.removeChild(resumen.firstChild);
        }
    }
})();
