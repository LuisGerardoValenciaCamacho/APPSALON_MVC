<header class="header header-admin">
    <h2>Panel de Administración</h2>
</header>
<section class="extras-principal">
    <div class="extras-principal-usuario">
        <p>Hola: <span id="usuario"><?php echo $usuario; ?></span></p>    
    </div>
    <form class="cerrar-sesion" method="POST" action="/citas">
        <input type="submit" value="Cerrar Sesión" class="boton-block">
    </form>
</section>
<nav class="tabs">
    <a class="boton" href="/admin" id="verCitas">Ver Citas</a>
    <a class="boton" href="/servicios" id="verServicios">Ver Servicios</a>
    <a class="boton" href="/servicios/crear" id="newServicio">Nuevo Servicio</a>
</nav>
<div class="seccion-servicios">
    <h3>Agregar Servicio</h3>
    <?php foreach($errores as $error): ?>
        <div class="mensajes-error">
            <h3><?php echo $error; ?></h3>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
        <div class="campo">
            <label for="name">Nombre:</label>
            <input type="text" placeholder="Nombre del Servicio" name="nombre" id="name">
        </div>
        <div class="campo">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio">
        </div>
        <input type="submit" class="boton-block" value="Agregar Servicio" id="nuevoServicio">
    </form>
</div>