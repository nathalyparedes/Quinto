<?php
error_reporting(0); // Deshabilitar reporte de errores en producción
require_once('../config/cors.php');
require_once('../models/usuarios_roles.model.php');

$UsuariosRoles = new Clase_UsuariosRoles(); // Cambiado a $UsuariosRolespara mantener consistencia
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case "GET":
        if (isset($_GET["UsuariosRolesId"])) {
            $UsuariosRolesId = $_GET["UsuariosRolesId"];
            $uno = $UsuariosRoles->uno($UsuariosRolesId);
            if ($uno) {
                echo json_encode(mysqli_fetch_assoc($uno));
            } else {
                echo json_encode(array("message" => "No se encontró el rol con ID $UsuariosRolesId"));
            }
        } else {
            $datos = $UsuariosRoles->todos();
            $todos = array();
            while ($fila = mysqli_fetch_assoc($datos)) {
                array_push($todos, $fila);
            }
            echo json_encode($todos);
        }
        break;
    case "POST":
                $datos = json_decode(file_get_contents('php://input'));
                if (!empty($datos->IdRoles)|| !empty($datos->IdUsuarios)) {
                    try {
                        $insertar = $UsuariosRoles->insertar($datos->IdRoles, $datos->IdUsuarios);
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
        if (!empty($datos->IdRoles) && !empty($datos->IdUsuarios)) {
            $actualizar = $UsuariosRoles->actualizar($datos-> UsuariosRolesId, $datos->IdRoles, $datos->IdUsuarios);
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
        if (!empty($datos->UsuariosRolesId)) {
            try {
                $eliminar = $UsuariosRoles->eliminar($datos->UsuariosRolesId);
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

