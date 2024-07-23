<?php
include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

// Es un ejemplo, cambiar codigo
$c = $_SESSION["codigo_usuario"];

// Verificar si se ha subido un archivo
if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == 0) {
    $ArchivoCurriculum = $_FILES["archivo"]["tmp_name"];
    $NombreCurriculum = $_FILES["archivo"]["name"];

    // Obtener la extensión del archivo de manera segura
    $extension = pathinfo($NombreCurriculum, PATHINFO_EXTENSION);

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "doc" || $extension == "docx") {
        // Guardar el currículum de los alumnos en la carpeta CurriculumAlumnos
        // El cv se guarda automáticamente con el código del alumno
        $destino = "../CurriculumAlumnos/" . $c . "." . $extension;

        if (move_uploaded_file($ArchivoCurriculum, $destino)) {
            // Consulta SQL utilizada para actualizar el cv de la tabla alumno
            $sql = "UPDATE alumno SET cv=2 WHERE codigo='$c'";

            // Función que sirve para ejecutar la consulta SQL
            if (mysqli_query($cn, $sql)) {
                // Redireccionar a Curriculum.php
                header('Location: Curriculum.php');
                exit(); // Asegurarse de que el script se detiene después de redirigir
            } else {
                echo "Error al actualizar la base de datos: " . mysqli_error($cn);
            }
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Formato de archivo no permitido. Solo se permiten archivos PDF, DOC y DOCX.";
    }
} else {
    echo "No se ha subido ningún archivo o hubo un error en la subida.";
}

// Cerrar la conexión a la base de datos
mysqli_close($cn);
?>
