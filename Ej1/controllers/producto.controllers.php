<?php

require_once('../models/producto.model.php');
$producto = new Clase_Producto();

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todos":
            $datos = $producto->todos();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron productos.");
            }
            break;
        case "insertar":
            if (isset($_POST["nombre"], $_POST["precio"], $_POST["stock"])) {
                $nombre = $_POST["nombre"];
                $precio = $_POST["precio"];
                $stock = $_POST["stock"];
                $resultado = $producto->insertar($nombre, $precio, $stock);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar el producto: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar el producto.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id"], $_POST["nombre"], $_POST["precio"], $_POST["stock"])) {
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $precio = $_POST["precio"];
                $stock = $_POST["stock"];
                $resultado = $producto->actualizar($id, $nombre, $precio, $stock);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados del producto
                    $productoActualizado = $producto->obtenerPorId($id);
                    if ($productoActualizado) {
                        echo json_encode($productoActualizado);
                    } else {
                        echo json_encode("Error al obtener el producto actualizado.");
                    }
                } else {
                    echo json_encode("Error al actualizar el producto: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar el producto.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id"])) {
                $id = $_POST["id"];
                $resultado = $producto->eliminar($id);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar el producto: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar el producto.");
            }
            break;
        case "detalle":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $productoDetalle = $producto->obtenerPorId($id);
                if ($productoDetalle) {
                    echo json_encode($productoDetalle);
                } else {
                    echo json_encode("No se encontró el producto.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle del producto.");
            }
            break;
        default:
            echo json_encode("Operación no válida.");
            break;
    }
} else {
    echo json_encode("No se especificó la operación.");
}

?>
