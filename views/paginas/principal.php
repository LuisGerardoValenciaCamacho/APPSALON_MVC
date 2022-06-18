<header class="header">
    <h1>App Peluqueria</h1>
    <h2>Crea una nueva cita</h2>
    <p>Elige tus servicios y coloca tus datos</p>
</header>
<section class="extras-principal">
    <div class="extras-principal-usuario">
        <p>Hola: <span id="usuario"><?php echo $usuario; ?></span></p>    
    </div>
    <form class="cerrar-sesion" method="POST">
        <input type="submit" value="Cerrar Sesión" class="boton-block">
    </form>
</section>
<nav class="tabs">
    <button type="button" data-paso="1">Servicios</button>
    <button type="button" data-paso="2">Información Cliente</button>
    <button type="button" data-paso="3">Resumen</button>
</nav>
<div id="paso-1" class="seccion">
    <h3>Servicios</h3>
    <p class="text-center">Elige tus Servicios a Continuación</p>
    <div id="servicios" class="listado-servicios"></div>
</div>
<div id="paso-2" class="seccion">
    <h3>Tus Datos y cita</h3>
    <p class="text-center"> Coloca tus datos y fecha de tu cita</p>
    <form class="formulario">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder='<?php echo $usuario; ?>' value='<?php echo $usuario; ?>' disabled>
        </div>
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha">
        </div>
        <div class="campo">
            <label for="hora">Hora:</label>
            <input type="time" id="hora">
        </div>
        <input type="hidden" id="id", value="<?php echo $id; ?>">
    </form>
</div>
<div id="paso-3" class="seccion contenido-resumen">
    <h3>Resumen</h3>
</div>
    <div class="paginacion">
        <button id="anterior">&laquo; Anterior</button>
        <button id="siguiente">Siguiente &raquo;</button>
    </div>
</div>