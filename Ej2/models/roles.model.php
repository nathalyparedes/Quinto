<?php
// php es un lenguaje de programacion interpretado, por lo que no se compila, se ejecuta en el servidor
require_once('../config/conexion.php');
class Clase_Roles
{

    public function todos()  ///select * from usuarios;
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `roles`"; 
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function uno($RolesId)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $stmt = $con->prepare("SELECT * FROM `roles` WHERE RolesId = ?");
        $stmt->bind_param("i", $RolesId);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $rol = $resultado->fetch_assoc();
        $stmt->close();
        $con->close();
        
        return $rol;
    }
    public function insertar($detalle)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO `roles`(`detalle`) VALUES ('$detalle')";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function actualizar($RolesId, $detalle)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE `roles` SET `detalle`='$detalle' WHERE RolesId=$RolesId";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function eliminar($RolesId)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM `roles` where RolesId=$RolesId";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
}