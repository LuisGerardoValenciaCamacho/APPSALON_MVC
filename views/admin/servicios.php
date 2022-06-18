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
<section>
    <div class="seccion-servicios">
        <h3>Servicios</h3>
        <?php foreach($servicios as $servicio): ?>
            <hr>
            <section class="busqueda-servicios-admin">
                <div class="servicio">
                    <p><?php echo $servicio->nombre ?></p>
                </div>
                <div class="servicio">
                    <p><?php echo "$ " . $servicio->precio ?></p>
                </div>
                <div class="servicio">
                    <a class="boton-block-amarillo" href="/servicios/actualizar?id=<?php echo $servicio->id ?>">Actualizar</a>
                </div>
                <form class="formulario servicio" method="POST" action="/servicios">
                    <input type="hidden" name="id_servicio" value="<?php echo $servicio->id; ?>">
                    <input type="submit" value="Eliminar" class="boton-block-rojo">
                </form>
            </section>
        <?php endforeach; ?>
    </div>
</section>