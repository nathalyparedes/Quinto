<?php
// php es un lenguaje de programacion interpretado, por lo que no se compila, se ejecuta en el servidor
require_once('../config/conexion.php');
class Clase_UsuariosRoles
{

    public function todos() 
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `RolesUsuario`"; 
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function uno($UsuariosRolesId)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `RolesUsuario` WHERE UsuariosRolesId=$UsuariosRolesId";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function insertar($IdRoles, $IdUsuarios)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO `RolesUsuario`(`IdRoles`, `IdUsuarios` ) VALUES ('$IdRoles', '$IdUsuarios')";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function actualizar($UsuariosRolesId, $IdRoles, $IdUsuarios)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE `RolesUsuario` SET `IdRoles`='$IdRoles', `IdUsuarios`='$IdUsuarios' WHERE UsuariosRolesId=$UsuariosRolesId";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function eliminar($UsuariosRolesId)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM `RolesUsuario` where UsuariosRolesId=$UsuariosRolesId";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
}