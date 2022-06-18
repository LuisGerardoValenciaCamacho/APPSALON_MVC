<?php

namespace Model;

class Servicios extends ActiveRecord {
    protected static $tabla = "servicios";
    protected static $columnasDB = ["id", "nombre", "precio"];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->precio = $args["precio"] ?? "";
    }

    public function errores() {
        if(!$this->nombre) self::$errores[] = "Nombre Vacio";
        if(!$this->precio) self::$errores[] = "Precio Vacio";
        return self::$errores;
    }
}

?>