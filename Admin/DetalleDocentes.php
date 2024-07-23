<?php
include '../Conexion.php';
include '../Auth/Admin.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Docentes</title>
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

    <?php
    $CodigoDocente = $_GET["codigo"];

    if (isset($_GET["new_estado"])) { //Si está definida se hará
        $ne = $_GET["new_estado"];
        $q = "UPDATE usuario SET id_estado_usuario = '$ne' WHERE codigo_usuario = '$CodigoDocente'";
        mysqli_query($cn, $q);
    }




    $query = "SELECT *, eu.descripcion AS estado_usuario FROM usuario u JOIN docente d ON u.codigo_usuario = d.codigo JOIN 
            estado_usuario eu ON u.id_estado_usuario = eu.id WHERE d.codigo = '$CodigoDocente'";
    $result = mysqli_query($cn, $query);
    $row = mysqli_fetch_array($result);

    ?>
    <div class="container" style="margin-top: 100px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <div class="row d-flex">
                    <div class="col col-6">
                        <img src="../FotoPerfil/Docentes/<?php echo $row['codigo'] ?>.jpg" alt="perfil" height="300px">
                    </div>
                    <div class="col col-6 ps-5 pt-5">
                        <table class="table table-hover">

                            <tr>
                                <td><strong>Código</strong></td>
                                <td><?php echo $row["codigo"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nombre completo</strong></td>
                                <td><?php echo $row["nombre"] . " " . $row["a_paterno"] . " " . $row["a_materno"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Correo</strong></td>
                                <td><?php echo $row["correo"]; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <span><strong>Estado de usuario: </strong></span>
            <span><?php echo $row["estado_usuario"] ?></span>
            <form action="DetalleDocentes.php" method="get" class="col my-3">
                <input name="codigo" type="text" hidden value="<?php echo $row["codigo"] ?>">
                <?php
                if ($row["estado_usuario"] == 'habilitado') {
                    echo '<input type="text" name="new_estado" hidden value="2"> <input type="submit" class="btn btn-danger bt-sm" value="Inhabilitar"> ';
                } else {
                    echo '<input type="text" name="new_estado" hidden value="1"> <input type="submit"  class="btn btn-success bt-sm" value=" Habilitar">';
                }
                ?>
            </form>
        </div>

    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>