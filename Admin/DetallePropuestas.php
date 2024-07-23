<?php
include '../Conexion.php';
include '../Auth/Admin.php';

$Id = $_GET["id"];

$query = "SELECT 
                p.id, 
                p.nombre, 
                p.descripcion, 
                p.requerimientos,
                 DATE_FORMAT(p.fecha_publi, '%d-%m-%Y') AS fecha_publi,  
                 DATE_FORMAT(p.fecha_limite, '%d-%m-%Y') AS fecha_limite, 
                e.razon_social AS empresa, 
                ep.descripcion AS estado,
                ep.id AS id_estado
            FROM 
                propuesta_laboral p 
            JOIN 
                empresa e ON p.codigo_empresa = e.codigo 
            JOIN 
                estado_propuesta ep ON p.id_estado_propuesta = ep.id 
            WHERE 
                p.id = '$Id'
        ";

$result = mysqli_query($cn, $query);
$row = mysqli_fetch_array($result);

if (isset($_GET["new_estado"])) { //Si está definida se hará
    $action = $_GET["new_estado"];
    $fecha_limite = $row['fecha_limite'];
    $current_date = date('Y-m-d');

    if ($action == 'Inhabilitar') {
        $ne = 3; // Estado inhabilitado
    } elseif ($action == 'Habilitar') {
        // Verificar la fecha límite
        if ($current_date > $fecha_limite) {
            $ne = 2; // Estado inactiva (fecha límite pasada)
        } else {
            $ne = 1; // Estado activa (fecha límite no pasada)
        }
    }


    $query = "UPDATE propuesta_laboral SET id_estado_propuesta = '$ne' WHERE id = '$Id'";
    mysqli_query($cn, $query);

    header("Location: DetallePropuestas.php?id=$Id");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Principal</title>
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


    <div class="container" style="margin-top: 100px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <div class="row d-flex">
                    <div class="col ps-5 pt-5">
                        <table class="table table-hover">

                            <tr>
                                <td><strong>Nombre propuesta</strong></td>
                                <td><?php echo $row["nombre"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Empresa</strong></td>
                                <td><?php echo $row["empresa"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Descripción</strong></td>
                                <td><?php echo $row["descripcion"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Requerimientos</strong></td>
                                <td><?php echo $row["requerimientos"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de publicación</strong></td>
                                <td><?php echo $row["fecha_publi"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha límite</strong></td>
                                <td><?php echo $row["fecha_limite"]; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <span><strong>Estado de la propuesta: </strong></span>
            <span><?php echo $row["estado"] ?></span>
            <form action="DetallePropuestas.php" method="get" class="col my-3">
                <input name="id" type="text" hidden value="<?php echo $row["id"] ?>">
                <?php
                if ($row["id_estado"] == 1) {
                    echo '<input type="text" name="new_estado" hidden value="Inhabilitar"> <input type="submit" class="btn btn-danger bt-sm" value="Inhabilitar"> ';
                } elseif ($row["id_estado"] == '3') {
                    echo "aqui";
                    echo '<input type="text" name="new_estado" hidden value="Habilitar"> <input type="submit"  class="btn btn-success bt-sm" value=" Habilitar">';
                }
                mysqli_close($cn);
                ?>
            </form>
        </div>

    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>