<main>
    <h2 class="titulo-login">Olvide mi contraseña</h2>
    <p class="parrafo-login">Se le enviara un correo para cambiar su password</p>
    <?php foreach($errores as $error): ?>
        <div class="mensajes-error">
            <h3><?php echo $error; ?></h3>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
        <div class="campo">
            <label for="email">E-MAIL:</label>
            <input type="email" placeholder="Tu E-mail" name="email" id="email">
        </div>
        <section class="registro-extra">
            <div>
                <input type="submit" value="Enviar" class="boton-block">
            </div>
            <div class="volver">
                <a href="/public">Volver</a>
            </div>
        </section>
    </form>
</main>