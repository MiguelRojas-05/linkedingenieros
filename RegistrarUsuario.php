<?php
include("Conexion.php");

// Consulta para obtener los tipos de usuario
$sql = "SELECT * FROM tipo_usuario WHERE id != 4 LIMIT 3";
$f = mysqli_query($cn, $sql);

// Inicializar variable para el mensaje de error
$CodigoExistente = '';

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    
    if ($error == 'contraseñas_no_coinciden') {
        $CodigoExistente = 'Las contraseñas no coinciden';
    } elseif ($error == 'codigo_existente') {
        $CodigoExistente = 'El código de usuario ya existe';
    } elseif ($error == 'correo_existente') {
        $CodigoExistente = 'El correo electrónico ya se encuentra registrado';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/EstiloRegistro.css" type="text/css">
    <link rel="icon" href="img/ing.png" type="image/x-icon">
    
    <script>
        // Función JavaScript para autogenerar contraseña "segura" para usuario
        function generarPassword() {
            var plantilla = "1234567890qwertyuiopasdfghjklzxcvbnm";
            var password = "";
            for (var i = 0; i < 8; i++) {
                var randIndex = Math.floor(Math.random() * plantilla.length);
                password += plantilla.charAt(randIndex);
            }
            document.getElementById('txtpassword').value = password;
        }
    </script>
</head>
<body>
    <div class="containerregistro">
        <img src="img/ing.png" width="180" height="180" alt="Logo">
        <h1>REGISTRO DE USUARIO</h1>
        
        <!-- Mostrar el mensaje de error si existe -->
        <?php if ($CodigoExistente): ?>
            <p style="text-align: center; font-weight: bold; font-style: italic; color: #00196b;">
                <?php echo htmlspecialchars($CodigoExistente); ?>
            </p>
        <?php endif; ?>
        
        <form action="ProcesoRegistrarUsuario.php" method="post">
            <table>
                <tr>
                    <td><b>Correo:</b></td>
                    <td><input type="text" name="txtcorreo" required></td>
                </tr>
                <tr>
                    <td><b>Contraseña:</b></td>
                    <td>
                        <input type="text" id="txtpassword" name="txtpass" required>
                        <button type="button" class="button-generate" onclick="generarPassword()">Generar contraseña</button>
                    </td>
                </tr>
                <tr>
                    <td><b>Confirmar Contraseña:</b></td>
                    <td><input type="text" name="txtrepass" required></td>
                </tr>
                <tr>
                    <td><b>Código Universitario:</b></td>
                    <td><input type="text" name="txtcodigo" required></td>
                </tr>
                
                <tr>
                    <td><b>Tipo Usuario:</b></td>
                    <td>
                        <?php
                        if ($f->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($f)) {
                                echo '<input type="radio" name="opctipo" value="' . $row['id'] . '" required> ' . $row['nombre_tipo'] . '<br>';
                            }
                        } else {
                            echo "No hay tipos de usuario disponibles.";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center" style="text-align: right;">
                        <input type="submit" value="Registrarse" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; text-decoration: none;">
                        <a href="Login.php" style="margin-left: 120px; padding: 8px 10px; background-color: #6c757d; color: white; border: none; border-radius: 5px; text-decoration: none;">Iniciar sesión</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
