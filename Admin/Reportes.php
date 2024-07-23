<?php

include '../Conexion.php';
include '../Auth/Admin.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reportes</title>
    <link rel="icon" href="../img/Min_logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/DashboardAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

    <?php
    include '../Componentes/NavBarAdmin.php';
    ?>

    <div class="container-fluid" style="margin-top: 10%;">
        <div class="row d-flex justify-content-center">
            <div class="col col-10">
                <table class="table table-lg table-hover text-center">
                    <thead class="table-active">
                        <tr>
                            <td>Reportador</td>
                            <td>Reportado</td>
                            <td>Descripción</td>
                            <td>Fecha y hora</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT *, DATE_FORMAT(fecha, '%d-%m %H:%i') as fecha_formateada FROM reporte;";
                        $result = mysqli_query($cn, $sql);
                        while ($r = mysqli_fetch_array($result)) {
                            $query_alumno = "SELECT * FROM alumno a WHERE a.codigo = '$'";
                        ?>
                            <tr>
                                <td>
                                    <?php echo $r['reportador']; ?>
                                </td>
                                <td>
                                    <?php echo $r['reportado']; ?>
                                </td>
                                <td>
                                    <?php echo $r['descripcion']; ?>
                                </td>
                                <td>
                                    <?php echo $r['fecha_formateada']; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
?>