<?php

define("FUNCIONES_URL", "funciones.php");
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function debuguear($informacion) {
    echo "<pre>";
    var_dump($informacion);
    echo "</pre>";
    exit;
}

function sanitizar($html) : string {
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

function validarTipoContenido($tipo) {
    $tipos = ["usuario", "propiedad"];
    return in_array($tipo, $tipos);
}

function mostrarNotificaciones($codigo) {
    $mensaje = "";
    switch($codigo) {
        case 1:
            $mensaje = "Usuario registrado correctamente";
            break;
        case 2:
            $mensaje = "Password actualizado correctamente";
            break;
        case 3:
            $mensaje = "Cuenta confirmada exitosamente";
            break;
        case 4:
            $mensaje = "Cambio de password exitoso";
            break;
        case 5:
            $mensaje = "Vendedor actualizada correctamente";
            break;
        case 6:
            $mensaje = "Vendedor eliminada correctamente";
            break;
        default:
            $mensaje = null;
            break;
    }
    return $mensaje;
}

function validar(string $url) {
    $id = $_GET["id"] ?? $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("location: $url");
    }
    return $id;
}

function isAuth() {
    if(!isset($_SESSION["login"])) {
        header("Location: /");
    }
}

function isAdmin() {
    if(!$_SESSION["admin"]) {
        header("Location: /");
    }
}

function formatoHora($hora) {
    $time = explode(":", $hora);
    $hour = ($time[0] > 12) ? $time[0] - 12 : $time[0];
    $min = $time[1];
    $formato = $time[0] > 12 ? "PM" : "AM";
    return $hour . ":" . $min . " " . $formato;
}

function imprimir($informacion) {
    echo "<pre>";
    var_dump($informacion);
    echo "</pre>";
}