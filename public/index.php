<?php

require __DIR__ . "/../includes/app.php";

use MVC\Router;
use Controllers\LoginControllers;
use Controllers\CitasControllers;
use Controllers\ApiControllers;
use Controllers\AdminController;
use Controllers\ServiciosControllers;

$router = new Router;

$router->get("/", [LoginControllers::class, "login"]);
$router->get("/registro", [LoginControllers::class, "registro"]);
$router->get("/olvide", [LoginControllers::class, "olvide"]);
$router->get("/recuperar", [LoginControllers::class, "recuperar"]);
$router->get("/confirmar-cuenta", [LoginControllers::class, "confirmar"]);
$router->get("/mensaje", [LoginControllers::class, "mensaje"]);
$router->get("/citas", [CitasControllers::class, "citas"]);
$router->get("/mensaje-password", [LoginControllers::class, "mensajePassword"]);
$router->get("/api/servicios", [ApiControllers::class, "index"]);
$router->get("/admin", [AdminController::class, "index"]);
$router->get("/servicios", [ServiciosControllers::class, "index"]);
$router->get("/servicios/crear", [ServiciosControllers::class, "crear"]);
$router->get("/servicios/actualizar", [ServiciosControllers::class, "actualizar"]);

$router->post("/", [LoginControllers::class, "login"]);
$router->post("/registro", [LoginControllers::class, "registro"]);
$router->post("/olvide", [LoginControllers::class, "olvide"]);
$router->post("/recuperar", [LoginControllers::class, "recuperar"]);
$router->post("/api/citas", [ApiControllers::class, "guardar"]);
$router->post("/citas", [CitasControllers::class, "logout"]);
$router->post("/admin", [AdminController::class, "index"]);
$router->post("/servicios", [ServiciosControllers::class, "index"]);
$router->post("/servicios/crear", [ServiciosControllers::class, "crear"]);
$router->post("/servicios/actualizar", [ServiciosControllers::class, "actualizar"]);

$router->comprobarRutas();

?>