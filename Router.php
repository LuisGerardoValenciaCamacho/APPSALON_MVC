<?php 

namespace MVC;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $funcion) {
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion) {
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas() {
        session_start();
        $auth = $_SESSION["login"] ?? null;
        $urlActual = $_SERVER["REQUEST_URI"] === "" ? "/" : $_SERVER["REQUEST_URI"];
        $metodo = $_SERVER["REQUEST_METHOD"];
        if($metodo == "GET") {
            $funcion = $this->rutasGET[$urlActual] ?? null;
        } else {
            $funcion = $this->rutasPOST[$urlActual] ?? null;
        }
        if($funcion) {
            call_user_func($funcion, $this);
        } else {
            echo "PAGINA NO ENCONTRADA 404";
        }
    }

    public function render($view, $funcion) {
        foreach($funcion as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}

?>