<h2 class="dashboard__heading"><?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"> </i>
        Añadir Evento
    </a>
</div>

<!-- Tabla para mostrar todos los ponentes -->

<div class="dashboard__contenedor">
    <?php if (!empty($ponentes)) { ?>
        <table class="table">

            <thead class="table__thead">
                <tr>
                    <th class="table__th">Nombre </th>
                    <th class="table__th">Ubicación </th>
                    <th class="table__th">Experiencia </th>
                    <th class="table__th"> </th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php
                foreach ($ponentes as $ponente) { ?>
                    <tr class="table__tr">

                        <td class="table__td"><?php echo $ponente->nombre . ' ' . $ponente->apellido; ?> </td>
                        <td class="table__td"><?php echo $ponente->ciudad . ', ' . $ponente->pais; ?> </td>
                        <td class="table__td"><?php echo $ponente->tags; ?> </td>

                        <td class="table__td--acciones">

                            <a class="table__accion table__accion--editar" href="/admin/eventos/editar?id=<?php echo $ponente->id; ?>"> <i class="fa-solid fa-user-pen"></i>Editar
                            </a>

                            <form action="/admin/eventos/eliminar" class="table__formulario" method="POST">
                                <input type="hidden" name="id" value="<?php echo $ponente->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>

                        </td>

                    </tr>
                <?php } ?>





            </tbody>

        </table>

    <?php } else { ?>
        <p class="text-center"> No Hay Eventos Aún</p>
    <?php } ?>
</div>

<?php
// echo $paginacion;
?>
