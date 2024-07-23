<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="css/VariablesGenerales.css" type="text/css">
    <link rel="stylesheet" href="css/EstiloEmpresa.css?ver=1.1" type="text/css">
    <link rel="icon" href="img/Min_logo.png" ; type="image/x-icon" />
</head>

<body>
    <br>
    <form action="ProcesoCrearPerfilEmpresa.php" method="post">
        <input type="hidden" name="codigo" value="<?php echo $_GET['codigo']; ?>">
        <fieldset id="Fieldset">
            <center>
                <h1>DATOS ESPECÍFICOS</h1>
            </center>
            <table border="0" width="560">
                <tr>
                    <td colspan="2">Razón Social</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="TextRazonSocial" class="TextRazonSocial" placeholder="Ingrese razón social" required>
                    </td>
                </tr>
                <tr>
                    <td>RUC</td>
                    <td>Sector</td>
                </tr>
                <tr>
                    <td><input type="text" name="TextRuc" class="Text" placeholder="Ingrese ruc" maxlength="11" required></td>
                    <td><select class="lst-sectore" name="TextSector">
                            <option value="Agricultura y Pesca">Agricultura y Pesca</option>
                            <option value="Minería">Minería</option>
                            <option value="Manufactura">Manufactura</option>
                            <option value="Construcción">Construcción</option>
                            <option value="Comercio y Retail">Comercio y Retail</option>
                            <option value="Transporte y Logística">Transporte y Logística</option>
                            <option value="Turismo y Hotelería">Turismo y Hotelería</option>
                            <option value="Finanzas y Seguros">Finanzas y Seguros</option>
                            <option value="Educación">Educación</option>
                            <option value="Salud">Salud</option>
                            <option value="Tecnología y Telecomunicaciones">Tecnología y Telecomunicaciones</option>
                            <option value="Energía y Servicios Públicos">Energía y Servicios Públicos</option>
                            <option value="Servicios Profesionales">Servicios Profesionales</option>
                            <option value="Alimentos y Bebidas">Alimentos y Bebidas</option>
                            <option value="Inmobiliario">Inmobiliario</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td>Celular</td>
                </tr>
                <tr>
                    <td><input type="text" name="TextDireccion" class="Text" placeholder="Ingrese dirección" required></td>
                    <td><input type="text" name="TextCelular" class="Text" placeholder="Ingrese celular" maxlength="9" required></td>
                </tr>
                <tr>
                    <td>Correo de Contacto</td>
                    <td>Sitio Web</td>
                </tr>
                <tr>
                    <td><input type="text" name="TextCorreo" class="Text" placeholder="Ingrese correo de contacto" required></td>
                    <td><input type="text" name="TextSitioWeb" class="Text" placeholder="https://www.misitioweb.com/"></td>
                </tr>
                <tr>
                    <td colspan="2">Descripción</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="TextDescripcion" class="TextDescripcion" placeholder="Agregue descripción aquí..." required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="GUARDAR" class="Boton">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>