<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?> </h2>
    <p class="auth__texto">Escribe tu nueva contraseña</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if($token_valido) { ?>
    <form class="formulario" method="POST">
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Email: </label>
            <input type="password" class="formulario__input" placeholder="Tu Nueva Contraseña" id="password"
                name="password" />
        </div>

        <input type="submit" class="formulario__submit" value="Guardar Contraseña">
    </form>
    <?php  } ?>
    <div class="acciones">
        <a href="/" class="acciones__enlace"> ¿Ya tienes una cuenta?, Inicia Sesión </a>
        <a href="/registro" class="acciones__enlace"> ¿Aún no tienes una cuenta?, Obtener una </a>
    </div>
</main>
