<main>
    <h2 class="titulo-login">Confirma Cuenta</h2>
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
</main>