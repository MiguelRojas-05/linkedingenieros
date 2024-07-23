<?php
include './Auth/Perfil.php';
include('Conexion.php');

$c = $_SESSION["codigo_usuario"];

$CodReportado = isset($_GET['codigo']) ? mysqli_real_escape_string($cn, $_GET['codigo']) : '';
$mostrarModal = false;

if (isset($_GET['descripcion_reporte'])) {
    $DscRepor = $_GET["descripcion_reporte"];
    $QueryInsertRepor = "INSERT INTO reporte (reportador, reportado, descripcion) VALUES ('$c', '$CodReportado', '$DscRepor');";
    if (mysqli_query($cn, $QueryInsertRepor)) {
        $mostrarModal = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="icon" href="./img/Min_logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/EstiloPerfilPostulante.css">
    <link rel="stylesheet" href="../css/DashboardAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

    <div class="container" style="margin-top: 120px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <fieldset class="fs-2 fw-bold text-center">REPORTE</fieldset>
                <form action="Reportar.php" method="get">
                    <p class="fs-5">
                        Describa la razón por la cual quiere reportar a este usuario
                    </p>
                    <input type="text" name="codigo" hidden value="<?php echo $CodReportado ?>">
                    <textarea name="descripcion_reporte" class="form-control fs-5"></textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Bootstrap -->
    <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Reporte exitoso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Reportado exitosamente, puede cerrar la ventana.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($mostrarModal): ?>
            var myModal = new bootstrap.Modal(document.getElementById('miModal'));
            myModal.show();
        <?php endif; ?>
    </script>
</body>

</html>
