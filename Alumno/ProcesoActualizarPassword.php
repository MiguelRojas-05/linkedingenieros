<?php
include '../Auth/Alumno.php';
include '../Conexion.php';

$c=$_SESSION["codigo_usuario"];

$Password=$_POST["txtpass"];
$NuevoPassword=$_POST["txtnuevopass"];
$RePassword=$_POST["txtrepass"];

$Sql="select * from usuario
where codigo_usuario=$c";

$FilaRegistro=mysqli_query($cn,$Sql);
$Registro=mysqli_fetch_assoc($FilaRegistro);

if (strcmp($Password,$Registro["password"])==0) {
    //Podemos ingresar la nueva contraseña.
    if (strcmp($NuevoPassword,$RePassword)==0) {
        //Podemos cambiar la contraseña
        if(strlen($NuevoPassword)>=8 && strlen($RePassword)>=8){
            $Sql2="update usuario
            set password='$NuevoPassword'
            where codigo_usuario='$c'";
    
            mysqli_query($cn,$Sql2);
    
            header('location:../CerrarSesion.php');
        }else{
            header('location:ActualizarPassword.php?e=inc');
        }
    }else{
        //Redireccionamos a
        header('location: ActualizarPassword.php?e2=inc');
    }
}else{
    header('location: ActualizarPassword.php?e3=inc');
}
?>