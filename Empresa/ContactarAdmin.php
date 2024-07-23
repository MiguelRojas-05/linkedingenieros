<?php
include '../Auth/Empresa.php';
// Conexión a la base de datos.
include("../Conexion.php");

$c = $_SESSION["codigo_usuario"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $descripcion = $_POST["mensaje"];
    $query_insert = "INSERT INTO mensaje (codigo_emisor, descripción, id_tipo_usuario) VALUES('$c', '$descripcion', 3)";
    mysqli_query($cn, $query_insert);
    Header('Location: ContactarAdmin.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="../css/EstilosActualizar.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

    <?php
    include '../Componentes/NavBarEmpresa.php';
    ?>

    <div class="container" style="margin-top: 120px;">
        <div class="container rounded border border-primary" id="ChatBox" style="width:450px; height: 400px;overflow-y: auto;">
            <div class="row m-3 d-flex justify-content-center">
                <div class="col">
                    <?php
                    $sql = "SELECT id, 
                    codigo_emisor, 
                    descripción, 
                    DATE_FORMAT(fecha_hora, '%d-%m-%Y %H:%i') AS fecha_hora_formateada, 
                    id_tipo_usuario 
                    FROM mensaje
                    WHERE codigo_emisor = '$c'
                    ORDER BY fecha_hora;";
                    $result = mysqli_query($cn, $sql);
                    while ($r = mysqli_fetch_assoc($result)) {
                        if ($r["id_tipo_usuario"] == 3) {
                    ?>
                            <div class="row text-end ps-4">
                                <span class="fw-bold">Tú</span>
                                <p class="bg-primary p-2 rounded bg-opacity-25">
                                    <?php echo $r["descripción"]; ?>
                                </p>
                                <span style="font-size: 14px;"><?php echo $r["fecha_hora_formateada"]; ?></span>
                            </div>
                        <?php } else if ($r["id_tipo_usuario"] == 4) { ?>
                            <div class="row text-start pe-4">
                                <span class="fw-bold">Administrador</span>
                                <p class="bg-secondary bg-opacity-25 rounded p-2">
                                    <?php echo $r["descripción"] ?>
                                </p>
                                <span style="font-size: 14px;"><?php echo $r["fecha_hora_formateada"]; ?></span>
                            </div>
                        <?php } ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="container m-2">
            <form class="row d-flex" method="post" action="ContactarAdmin.php">
                <input autocomplete="off" name="mensaje" type="text" class="border border-primary rounded col col-10" placeholder="Escribe tu nuevo mensaje" style="height:40px;">
                <button type="submit" class="ms-2 bg-primary col col-1 btn text-white">
                    <i class="bi bi-send"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var chatBox = document.getElementById("ChatBox");
            chatBox.scrollTop = chatBox.scrollHeight; // Hace que el scroll esté siempre al final
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>