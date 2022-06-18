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
    <div class="busqueda">
        <h3>Buscar Citas</h3>
        <form class="formulario">
            <div class="campo">
                <label>Fecha:</label>
                <input type="date" id="fechaAdmin" value="<?php echo $fecha ?>">
            </div>
        </form>
    </div>
    <div class="busqueda">
        <?php if(!$citas): ?>
            <h3>No hay citas en esta fecha</h3>
        <?php else: ?>
            <?php $idCita = 0; ?>
            <?php foreach($citas as $cita): ?>
                <?php if($idCita != $cita->id): ?>
                    <hr>
                    <h4>Datos de la cita</h4>
                    <div class="busqueda-datos">
                        <p>Hora: <span><?php echo formatoHora($cita->hora) ?></span></p>
                        <p>Cliente: <span><?php echo $cita->cliente ?></span></p>
                        <p>E-mail: <span><?php echo $cita->email ?></span></p>
                        <p>Telefono: <span><?php echo $cita->telefono ?></span></p>
                    </div>
                    <h4>Servicios</h4>
                    <?php $total = 0; ?>
                    <?php foreach($citas as $servicio): ?>
                        <?php if($servicio->id == $cita->id): ?>
                            <section class="busqueda-servicios">
                                <div>
                                    <p><?php echo $servicio->servicio ?></p>
                                </div>
                                <div>
                                    <p><?php echo "$ " . $servicio->precio ?></p>
                                    <?php $total += $servicio->precio; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                    <?php endforeach;?>
                    <?php $idCita = $cita->id; ?>
                    <div class="busqueda-datos">
                        <p class="alinear-derecha">Total: <span><?php echo "$ " . $total; ?></span></p>
                    </div>
                    <form method="POST" acction="/admin">
                        <input type="submit" value="Eliminar" class="boton-block-rojo">
                        <input type="hidden" value="<?php echo $cita->id; ?>" name="id_cita">
                    </form>
                <?php endif; ?>
            <?php endforeach;?>
        <?php endif; ?>
    </div>
</section>