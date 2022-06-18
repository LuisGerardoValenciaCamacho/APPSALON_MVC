<main>
    <h2 class="titulo-login">Recuperar password</h2>
    <p class="parrafo-login">Introduce el nuevo password</p>
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
            <label for="password">PASSWORD:</label>
            <input type="password" placeholder="Tu Password Nuevo" name="password" id="password" required>
        </div>
        <div class="campo">
            <label for="passwordReply">PASSWORD REPLY:</label>
            <input type="password" placeholder="Tu Password Nuevo Confirmar" name="passwordReply" id="passwordReply" required>
        </div>
        <input type="submit" value="Cambiar" class="boton-block">
    </form>
</main>