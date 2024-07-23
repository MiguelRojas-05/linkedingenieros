<?php
include '../Conexion.php';
include '../Auth/Admin.php';


function generarPassword()
{
    $plantilla = "1234567890qwertyuiopasdfghjklzxcvbnm";
    $password = "";
    for ($i = 0; $i < 8; $i++) {
        $randIndex = rand(0, strlen($plantilla) - 1);
        $password .= $plantilla[$randIndex];
    }
    return $password;
}

$generatedPassword = '';

if (isset($_POST['generar_contrasena'])) {
    $generatedPassword = generarPassword();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administradores</title>
    <link rel="icon" href="../img/Min_logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/DashboardAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">

    <script>
        //función JavaScript para autogenerar contraseña "segura" para usuario
        function generarPassword() {
            var plantilla = "1234567890qwertyuiopasdfghjklzxcvbnm";
            var password = "";
            for (var i = 0; i < 8; i++) {
                var randIndex = Math.floor(Math.random() * plantilla.length);
                password += plantilla.charAt(randIndex);
            }
            document.getElementById('contra').value = password;
        }
    </script>

</head>

<body>
    <?php
    include '../Componentes/NavBarAdmin.php';
    ?>
    <?php



    if (isset($_GET["new_estado"])) { //Si está definida se hará
        $Codigo = $_GET["codigo"];
        $ne = $_GET["new_estado"];
        $query = "UPDATE usuario SET id_estado_usuario = '$ne' WHERE codigo_usuario = '$Codigo'";
        mysqli_query($cn, $query);
    }
    ?>
    <div class="container" style="margin-top: 90px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <h3 class="text-center">Agrega un administrador</h3>
                <form action="./ProcesoAdministrador.php" method="post" class="form-control">
                    <input class="form-control my-1" autocomplete="off" type="text" name="codigo" placeholder="Codigo">
                    <input class="form-control my-1" autocomplete="off" type="text" name="correo" placeholder="Correo">
                    <input class="form-control my-1" autocomplete="off" type="text" name="nombre" placeholder="Nombre Completo">
                    <input class="form-control my-1" autocomplete="off" type="text" name="pass" placeholder="Nueva contraseña" id="contra">
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="generarPassword()">Generar contraseña</button>
                    <input class="form-control my-1" autocomplete="off" type="text" name="repass" placeholder="Confirmar contraseña">
                    <input type="submit" value="Registrar" class="btn btn-sm btn-primary">
                </form>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <table class="text-center table table-sm table-hover">
                    <thead class="table-active table-light fw-bold">
                        <tr>
                            <td>Código</td>
                            <td>Nombre</td>
                            <td>Fecha de registro</td>
                            <td>Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `administrador` a JOIN usuario u ON a.codigo=u.codigo_usuario";
                        $r = mysqli_query($cn, $query);
                        while ($row = mysqli_fetch_array($r)) {
                        ?>
                            <tr>
                                <td><?php echo $row['codigo']; ?></td>
                                <td><?php echo $row["nombre"] ?></td>
                                <td><?php echo $row["fecha_asig"] ?></td>
                                <td>
                                    <form action="Administradores.php" method="get">
                                        <input name="codigo" type="text" hidden value="<?php echo $row["codigo"] ?>">
                                        <?php
                                        if ($row["id_estado_usuario"] == 1) {
                                            echo '<input type="text" name="new_estado" hidden value="2"> <input type="submit" class="btn btn-danger bt-sm" value="Inhabilitar"> ';
                                        } else {
                                            echo '<input type="text" name="new_estado" hidden value="1"> <input type="submit"  class="btn btn-success bt-sm" value="Habilitar">';
                                        }
                                        ?>
                                    </form>
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