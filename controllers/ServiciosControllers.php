<?php

namespace Controllers;

use MVC\Router;
use Model\Usuarios;
use Model\Servicios;

class ServiciosControllers {
    public static function index(Router $router) {
        isAuth();
        isAdmin();
        $id = $_SESSION["usuario"];
        $errores = [];
        $usuario = Usuarios::find($id);
        $nombre = $usuario->nombre . " " . $usuario->apellido;
        $servicios = Servicios::getAll();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $servicio = Servicios::find($_POST["id_servicio"]);
            $servicio->eliminar();
            header("Location: /servicios");
        }
        $router->render("admin/servicios", [
            "errores" => $errores,
            "usuario" => $nombre,
            "id" => $id,
            "servicios" => $servicios
        ]);
    }

    public static function crear(Router $router) {
        isAuth();
        isAdmin();
        $id = $_SESSION["usuario"];
        $errores = [];
        $usuario = Usuarios::find($id);
        $nombre = $usuario->nombre . " " . $usuario->apellido;
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $servicio = new Servicios($_POST);
            $errores = $servicio->errores();
            if(!$errores) {
                $servicio->guardar();
                header("Location: /servicios");
            }
        }
        $router->render("admin/crear", [
            "errores" => $errores,
            "usuario" => $nombre,
            "id" => $id
        ]);
    }

    public static function actualizar(Router $router) {
        isAuth();
        isAdmin();
        $id = $_SESSION["usuario"];
        $id_servicio = $_GET["id"] ?? $_GET["id"];
        $servicio = Servicios::find($id_servicio);
        $usuario = Usuarios::find($id);
        $nombre = $usuario->nombre . " " . $usuario->apellido;
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $args = $_POST;
            $servicio->sincronizar($args);
            $errores = $servicio->validarErrores();
            if(!$errores) {
                $servicio->guardar();
                header("Location: /servicios");
            }
        }
        $router->render("admin/actualizar", [
            "errores" => $errores,
            "usuario" => $nombre,
            "id" => $id,
            "servicio" => $servicio
        ]);
    }
}

?>