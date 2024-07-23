<?php
include '../Auth/Docente.php';
include("../Conexion.php");

// Obtener el ID de la propuesta del parámetro de la URL
$IdPropuesta = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($IdPropuesta <= 0) {
    die('ID de propuesta no válido.');
}
$SqlDetalles = "SELECT p.nombre, p.descripcion, p.requerimientos, p.fecha_publi, p.fecha_limite, 
        CASE p.id_estado_propuesta 
            WHEN 1 THEN 'Activa' 
            WHEN 2 THEN 'Inactiva'  
        END AS estado,
        e.razon_social AS empresa
        FROM propuesta_laboral p
        JOIN empresa e ON p.codigo_empresa = e.codigo
        WHERE p.id = $IdPropuesta";

$Propuesta = mysqli_query($cn, $SqlDetalles);

$Detalle = mysqli_fetch_assoc($Propuesta);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
    <!-- <link rel="stylesheet" href="css/EstiloDetallePropuestaDocente.css" type="text/css"> -->
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

<?php  
include '../Componentes/NavBarDocente.php';
?>


    <div class="container" style="margin-top:100px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-8">
                <h1>Detalles de la Propuesta</h1>

                <table class="table table-sm table-hover">
                    <tr>
                        <td><b>Nombre:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['nombre']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Descripción:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['descripcion']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Requerimientos:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['requerimientos']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha de Publicación:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['fecha_publi']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha Límite:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['fecha_limite']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Estado:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['estado']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Empresa:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['empresa']); ?></td> <!-- Mostrar nombre de la empresa -->
                    </tr>
                </table>
                <br>
                <a href="VerPropuestasDocente.php" class="btn btn-secondary">Ir Atras</a>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>