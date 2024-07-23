<?php
session_start(); 

include("Conexion.php");

$correo = $_POST["txtemail"];
$pass = $_POST["txtpass"];

$sql = "select * from usuario u, tipo_usuario tp 
        where correo = '$correo' and password = '$pass'
        and u.id_tipo_usuario=tp.id";

$fila = mysqli_query($cn, $sql);
$r = mysqli_fetch_array($fila);
if ($r["id_estado_usuario"] == 2) {
    header('location: InfoInhabilitado.php');
    exit;
}else if ($r) {
    $valor = $r["codigo_usuario"];
    $_SESSION["codigo_usuario"] = $valor;
    $_SESSION["auth"] = $r["id_tipo_usuario"];

    
        switch ($_SESSION["auth"]) {
            case 1:
                // Usuario tipo 1 - redirigir a página específica
                header('location: ./Alumno/IndexAlumno.php');
                exit();
            case 2:
                // Usuario tipo 2 - redirigir a página específica
                header('location: ./Docente/IndexDocente.php');
                exit();
            case 3:
                // Usuario tipo 3 - redirigir a página específica
                header('location: ./Empresa/IndexEmpresa.php');
                exit();
            case 4:
                // Usuario tipo 4 - redirigir a página específica
                header('location: Admin/DashboardAdmin.php');
                exit();
            default:
                // Si por alguna razón el tipo de usuario no es válido, redirigir al login
                header('location: Login.php');
                exit();
        }
} else {
    header('location: LoginRe.php');
}
?>
