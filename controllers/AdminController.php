<?php 

namespace Controllers;

use MVC\Router;
use Model\Usuarios;
use Model\AdminCita;
use Model\Cita;
use Model\Servicios;

class AdminController {
    public static function index(Router $router) {
        isAuth();
        isAdmin();
        $id = $_SESSION["usuario"];
        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $formatoFecha = explode("-", $fecha);
        $errores = [];
        if(!checkdate($formatoFecha[1], $formatoFecha[2], $formatoFecha[1])) {
            header("Location: 404");
        }
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id_cita = $_POST["id_cita"];
            $cita = Cita::find($id_cita);
            $cita->eliminar();
        }
        $usuario = Usuarios::find($id);
        $nombre = $usuario->nombre . " " . $usuario->apellido;
        $citas = AdminCita::consulta($fecha);
        $router->render("admin/index", [
            "errores" => $errores,
            "usuario" => $nombre,
            "id" => $id,
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }

    public static function servicios(Router $router) {
        $servicios = Servicios::getAll();
        imprimir($servicios);
    }
}

?>