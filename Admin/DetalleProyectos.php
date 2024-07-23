<?php
include '../Conexion.php';
include '../Auth/Admin.php';

$Id = $_GET["id"];

$query = "SELECT 
                p.id,
                p.nombre, 
                p.descripcion, 
                p.url,
                p.estado,
                 DATE_FORMAT(p.fecha_inicio, '%d-%m-%Y') AS fecha_inicio,  
                 DATE_FORMAT(p.fecha_fin, '%d-%m-%Y') AS fecha_fin
            FROM 
                proyecto p 
            WHERE 
                p.id = '$Id'
        ";

$result = mysqli_query($cn, $query);
$row = mysqli_fetch_array($result);

if (isset($_GET["new_estado"])) { //Si está definida se hará
    $action = $_GET["new_estado"];

    if ($action == '1') {
        $ne = 1; // Estado inhabilitado
    } elseif ($action == '0') {
        $ne = 0;
        
    }


    $query = "UPDATE proyecto SET estado = '$ne' WHERE id = '$Id'";
    mysqli_query($cn, $query);

    header("Location: DetalleProyectos.php?id=$Id");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Detalle Proyecto</title>
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
                                <td><strong>Nombre proyecto</strong></td>
                                <td><?php echo $row["nombre"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Descripción</strong></td>
                                <td><?php echo $row["descripcion"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Saber más detalles</strong></td>
                                <td class="pt-3">
                                    <a target="_blank" class="btn btn-sm btn-primary" href="<?php echo $row["url"]; ?>">Click aquí</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de publicación</strong></td>
                                <td><?php echo $row["fecha_inicio"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha límite</strong></td>
                                <td><?php echo $row["fecha_fin"]; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <span><strong>Estado de la propuesta: </strong></span>
            <span><?php 
            if ($row["estado"] == 0) {
                echo 'Habilitada';
            } elseif ($row["estado"] == 1) {
                echo 'Inhabilitada';
            }
            ?></span>
            <form action="DetalleProyectos.php" method="get" class="col my-3">
                <input name="id" type="text" hidden value="<?php echo $row["id"] ?>">
                <?php
                if ($row["estado"] == 0) {
                    echo '<input type="text" name="new_estado" hidden value="1"> <input type="submit" class="btn btn-danger bt-sm" value="Inhabilitar"> ';
                } elseif ($row["estado"] == 1) {
                    echo '<input type="text" name="new_estado" hidden value="0"> <input type="submit"  class="btn btn-success bt-sm" value=" Habilitar">';
                }
                mysqli_close($cn);
                ?>
            </form>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>