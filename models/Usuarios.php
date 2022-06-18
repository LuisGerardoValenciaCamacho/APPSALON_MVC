<?php 

namespace Model;

class Usuarios extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "apellido", "email", "password", "telefono", "admin", "confirmado", "token"];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = null) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? null;
        $this->apellido = $args["apellido"] ?? null;
        $this->password = $args["password"] ?? null;
        $this->email = $args["email"] ?? null;
        $this->telefono = $args["telefono"] ?? null;
        $this->admin = $args["admin"] ?? 0;
        $this->confirmado = $args["confirmado"] ?? 0;
        $this->token = $args["token"] ?? null;
    }

    public function validarRegistro() {
        if(!$this->nombre) self::$errores[] = "Nombre Vacio";
        if(!$this->apellido) self::$errores[] = "Apellido Vacio";
        if(!$this->email) self::$errores[] = "E-mail Vacio";
        if(!$this->password) self::$errores[] = "Password Vacio"; 
        if(!$this->telefono) self::$errores[] = "Telefono Vacio";
        return self::$errores;
    }

    public function setAdmin() {
        $this->admin = 1;
    }

    public function setconfirmado() {
        $this->confirmado = 1;
    }
    
    public function setToken() {
        $this->token = uniqid();
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
}

?>