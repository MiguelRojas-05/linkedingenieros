<?php
include("Conexion.php");

$correo = $_POST["txtcorreo"];
$pass = $_POST["txtpass"];
$repass = $_POST["txtrepass"];
$codigo = $_POST["txtcodigo"];
$tipo = $_POST["opctipo"];

// Verificar que las contraseñas coincidan
if ($pass !== $repass) {
    header('Location: RegistrarUsuario.php?error=contraseñas_no_coinciden');
    exit();
}

// Verificar si el correo electrónico ya existe en la tabla usuario
$sql_verificacion_correo = "SELECT COUNT(*) as count FROM usuario WHERE correo = '$correo'";
$resultado_verificacion_correo = mysqli_query($cn, $sql_verificacion_correo);

if ($resultado_verificacion_correo) {
    $row = mysqli_fetch_assoc($resultado_verificacion_correo);
    $cantidad_registros_correo = $row['count'];

    if ($cantidad_registros_correo > 0) {
        // El correo electrónico ya existe
        header('Location: RegistrarUsuario.php?error=correo_existente');
        exit();
    }

    // Verificar si el código de usuario ya existe en la tabla usuario
    $sql_verificacion_usuario = "SELECT COUNT(*) as count FROM usuario WHERE codigo_usuario = '$codigo'";
    $resultado_verificacion_usuario = mysqli_query($cn, $sql_verificacion_usuario);

    if ($resultado_verificacion_usuario) {
        $row = mysqli_fetch_assoc($resultado_verificacion_usuario);
        $cantidad_registros_usuario = $row['count'];

        if ($cantidad_registros_usuario > 0) {
            // El código de usuario ya existe
            header('Location: RegistrarUsuario.php?error=codigo_existente');
            exit();
        }

        // Verificar si existe un registro en bd_usuarios con el código universitario y tipo de usuario indicados
        $sql_verificacion = "SELECT COUNT(*) as count FROM bd_usuarios WHERE codigo_uni = '$codigo' AND id_tipo_usuario = '$tipo'";
        $resultado_verificacion = mysqli_query($cn, $sql_verificacion);

        if ($resultado_verificacion) {
            $row = mysqli_fetch_assoc($resultado_verificacion);
            $cantidad_registros = $row['count'];

            // Si se encuentra exactamente un registro que coincide, proceder con la inserción en la tabla usuario
            if ($cantidad_registros == 1) {
                $sql_usuario = "INSERT INTO usuario (codigo_usuario, correo, password, id_tipo_usuario, id_estado_usuario)
                                VALUES ('$codigo', '$correo', '$pass', $tipo, 1)";
                // Insertar en la tabla correspondiente según el tipo de usuario seleccionado
                mysqli_query($cn, $sql_usuario);
                switch ($tipo) {
                    case 1: // Alumno
                        header('Location: CrearPerfilAlumno.php?codigo=' . urlencode($codigo));
                        break;
                    case 2: // Docente
                        header('Location: CrearPerfilDocente.php?codigo=' . urlencode($codigo));
                        break;
                    case 3: // Empresa
                        header('Location: CrearPerfilEmpresa.php?codigo=' . urlencode($codigo));
                        break;
                    default:
                        echo "Tipo de usuario no válido.";
                        break;
                }
            } else {
                echo "<h2><center><br>No se encontró un registro válido con el código universitario y tipo de usuario proporcionados, por favor registrese correctamente.</center></h2>";
            }
        } else {
            echo "Error al verificar los datos en la base de datos: " . mysqli_error($cn);
        }
    } else {
        echo "Error al verificar los datos en la base de datos: " . mysqli_error($cn);
    }
} else {
    echo "Error al verificar los datos en la base de datos: " . mysqli_error($cn);
}

mysqli_close($cn);
?>
