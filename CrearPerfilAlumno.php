<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Perfil de Alumno</title>
    <link rel="stylesheet" href="css/EstiloPerfilAlumno.css">
    <link rel="icon" href="img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <form action="ProcesoCrearPerfilAlumno.php" method="POST">
        <input type="hidden" name="codigo" value="<?php echo $_GET['codigo']; ?>">
        <h2>Crear Perfil de Alumno</h2>
        <input class="form-control" autocomplete="off" type="text" name="nombre" placeholder="Nombre" required>
        <input class="form-control" autocomplete="off" type="text" name="a_paterno" placeholder="Apellido Paterno" required>
        <input class="form-control" autocomplete="off" type="text" name="a_materno" placeholder="Apellido Materno" required>
        <select name="escuela" class="form-select">
            <option value="Ingeniería de Sistemas">Ing. Sistemas</option>
            <option value="Ingeniería de Informática">Ing. Informática</option>
            <option value="Ingeniería Industrial">Ing. Industrial</option>
            <option value="Ingeniería Electrónica">Ing. Electrónica</option>
        </select>
        <input class="form-control" autocomplete="off" type="tel" name="celular" placeholder="Celular" pattern="[0-9]{9}" required>
        <input type="submit" value="Crear Perfil">
    </form>
</body>

</html>