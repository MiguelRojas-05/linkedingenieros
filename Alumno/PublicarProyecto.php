<?php

include '../Auth/Alumno.php';
include '../Conexion.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    <link rel="stylesheet" href="../css/EstiloIndexAlumno.css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>


    <?php
    include '../Componentes/NavBarAlumno.php';
    ?>

    <div class="container" style="margin-top: 100px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <form action="ProcesoPublicarProyecto.php" class="form-control" method="post">
                    <fieldset class="text-center fw-bold fs-4">Agregar nuevo proyecto</fieldset>
                    <p>
                        La persona que publique el proyecto tendrá el rol de líder. Y como tal, deberá agregar luego a sus compañeros de equipo en el proyecto.
                    </p>
                    <tr>
                        <input type="text" name="nombre" placeholder="Ingrese nombre del proyecto" autocomplete="off" class="form-control my-1" maxlength="150" required>
                    </tr>
                    <tr>
                        <textarea name="descripcion" placeholder="Ingrese descripción del proyecto" autocomplete="off" maxlength="500" class="form-control my-1" required></textarea>
                    </tr>
                    <tr>
                        <input type="text" name="url" placeholder="Ingrese url donde detallarán más sobre su proyecto" autocomplete="off" maxlength="250" class="form-control my-1" required>
                    </tr>
                    <tr>
                        <label class="ms-3 mt-2">Fecha en que inició el proyecto</label>
                        <input type="date" name="fecha_inicio" class="form-control">
                    </tr>
                    <tr>
                        <label class="ms-3 mt-2">Fecha en la que finalizó (Dejar sin marcar si aún se sigue desarrollando)</label>
                        <input type="date" name="fecha_fin" class="form-control">
                    </tr>
                    <tr>
                        <div class="container text-center">
                            <input type="submit" value="Publicar" class="btn btn-primary btn-sm my-2">
                        </div>
                    </tr>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>