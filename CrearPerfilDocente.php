<?php

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Perfil de Docente</title>
    <link rel="icon" href="img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body style="height: 100vh;" class="d-flex align-items-center">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col col-4">
                <form class="form-control text-center" action="ProcesoCrearPerfilDocente.php" method="POST">
                    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo']; ?>">
                    <h2>Crear Perfil de Docente</h2>
                    <input class="my-1 form-control" type="text" autocomplete="off" name="nombre" placeholder="Nombre" required>
                    <input class="my-1 form-control" type="text" autocomplete="off" name="a_paterno" placeholder="Apellido Paterno" required>
                    <input class="my-1 form-control" type="text" autocomplete="off" name="a_materno" placeholder="Apellido Materno" required>
                    <input class="my-1 form-control" type="text" autocomplete="off" name="correo" placeholder="Correo electrónico" required>
                    <input class=" btn btn-primary btn-sm" type="submit" value="Crear Perfil">
                </form>

            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>