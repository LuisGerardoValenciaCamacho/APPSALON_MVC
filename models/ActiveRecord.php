<?php 

namespace Model;

class ActiveRecord {
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";
    protected static $errores = [];

    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            return $this->actualizar();
        } else {
            return $this->crear();
        }
    }

    public function crear() {
        $atributos = $this->sanitizarAtributos();
        $QUERY_INSERTAR = "INSERT INTO " . static::$tabla ." (" . join(", ", array_keys($atributos)) . ") VALUES ('" . join("', '", array_values($atributos)) . "')";
        $resultado = self::$db->query($QUERY_INSERTAR);
        return [
            "resultado" => $resultado,
            "id" => self::$db->insert_id
        ];
    }

    public function actualizar() {
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "$key = '$value'";
        }
        $QUERY_ACTUALIZAR = "UPDATE " . static::$tabla ." SET " . join(', ', $valores) . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($QUERY_ACTUALIZAR);
        return $resultado;
    }

    public function eliminar() {
        $QUERY_ELIMINAR = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($QUERY_ELIMINAR);
        return $resultado;
    }

    public function atributos() : array {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() : array {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            if(!is_null($value)) {
                $sanitizado[$key] = self::$db->escape_string($value);
            } else {
                $sanitizado[$key] = null;
            }
        }
        return $sanitizado;
    }

    public function validarErrores() : array {
        static::$errores = [];
        return static::$errores;
    }

    public static function getErrores() : array {
        return static::$errores;
    }

    public static function getAll() {
        $QUERY_OBTENER = "SELECT * FROM " . static::$tabla;
        $datos = self::consultarSQL($QUERY_OBTENER);
        return $datos;
    }

    public static function find($id) {
        $QUERY_OBTENER = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $datos = self::consultarSQL($QUERY_OBTENER);
        return array_shift($datos);
    }

    public static function where($columna, $token) {
        $QUERY_OBTENER = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$token'";
        $datos = self::consultarSQL($QUERY_OBTENER);
        return array_shift($datos);
    }

    public static function SQL($QUERY) {
        $datos = self::consultarSQL($QUERY);
        return $datos;
    }

    public static function getRegistros($cantidad) {
        $QUERY_OBTENER = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $datos = self::consultarSQL($QUERY_OBTENER);
        return $datos;
    }

    public function get($limit) {
        $QUERY = "SELECT * FROM " . static::$tabla . " WHERE email = '$this->email' LIMIT $limit";
        $resultado = self::$db->query($QUERY);
        if($resultado->num_rows) {
            return true;
        }
        return false;
    }

    public static function consultarSQL($QUERY) {
        $resultado = self::$db->query($QUERY);
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}