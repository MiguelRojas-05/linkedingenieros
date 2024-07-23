<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/EstiloLogin.css" type="text/css">
</head>

<body>
    <div class="containerindex">
        <img src="img/ing.png" width="180" height="180" alt="Logo">
        <h1>SISTEMA LINKEDING</h1>
        <h4><i>Credenciales incorrectas, intentalo nuevamente</i></h4>
        <form action="ProcesoLogin.php" method="post">
            <input type="text" name="txtemail" placeholder="Email" class="txt">
            <input type="password" name="txtpass" placeholder="Contraseña" class="pwd">
            <input type="submit" value="ACCEDER" class="btn">
        </form>
        <div class="botones-enviado">
            <a href="RegistrarUsuario.php">Registrarse</a>
        </div>
    </div>
</body>

</html>