(function () {

    const horas = document.querySelector('#horas');

    if (horas) {

        const categoria = document.querySelector('[name = "categoria_id"]');
        const dias = document.querySelectorAll('[name = "dia"]');
        const inputHiddenDia = document.querySelector('[name = "dia_id"]');
        const inputHiddenHora = document.querySelector('[name = "hora_id"]');

        categoria.addEventListener('change',terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change',terminoBusqueda));

        let busqueda = {
            categoria_id: '',
            dia: '',
        }

        function terminoBusqueda(e) {
            busqueda[ e.target.name ] = e.target.value;

            // Reiniciar los campos ocultos y el selector de horas
            inputHiddenHora.value = '';
            inputHiddenDia.value = '';


            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada')
            }

            // Verificar que el objeto esté completo para poder consultar la API
            if (Object.values(busqueda).includes('')) { return; } else { buscarEventos(); }
        }

        async function buscarEventos() {
            //Aplicamos destrucuring a la variable de busqueda, la cual contiene los valores de dia y categoria
            const { dia,categoria_id } = busqueda;

            // Creamos una URL que se asocie de manera dinámica a cada evento registtrado
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            const resultado = await fetch(url);
            const eventos = await resultado.json();
            obtenerHorasDisponibles(eventos); // Pasamos el parámetro eventos a la función
        }

        function obtenerHorasDisponibles(eventos) {

            // Reiniciar las horas
            const listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitada'));

            // Comprobar eventos ya tomados, y quitar la variable de deshabilitados
            horasTomadas = eventos.map(evento => evento.hora_id);

            const listadoHorasArray = Array.from(listadoHoras); // Listadohoras es un NodeList, para poder usar la función filter debemos convertirlo en un arreglo ya esta función solo está diseñada para arreglos y no para NodeList

            const resultado = listadoHorasArray.filter(li => !horasTomadas.includes(li.dataset.horaId));
            resultado.forEach(li => li.classList.remove('horas__hora--deshabilitada'));

            const HorasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');

            HorasDisponibles.forEach(hora => hora.addEventListener('click',seleccionarHora));
        }

        function seleccionarHora(e) {

            // Desahbilitar la hora previa si hay un nuevo click
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            // agregar la clase para resaltar la opción seleccionada
            e.target.classList.add('horas__hora--seleccionada');

            inputHiddenHora.value = e.target.dataset.horaId;

            // Llenar el campo oculto de día
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;

        }
    }
})();
