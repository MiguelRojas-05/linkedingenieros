<?php
include '../Auth/Admin.php';
include '../Conexion.php';
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

    <div class="container-fluid" style="margin-top: 10%;">
        <div class="row d-flex justify-content-around">
            <div class="col col-4">
                <div class="row text-center">
                    <span class="fw-bold">Alumnos</span>
                </div>
                <table class="table table-sm text-center table-hover"id="ChatBox" style="height: 400px;overflow-y: auto;">
                    <?php
                    $query_alumnos = "SELECT m.*, CONCAT(a.nombre, ' ', a.a_paterno, ' ', a.a_materno) AS nombres
                        FROM mensaje m
                        INNER JOIN (
                            SELECT codigo_emisor, MAX(fecha_hora) AS ultima_fecha
                            FROM mensaje
                            WHERE id_tipo_usuario = 1
                            GROUP BY codigo_emisor
                        ) sub
                        ON m.codigo_emisor = sub.codigo_emisor AND m.fecha_hora = sub.ultima_fecha
                        INNER JOIN alumno a
                        ON m.codigo_emisor = a.codigo
                        WHERE m.id_tipo_usuario = 1
                        ORDER BY m.fecha_hora DESC;";
                    $result_alumnos = mysqli_query($cn, $query_alumnos);
                    while ($r_alumnos = mysqli_fetch_array($result_alumnos)) {
                        $c_al = $r_alumnos["codigo_emisor"];
                    ?>
                        <tr class="row">
                            <td onclick="window.location='ConversacionSoporteAlumno.php?codigo=<?php echo $c_al ?>';" class="row d-flex align-items-center" style="height: 60px;cursor: pointer;">
                                <div class="col col-3">
                                    <img src="../FotoPerfil/Alumnos/<?php echo $c_al; ?>.jpg" alt="foto_perfil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </div>
                                <div class="col col-9">
                                    <p class="my-0 d-flex align-items-center">
                                        <?php echo $r_alumnos["descripción"]; ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="col col-4">
                <div class="row text-center">
                    <span class="fw-bold">Docentes</span>
                </div>
                <table class="table table-sm text-center table-hover" id="ChatBox" style="height: 400px;overflow-y: auto;">
                    <?php
                    $query_docentes = "SELECT m.*, CONCAT(d.nombre, ' ', d.a_paterno, ' ', d.a_materno) AS nombres
                        FROM mensaje m
                        INNER JOIN (
                            SELECT codigo_emisor, MAX(fecha_hora) AS ultima_fecha
                            FROM mensaje
                            WHERE id_tipo_usuario = 2
                            GROUP BY codigo_emisor
                        ) sub
                        ON m.codigo_emisor = sub.codigo_emisor AND m.fecha_hora = sub.ultima_fecha
                        INNER JOIN docente d
                        ON m.codigo_emisor = d.codigo
                        WHERE m.id_tipo_usuario = 2
                        ORDER BY m.fecha_hora DESC;";
                    $result_docentes = mysqli_query($cn, $query_docentes);
                    while ($r_docente = mysqli_fetch_array($result_docentes)) {
                        $c_doc = $r_docente["codigo_emisor"];
                    ?>
                        <tr class="row">
                            <td onclick="window.location='ConversacionSoporteDocente.php?codigo=<?php echo $c_doc ?>';" class="row d-flex align-items-center" style="height: 60px;cursor: pointer;">
                                <div class="col col-3">
                                    <img src="../FotoPerfil/Docentes/<?php echo $c_doc ?>.jpg" alt="foto_perfil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </div>
                                <div class="col col-9">
                                    <p class="my-0 d-flex align-items-center">
                                        <?php echo $r_docente["descripción"]; ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="col col-4">
                <div class="row text-center">
                    <span class="fw-bold">Empresas</span>
                </div>
                <table class="table table-sm text-center table-hover" id="ChatBox" style="height: 400px;overflow-y: auto;">
                    <?php
                    $query_empresas = "SELECT m.*, e.razon_social
                        FROM mensaje m
                        INNER JOIN (
                            SELECT codigo_emisor, MAX(fecha_hora) AS ultima_fecha
                            FROM mensaje
                            WHERE id_tipo_usuario = 3
                            GROUP BY codigo_emisor
                        ) sub
                        ON m.codigo_emisor = sub.codigo_emisor AND m.fecha_hora = sub.ultima_fecha
                        INNER JOIN empresa e
                        ON m.codigo_emisor = e.codigo
                        WHERE m.id_tipo_usuario = 3
                        ORDER BY m.fecha_hora DESC;";
                    $result_empresas = mysqli_query($cn, $query_empresas);
                    while ($r_empresa = mysqli_fetch_array($result_empresas)) {
                        $c_emp = $r_empresa["codigo_emisor"];
                    ?>
                        <tr class="row">
                            <td onclick="window.location='ConversacionSoporteEmpresa.php?codigo=<?php echo $c_emp ?>';" class="row d-flex align-items-center" style="height: 60px;cursor: pointer;">
                                <div class="col col-3">
                                    <img src="../FotoPerfil/Empresas/<?php echo $c_emp; ?>.jpg" alt="foto_perfil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </div>
                                <div class="col col-9">
                                    <p class="my-0 d-flex align-items-center">
                                        <?php echo $r_empresa["descripción"]; ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
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