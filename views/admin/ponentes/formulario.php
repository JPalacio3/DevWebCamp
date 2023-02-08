<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre: </label>
        <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Ponente" value="<?php echo $ponente->nombre ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido: </label>
        <input type="text" class="formulario__input" id="apellido" name="apellido" placeholder="Apellido Ponente" value="<?php echo $ponente->apellido ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="ciudad" class="formulario__label">Ciudad: </label>
        <input type="text" class="formulario__input" id="ciudad" name="ciudad" placeholder="Ciudad" value="<?php echo $ponente->ciudad ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="pais" class="formulario__label">País: </label>
        <input type="text" class="formulario__input" id="pais" name="pais" placeholder="Pais" value="<?php echo $ponente->pais ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imágen: </label>
        <input type="file" class="formulario__input formulario__input--file " id="imagen" name="imagen">
    </div>

    <?php if (isset($ponente->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen actual: </p>

        <div class="formulario__imagen">
            <picture class="formulario_imagen--picture">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen; ?>.png" alt="imagen ponente">
            </picture>
        </div>

    <?php } ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label for="tags_input" class="formulario__label">Áreas de Experiencia ( Separadas por comas ): </label>
        <input type="text" class="formulario__input" id="tags_input" placeholder="Ej.  Node.js, PHP, Laravel, UX / UI">
        <div class="formulario__listado" id="tags"></div>
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? ''; ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>

    <!-- facebook -->
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[facebook]" value="<?php echo $redes->facebook ?? ''; ?>" placeholder="facebook">
        </div>
    </div>

    <!-- Twitter -->
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[twitter]" value="<?php echo $redes->twitter ?? ''; ?>" placeholder="Twitter">
        </div>
    </div>

    <!-- Youtube -->
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[youtube]" value="<?php echo $redes->youtube ?? ''; ?>" placeholder="Youtube">
        </div>
    </div>

    <!-- Instagram -->
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[instagram]" value="<?php echo $redes->instagram ?? ''; ?>" placeholder="Instagram">
        </div>
    </div>

    <!-- TikTok -->
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[tiktok]" value="<?php echo $redes->tiktok ?? ''; ?>" placeholder="TikTok">
        </div>
    </div>

    <!-- GitHub -->
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input type="text" class="formulario__input--sociales" name="redes[github]" value="<?php echo $redes->github ?? ''; ?>" placeholder="GitHub">
        </div>
    </div>
</fieldset>
