<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?> </h2>
    <p class="auth__texto">Regístrate en DevWebcamp</p>

    <form class="formulario" action="">

        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre: </label>
            <input type="text" class="formulario__input" placeholder="Tu nombre" id="nombre" name="nombre" />
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido: </label>
            <input type="text" class="formulario__input" placeholder="Tu apellido" id="apellido" name="apellido" />
        </div>


        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email: </label>
            <input type="email" class="formulario__input" placeholder="Tu email" id="email" name="email" />
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password: </label>
            <input type="password" class="formulario__input" placeholder="Tu password" id="password" name="password" />
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repite tu Password: </label>
            <input type="password" class="formulario__input" placeholder="Tu password" id="password2"
                name="password2" />
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace"> ¿Ya tienes una cuenta?, Inicia Sesión </a>
        <a href="/olvide" class="acciones__enlace"> ¿Olvidaste tu contraseña? </a>
    </div>


</main>