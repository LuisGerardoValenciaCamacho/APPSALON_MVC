<main>
    <h2 class="titulo-login">Registro</h2>
    <?php foreach($errores as $error): ?>
        <div class="mensajes-error">
            <h3><?php echo $error; ?></h3>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Tu Nombre" name="registro[nombre]" id="nombre">
        </div>
        <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" placeholder="Tu Apellido" name="registro[apellido]" id="apellido">
        </div>
        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="email" placeholder="Tu E-mail" name="registro[email]" id="email">
        </div>
        <div class="campo">
            <label for="password">Password:</label>
            <input type="password" placeholder="Tu Password" name="registro[password]" id="password">
        </div>
        <div class="campo">
            <label for="telefono">Telefono:</label>
            <input type="number" placeholder="Tu Telefono" name="registro[telefono]" id="telefono">
        </div>
        <section class="registro-extra">
            <div>
                <input type="submit" value="Registrarse" class="boton-block">
            </div>
            <div class="volver">
                <a href="/public">Volver</a>
            </div>
        </section>
    </form>
</main>