<main class="contenedor">
    <h2 class="titulo-login">Login</h2>
    <p class="parrafo-login">Inicia sesión con tus datos</p>
    <?php if(isset($accion)): ?>
        <div class="mensaje-accion">
            <h3><?php echo mostrarNotificaciones($accion); ?></h3>
        </div>
    <?php endif; ?>
    <?php foreach($errores as $error): ?>
        <div class="mensajes-error">
            <h3><?php echo $error; ?></h3>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
        <div class="campo">
            <label for="email">E-MAIL:</label>
            <input type="email" placeholder="Tu E-mail" name="email" id="email" required>
        </div>
        <div class="campo">
            <label for="password">PASSWORD:</label>
            <input type="password" placeholder="Tu Password" name="password" id="password" required>
        </div>
        <input type="submit" value="Iniciar Sesión" class="boton-block">
    </form>
    <section class="loginExtra">
        <div class="registro">
            <p>¿Aún no tienes una cuenta? <a href="/public/registro">Crea una</a></p>
        </div>
        <div class="password">
            <a href="/public/olvide">¿Olvidaste tu password?</a>
        </div>
    </section>
</main>