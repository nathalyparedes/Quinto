<?php
error_reporting(0); // Deshabilitar reporte de errores en producción
require_once('../config/cors.php');
require_once('../models/roles.model.php');

$roles = new Clase_Roles(); // Cambiado a $roles para mantener consistencia
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case "GET":
        if (isset($_GET["RolesId"])) {
            $RolesId = $_GET["RolesId"];
            $rol = $roles->uno($RolesId);
            if ($rol) {
                echo json_encode($rol);
            } else {
                echo json_encode(array("message" => "No se encontró el rol con ID $RolesId"));
            }
        } else {
            $datos = $roles->todos();
            $todos = array();
            while ($fila = mysqli_fetch_assoc($datos)) {
                array_push($todos, $fila);
            }
            echo json_encode($todos);
        }
        break;
    case "POST":
                $datos = json_decode(file_get_contents('php://input'));
                if (!empty($datos->detalle)) {
                    try {
                        $insertar = $roles->insertar($datos->detalle);
                        if ($insertar) {
                            echo json_encode(array("message" => "Se insertó correctamente"));
                        } else {
                            echo json_encode(array("message" => "Error, no se insertó"));
                        }
                    } catch (Exception $e) {
                        echo json_encode(array("message" => "Error en la base de datos: " . $e->getMessage()));
                    }
                } else {
                    echo json_encode(array("message" => "Error, faltan datos"));
                }
                break;
        
    case "PUT":
        $datos = json_decode(file_get_contents('php://input'));
        if (!empty($datos->RolesId) && !empty($datos->detalle)) {
            $actualizar = $roles->actualizar($datos->RolesId, $datos->detalle);
            if ($actualizar) {
                echo json_encode(array("message" => "Se actualizó correctamente"));
            } else {
                echo json_encode(array("message" => "Error, no se actualizó"));
            }
        } else {
            echo json_encode(array("message" => "Error, faltan datos"));
        }
        break;
    case "DELETE":
        $datos = json_decode(file_get_contents('php://input'));
        if (!empty($datos->RolesId)) {
            try {
                $eliminar = $roles->eliminar($datos->RolesId);
                if ($eliminar) {
                    echo json_encode(array("message" => "Se eliminó correctamente"));
                } else {
                    echo json_encode(array("message" => "Error, no se eliminó"));
                }
            } catch (Exception $th) {
                echo json_encode(array("message" => "Error, no se eliminó"));
            }
        } else {
            echo json_encode(array("message" => "Error, no se envió el ID"));
        }
        break;
}

