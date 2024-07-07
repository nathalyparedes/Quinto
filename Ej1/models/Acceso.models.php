<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');
class Accesos
{
    /*TODO: Procedimiento para sacar todos los registros*/
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT Accesos.*, Usuarios.Nombres, Usuarios.Apellidos FROM `Accesos` inner JOIN Usuarios on Accesos.Usuarios_idUsuarios = Usuarios.idUsuarios;";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    /*TODO: Procedimiento para sacar un registro*/
    public function uno($idAccesos)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT  * FROM Accesos WHERE idAccesos = $idAccesos";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    /*TODO: Procedimiento para insertar */
    public function Insertar($Ultimo, $Usuarios_idUsuarios, $tipo)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT into Accesos(Ultimo,Usuarios_idUsuarios,tipo) values ( '$Ultimo', $Usuarios_idUsuarios, '$tipo')";

        if (mysqli_query($con, $cadena)) {
            return "ok";
        } else {
            return mysqli_error($con);
        }
        $con->close();
    }
    /*TODO: Procedimiento para actualizar */
    public function Actualizar($idAccesos, $Ultimo, $Usuarios_idUsuarios)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "update Accesos set Ultimo='$Ultimo',Usuarios_idUsuarios=$Usuarios_idUsuarios where idAccesos= $idAccesos";
        if (mysqli_query($con, $cadena)) {
            return "ok";
        } else {
            return 'error al actualizar el registro';
        }
        $con->close();
    }
    /*TODO: Procedimiento para Eliminar */
    public function Eliminar($idAccesos)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "delete from Accesos where idAccesos = $idAccesos";
        if (mysqli_query($con, $cadena)) {
            return true;
        } else {
            return false;
        }
        $con->close();
    }
}