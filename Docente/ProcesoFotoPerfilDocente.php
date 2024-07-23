<?php
include '../Auth/Docente.php';
// Conexión a la base de datos.
include("../Conexion.php");

$c = $_SESSION["codigo_usuario"];

// Nombre de la carpeta y la imagen existente
$Carpeta2 = "../FotoPerfil/Docentes/";
$NombreImagen2 = "$c";
// Posibles extensiones de la imagen
$Extensiones2 = ['jpg', 'png'];
// Verificar si la imagen existe con alguna de las extensiones y eliminarla
foreach ($Extensiones2 as $Extension) {
    $RutaTemp2 = $Carpeta2 . $NombreImagen2 . '.' . $Extension;
    if (file_exists($RutaTemp2)) {
        unlink($RutaTemp2); // Eliminar la imagen PNG o JPG existente
        break;
    }
}

// Verificar si se ha subido un archivo
if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
    $ImagenDocente = $_FILES["foto"]["tmp_name"];
    $NombreImagen= $_FILES["foto"]["name"];

    // Obtener la extensión del archivo de manera segura
    $extension = pathinfo($NombreImagen, PATHINFO_EXTENSION);

    // Validar la extensión del archivo
    if ($extension == "png" || $extension == "jpg") {
        // Guardar la imagen o foto de perfil de los docentes en la carpeta FotoPerfil/Docentes
        // La imagen o foto se guarda automáticamente con el código del docente
        $destino = "../FotoPerfil/Docentes/" . $c . "." . $extension;

        if (move_uploaded_file($ImagenDocente, $destino)) {
                // Redireccionar a FotoPerfilDocente.php
            header('Location: FotoPerfilDocente.php');
            exit(); // Asegurarse de que el script se detiene después de redirigir

        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Formato de archivo no permitido. Solo se permiten archivos PNG Y JPG.";
    }
} else {
    echo "No se ha subido ningún archivo o hubo un error en la subida.";
}

// Cerrar la conexión a la base de datos
mysqli_close($cn);
?>