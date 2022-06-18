<?php 

namespace Controllers;

use Model\Usuarios;
use MVC\Router;

class CitasControllers {
    public static function citas(Router $router) {
        isAuth();
        $id = $_SESSION["usuario"];
        $usuario = Usuarios::find($id);
        $nombre = $usuario->nombre . " " . $usuario->apellido;
        $router->render("paginas/principal", [
            "usuario" => $nombre,
            "id" => $id
        ]);
    }

    public static function logout(Router $router) {
        $_SESSION = null;
        header("Location: /");
    }
}

?>