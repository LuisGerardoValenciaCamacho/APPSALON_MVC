<?php

namespace Controllers;

use Model\Usuarios;
use MVC\Router;
use Classes\Email;

class LoginControllers {
    public static function login(Router $router) {
        $errores = [];
        $accion = $_GET["accion"] ?? null;
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = Usuarios::where("email", $_POST["email"]);
            if($usuario->email == $_POST["email"]) {
                if(password_verify($_POST["password"], $usuario->password)) {
                    if($usuario->confirmado == 1) {
                        session_start();
                        $_SESSION["login"] = true;
                        $_SESSION["usuario"] = $usuario->id;
                        if($usuario->admin == 1) {
                            header("Location: /admin");
                            $_SESSION["admin"] = true;
                        } else {
                            header("Location: /citas");
                        }
                    } else {
                        $errores[] = "La cuenta no esta confirmada";
                    }
                } else {
                    $errores[] = "Constraseña incorrecta";
                }
            } else {
                $errores[] = "El correo no existe";
            }
        }
        $router->render("auth/login", [
            "errores" => $errores,
            "accion" => $accion
        ]);
    }

    public static function registro(Router $router) {
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuarios($_POST["registro"]);
            $errores = $usuario->validarRegistro();
            if(!$errores) {
                if($usuario->get(1)) {
                    $errores[] = "El usuario ya existe";
                } else {
                    $usuario->setToken();
                    $usuario->hashPassword();
                    $usuario->guardar();
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();
                    header("Location: /mensaje");
                }
            }
        }
        $router->render("auth/registro", [
            "errores" => $errores
        ]);
    }

    public static function olvide(Router $router) {
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST["email"]) {
                $usuario = Usuarios::where("email", $_POST["email"]);
                if(!$usuario->get(1)) {
                    $errores[] = "El usuario no existe";
                } else {
                    if($usuario->confirmado == 1) {
                        $usuario->setToken();
                        $email = new Email($usuario->nombre, $usuario->correo, $usuario->token);
                        $email->enviarRecuperacion();
                        header("Location: /mensaje-password");
                    } else {
                        $errores[] = "El usuario no ha sido confirmado";
                    }
                }
            } else {
                $errores[] = "E-mail vacio";
            }
        }
        $router->render("auth/olvide", [
            "errores" => $errores
        ]);
    }

    public static function recuperar(Router $router) {
        $errores = [];
        $accion = null;
        $token = sanitizar($_GET["token"]);
        $usuario = Usuarios::where("token", $token);
        if(empty($usuario)) {
            $errores[] = "Token invalido";
        } else {
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if($_POST["password"] == $_POST["passwordReply"]) {
                    $usuario->password = $_POST["password"];
                    $usuario->token = null;
                    $usuario->hashPassword();
                    $usuario->guardar();
                    $accion = 4;
                } else {
                    $errores[] = "Contraseñas no coinciden";
                }
            }
        }
        $router->render("auth/recuperar", [
            "errores" => $errores,
            "accion" => $accion
        ]);
    }

    public static function confirmar(Router $router) {
        $errores = [];
        $accion = null;
        $token = sanitizar($_GET["token"]);
        $usuario = Usuarios::where("token", $token);
        if(empty($usuario)) {
            $errores[] = "Token invalido";
        } else {
            $usuario->confirmado = 1;
            $usuario->token = null;
            $accion = "3";
            $usuario->guardar();
        }
        $router->render("auth/confirmar", [
            "errores" => $errores,
            "accion" => $accion
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render("auth/mensaje", [
            "titulo" => "Confirma tu cuenta",
            "subtitulo" => "Hemos enviado las instrucciones para confirmar la cuenta en tu e-mail"
        ]);
    }

    public static function mensajePassword(Router $router) {
        $router->render("auth/mensaje", [
            "titulo" => "Cambiar password",
            "subtitulo" => "Hemos enviado las instrucciones para cambiar tu password en tu cuenta de e-mail"
        ]);
    }
}

?>