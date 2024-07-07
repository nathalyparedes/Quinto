<?php

require_once('../config/conexion.php');

class Clase_Producto
{
    public function todos()
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM productos";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $productos = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $productos[] = $fila;
            }
            
            return $productos;
        } catch (Exception $e) {
            error_log("Error en la consulta todos(): " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($nombre, $precio, $stock)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($consulta);
            
            $stmt->bind_param("sdi", $nombre, $precio, $stock); // 'i' para entero, 'd' para double (decimal)
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar producto: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id, $nombre, $precio, $stock)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE productos SET nombre=?, precio=?, stock=? WHERE id=?";
            $stmt = $conexion->prepare($consulta);
            
            // Vincular los parámetros y especificar los tipos
            $stmt->bind_param("sdii", $nombre, $precio, $stock, $id); // 'i' para entero, 'd' para double (decimal)
            
            // Ejecutar la consulta preparada
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar producto: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function eliminar($id)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "DELETE FROM productos WHERE id=?";
            $stmt = $conexion->prepare($consulta);
            
            $stmt->bind_param("i", $id); // 'i' para entero
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar producto: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function obtenerPorId($id)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM productos WHERE id=?";
            $stmt = $conexion->prepare($consulta);
            
            $stmt->bind_param("i", $id); // 'i' para entero
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $producto = $resultado->fetch_assoc();
                return $producto;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener producto por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
    public function buscarPorNombre($nombre)
{
    try {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $consulta = "SELECT * FROM productos WHERE nombre LIKE ?";
        $stmt = $conexion->prepare($consulta);
        $nombreBusqueda = "%" . $nombre . "%";
        $stmt->bind_param("s", $nombreBusqueda);

        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            $productos = array();
            while ($fila = $resultado->fetch_assoc()) {
                $productos[] = $fila;
            }
            return $productos;
        } else {
            throw new Exception($stmt->error);
        }
    } catch (Exception $e) {
        error_log("Error al buscar productos por nombre: " . $e->getMessage());
        return false;
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}

}


