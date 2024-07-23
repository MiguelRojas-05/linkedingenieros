<?php
include '../Auth/Admin.php';
include '../Conexion.php';
$c = $_GET["codigo"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c = $_POST["codigo"];
    $descripcion = $_POST["mensaje"];
    $query_insert = "INSERT INTO mensaje (codigo_emisor, descripción, id_tipo_usuario) VALUES('$c', '$descripcion', 4)";
    mysqli_query($cn, $query_insert);
    Header('Location: ConversacionSoporteAlumno.php?codigo='. urlencode($c));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Contacto y Soporte</title>
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

<div class="container text-center" style="margin-top: 100px;">
    <a href="ContactoSoporte.php" class="btn btn-secondary btn-sm mb-1">Regresar a conversaciones</a>
        <div class="container rounded border border-primary" id="ChatBox" style="width:450px;height: 400px;overflow-y: auto;">
            <div class="row m-3 d-flex justify-content-center">
                <div class="col">
                    <?php
                    $sql = "SELECT m.id, 
                            m.codigo_emisor, 
                            m.descripción, 
                            DATE_FORMAT(m.fecha_hora, '%d-%m-%Y %H:%i') AS fecha_hora_formateada, 
                            m.id_tipo_usuario, 
                            CONCAT(a.nombre, ' ', a.a_paterno, ' ', a.a_materno) AS nombres
                            FROM mensaje m
                            INNER JOIN alumno a ON m.codigo_emisor = a.codigo
                            WHERE m.codigo_emisor = '$c'
                            ORDER BY m.fecha_hora;";
                    $result = mysqli_query($cn, $sql);
                    while ($r = mysqli_fetch_assoc($result)) {
                        if ($r["id_tipo_usuario"] == 4) {
                    ?>
                            <div class="row text-end ps-4">
                                <span class="fw-bold">Tú</span>
                                <p class="bg-primary p-2 rounded bg-opacity-25">
                                    <?php echo $r["descripción"]; ?>
                                </p>
                                <span style="font-size: 14px;"><?php echo $r["fecha_hora_formateada"]; ?></span>
                            </div>
                        <?php } else if ($r["id_tipo_usuario"] == 1) { ?>
                            <div class="row text-start pe-4">
                                <span class="fw-bold"><?php echo $r["nombres"]; ?></span>
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

        <div class="row d-flex justify-content-center m-2">
            <form class="col col-5" method="post" action="ConversacionSoporteAlumno.php">
                <input type="text" name="codigo" value="<?php echo $c ?>" hidden>
            <input autocomplete="off" name="mensaje" type="text" class="border border-primary rounded col col-10" placeholder="Escribe tu nuevo mensaje" style="height:40px;">
                <button type="submit" class="ms-4 mb-2 bg-primary col col-1 btn text-white">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>