<?php 

namespace Controllers;

use Model\Servicios;
use Model\Cita;
use Model\CitaServicio;

class ApiControllers {
    public static function index() {
        $servicios = Servicios::getAll();
        $json["servicios"] = $servicios;
        echo json_encode($json);
    }

    public static function guardar() {
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado["id"];
        $idServicios = explode(",", $_POST["servicios"]);
        foreach($idServicios as $idServicio) {
            $args = [
                "id_cita" => $id,
                "id_servicio" => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        $respuesta = ["resultado" => $resultado];
        echo json_encode($respuesta);
    }
}

?>