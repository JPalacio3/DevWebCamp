(function () {

    const ponentesInput = document.querySelector('#ponentes');

    if (ponentesInput) {
        let ponentes = [];
        let ponentesFiltrados = [];
        const listadoPonentes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('[name="ponente_id"]');

        obtenerPonentes();

        // Escuchar por el evento de escritura en el input
        ponentesInput.addEventListener('input',buscarPonentes);

        // Comprobar que el input hidden de ponente tenga un valor asignado
        if (ponenteHidden.value) {
            (async () => {
                const ponente = await obtenerPonente(ponenteHidden.value);
                const { nombre,apellido } = ponente;

                // Insertar en el HTML
                const ponenteDOM = document.createElement('LI');
                ponenteDOM.classList.add('listado-ponentes__ponente','listado-ponentes__ponente--seleccionado');
                ponenteDOM.textContent = `${nombre} ${apellido}`;

                listadoPonentes.appendChild(ponenteDOM);
            })()
        }

        async function obtenerPonentes() {
            // Asignamos una URL para hacer el llamado de la API
            const url = `/api/ponentes`;

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearPonentes(resultado);
        }

        //obtener un único ponente por su id
        async function obtenerPonente(id) {
            // Asignamos una URL para hacer el llamado de la API
            const url = `/api/ponente?id=${id}`;

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            return resultado;
        }

        function formatearPonentes(arrayPonentes = []) {
            ponentes = arrayPonentes.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })
        }

        function buscarPonentes(e) {
            const busqueda = e.target.value;

            if (busqueda.length > 3) {
                // Esta expresión regular permite realizar una búsqueda indistintamente de que la palabra esté escrita en mayúsculas o minúsculas
                const expresion = new RegExp(busqueda,"i");
                ponentesFiltrados = ponentes.filter(ponente => {

                    if (ponente.nombre.toLowerCase().search(expresion) != -1) {
                        return ponente;
                    }
                })
            } else { ponentesFiltrados = []; }

            mostrarPonentes();
        }

        function mostrarPonentes() {

            // limpiar el renderizado de la búsqueda para evitar que se repitan las búsquedas
            // listadoPonentes.innerHTML = '';
            while (listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if (ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('LI');
                    ponenteHTML.classList.add('listado-ponentes__ponente');
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;
                    ponenteHTML.onclick = seleccionarPonente;

                    // Añadir el elemento al DOM
                    listadoPonentes.appendChild(ponenteHTML);
                })
            } else {
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-ponentes__no.resultado');
                noResultados.textContent = 'No hay resultados para tu búsqueda';
                // Añadir el elemento al DOM
                listadoPonentes.appendChild(noResultados);
            }
        }

        function seleccionarPonente(e) {
            const ponente = e.target;

            // Remover la clase previa
            const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');
            if (ponentePrevio) { ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado'); }


            ponente.classList.add('listado-ponentes__ponente--seleccionado');

            // Asignamos el valor de la selección al input oculto
            ponenteHidden.value = ponente.dataset.ponenteId;
        }
    }
})();
