<?php 

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = "citasservicios";
    protected static $columnasDB = ["id", "hora", "cliente", "email", "telefono", "servicio", "precio"];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->hora = $args["hora"] ?? "";
        $this->cliente = $args["cliente"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->servicio = $args["servicio"] ?? "";
        $this->precio = $args["precio"] ?? "";
    }

    public static function consulta($fecha) {
        $QUERY = "SELECT citas.id, citas.hora, concat(usuarios.nombre,  ' ', usuarios.apellido) as cliente, usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio FROM citas left outer join usuarios on citas.id_usuario = usuarios.id left outer join citasservicios on citasservicios.id_cita = citas.id left outer join servicios on servicios.id = citasservicios.id_servicio where citas.fecha = '$fecha'";
        return self::SQL($QUERY);
    }
}

?>