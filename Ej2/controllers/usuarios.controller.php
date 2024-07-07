<?php
error_reporting(0);
require_once('../config/cors.php');
require_once('../models/usuarios.model.php');

$usuario = new Clase_Usuarios();
$metodo = $_SERVER['REQUEST_METHOD'];

//$_POST   insertar
//$_GET    select 
// $_PUT   actualizar
//$_DELETE   eliminar
//www.google.com?Nombre=Luis

switch ($metodo) {
    case "GET":
        if (isset($_GET["UsuarioId"])) {
            $uno = $usuario->uno($_GET["UsuarioId"]);
            echo json_encode(mysqli_fetch_assoc($uno));
        } else {
            $datos = $usuario->todos();
            $todos = array();
            while ($fila = mysqli_fetch_assoc($datos)) {
                array_push($todos, $fila);
            }
            echo json_encode($todos);
        }
        break;
    case "POST":
        $datos = json_decode(file_get_contents('php://input'));
        if (!empty($datos->correo) || !empty($datos->password) || !empty($datos->estado)) {
            $insetar = array();
            $insetar = $usuario->insertar($datos->Nombre, $datos->correo, $datos->password, $datos->estado);
            if ($insetar) {
                echo json_encode(array("message" => "Se inserto correctamente"));
            } else {
                echo json_encode(array("message" => "Error, no se inserto"));
            }
        } else {
            echo json_encode(array("message" => "Error, faltan datos"));
        }
        break;
    case "PUT":
        $datos = json_decode(file_get_contents('php://input'));
        if (!empty($datos->UsuarioId) || !empty($datos->correo) || !empty($datos->password) || !empty($datos->estado)) {
            $actualizar = array();
            $actualizar = $usuario->actualizar($datos->UsuarioId, $datos->Nombre, $datos->correo, $datos->password, $datos->estado);
            if ($actualizar) {
                echo json_encode(array("message" => "Se actualizo correctamente"));
            } else {
                echo json_encode(array("message" => "Error, no se actualizo"));
            }
        } else {
            echo json_encode(array("message" => "Error, faltan datos"));
        }
        break;
    case "DELETE":
        $datos = json_decode(file_get_contents('php://input'));
        if (!empty($datos->UsuarioId)) {
            try {
                $eliminar = array();
                $eliminar = $usuario->eliminar($datos->UsuarioId);
                echo json_encode(array("message" => "Se elimino correctamente"));
            } catch (Exception $th) {
                echo json_encode(array("message" => "Error, no se elimino"));
            }
        } else {
            echo json_encode(array("message" => "Error, no se envio el id"));
        }
        break;
}
/*
{message: "Error, faltan datos"}



*/