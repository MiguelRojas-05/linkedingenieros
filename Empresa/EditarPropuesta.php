<?php
include '../Auth/Empresa.php';
include("../Conexion.php");

// Obtener el ID de la propuesta del parámetro de la URL
$IdPropuesta = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($IdPropuesta <= 0) {
    die('ID de propuesta no válido.');
}

$Codigo = $_SESSION["codigo_usuario"];

// Consulta SQL para obtener los detalles de la propuesta, incluyendo la descripción del estado
$Sql = "SELECT p.nombre, p.descripcion, p.requerimientos, p.fecha_publi, p.fecha_limite, e.descripcion AS estado
        FROM propuesta_laboral p
        JOIN estado_propuesta e ON p.id_estado_propuesta = e.id
        WHERE p.id = $IdPropuesta AND p.codigo_empresa = '$Codigo'";

$Propuesta = mysqli_query($cn, $Sql);

if (!$Propuesta || mysqli_num_rows($Propuesta) == 0) {
    die('No se encontró la propuesta.');
}

$Detalle = mysqli_fetch_assoc($Propuesta);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Propuesta</title>
    <link rel="stylesheet" href="../css/EstiloEditarPropuesta.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>
<?php  
include '../Componentes/NavBarEmpresa.php';
?>

    <div class="ContainerEditar">
        <br>
        <img src="../img/EditarP.png" width="120" height="125" alt="Logo">
        <h1>Editar Propuesta Laboral</h1>

        <form action="ProcesoEditarPropuesta.php" method="post">
            <input type="hidden" name="id" value="<?php echo $IdPropuesta; ?>">

            <table>
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" id="nombre" name="TxtNom" value="<?php echo $Detalle['nombre']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="descripcion">Descripción:</label></td>
                    <td><textarea id="descripcion" name="TxtDescrip" required><?php echo $Detalle['descripcion']; ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="requerimientos">Requerimientos:</label></td>
                    <td><textarea id="requerimientos" name="TxtReque" required><?php echo $Detalle['requerimientos']; ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="fecha_limite">Fecha Límite:</label></td>
                    <td><input type="date" id="fecha_limite" name="TxtFechaL" value="<?php echo $Detalle['fecha_limite']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="estado">Estado:</label></td>
                    <td><input type="text" id="estado" name="TxtEst" value="<?php echo $Detalle['estado']; ?>" readonly class="estado-campo"></td>
                </tr>
                <tr>
                    <td colspan="2" class="center" style="text-align: right;">
                        <input type="submit" value="GUARDAR" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; text-decoration: none;">
                        <a href="VerPropuestasEmpresa.php" style="margin-left: 85px; padding: 8px 10px; background-color: #6c757d; color: white; border: none; border-radius: 5px; text-decoration: none;">Cancelar</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php mysqli_close($cn); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>