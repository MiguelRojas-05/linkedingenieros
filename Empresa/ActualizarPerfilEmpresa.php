<?php
include '../Auth/Empresa.php';
include '../Conexion.php';

$c=$_SESSION["codigo_usuario"];

$Sql = "select * from empresa
where codigo='$c'";

$Fila=mysqli_query($cn,$Sql);
$Registro=mysqli_fetch_assoc($Fila);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - Actualizar Datos</title>
    <link rel="stylesheet" href="../css/EstiloActualizarEmpresa.css?ver=1.4" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
    
</head>
<body>
<?php  
include '../Componentes/NavBarEmpresa.php';
?>
    <br><br>
    <form action="ProcesoActualizarPerfilEmpresa.php" method="post">
        <br><br>
            <center>
                <h4 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    ACTUALIZAR DATOS
                </h4>
            </center>
            <table border="0" width="580" class="tb-ape">
                <tr>
                    <td colspan="2">Razón Social</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="TextRazonSocial" class="text-campo" placeholder="Ingrese razón social" value="<?php echo $Registro["razon_social"];?>" required>
                    </td>
                </tr>
                <tr>
                    <td>RUC</td>
                    <td>Sector</td>
                </tr>
                <tr>
                    <td><input type="text" name="TextRuc" class="text-campo" placeholder="Ingrese ruc" maxlength="11" value="<?php echo $Registro["ruc"];?>" required></td>
                    <td>
                        <?php
                        $Agr="";
                        $Min="";
                        $Man="";
                        $Cons="";
                        $Com="";
                        $Trans="";
                        $Tur="";
                        $Fin="";
                        $Edu="";
                        $Salud="";
                        $Tec="";
                        $Energ="";
                        $Serv="";
                        $Alim="";
                        $Inmob="";
                        if ($Registro["sector"]==="Agricultura y Pesca") {
                            $Agr= "selected";
                        }
                        else if($Registro["sector"]==="Minería"){
                            $Min= "selected";
                        }
                        else if($Registro["sector"]==="Manufactura"){
                            $Man= "selected";
                        }
                        else if($Registro["sector"]==="Construcción"){
                            $Cons= "selected";
                        }
                        else if($Registro["sector"]==="Comercio y Retail"){
                            $Com= "selected";
                        }
                        else if($Registro["sector"]==="Transporte y Logística"){
                            $Trans= "selected";
                        }
                        else if($Registro["sector"]==="Turismo y Hotelería"){
                            $Tur= "selected";
                        }
                        else if($Registro["sector"]==="Finanzas y Seguros"){
                            $Fin= "selected";
                        }
                        else if($Registro["sector"]==="Educación"){
                            $Edu= "selected";
                        }
                        else if($Registro["sector"]==="Salud"){
                            $Salud= "selected";
                        }
                        else if($Registro["sector"]==="Tecnología y Telecomunicaciones"){
                            $Tec= "selected";
                        }
                        else if($Registro["sector"]==="Energía y Servicios Públicos"){
                            $Energ= "selected";
                        }
                        else if($Registro["sector"]==="Servicios Profesionales"){
                            $Serv= "selected";
                        }
                        else if($Registro["sector"]==="Alimentos y Bebidas"){
                            $Alim= "selected";
                        }
                        else if($Registro["sector"]==="Inmobiliario"){
                            $Inmob= "selected";
                        }
                        ?>
                        <select name="TextSector" class="lst-sector">
                            <option value="" disabled >Seleccione un sector</option>
                            <option value="Agricultura y Pesca" <?php echo $Agr; ?> >Agricultura y Pesca</option>
                            <option value="Minería" <?php echo $Min; ?> >Minería</option>
                            <option value="Manufactura" <?php echo $Man; ?> >Manufactura</option>
                            <option value="Construcción" <?php echo $Cons; ?> >Construcción</option>
                            <option value="Comercio y Retail" <?php echo $Com; ?> >Comercio y Retail</option>
                            <option value="Transporte y Logística" <?php echo $Trans; ?> >Transporte y Logística</option>
                            <option value="Turismo y Hotelería" <?php echo $Tur; ?> >Turismo y Hotelería</option>
                            <option value="Finanzas y Seguros" <?php echo $Fin; ?> >Finanzas y Seguros</option>
                            <option value="Educación" <?php echo $Edu; ?> >Educación</option>
                            <option value="Salud" <?php echo $Salud; ?> >Salud</option>
                            <option value="Tecnología y Telecomunicaciones" <?php echo $Tec; ?> >Tecnología y Telecomunicaciones</option>
                            <option value="Energía y Servicios Públicos" <?php echo $Energ; ?> >Energía y Servicios Públicos</option>
                            <option value="Servicios Profesionales" <?php echo $Serv; ?> >Servicios Profesionales</option>
                            <option value="Alimentos y Bebidas" <?php echo $Alim; ?> >Alimentos y Bebidas</option>
                            <option value="Inmobiliario" <?php echo $Inmob; ?> >Inmobiliario</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td>Celular</td>
                </tr>
                <tr>
                    <td><input type="text" name="TextDireccion" class="text-campo" placeholder="Ingrese dirección" value="<?php echo $Registro["direccion"];?>" required></td>
                    <td><input type="text" name="TextCelular" class="text-campo" placeholder="Ingrese celular" maxlength="9" value="<?php echo $Registro["celular"];?>" required></td>
                </tr>
                <tr>
                    <td>Correo de Contacto</td>
                    <td>Sitio Web</td>
                </tr>
                <tr>
                    <td><input type="text" name="TextCorreo" class="text-campo" placeholder="Ingrese correo de contacto" value="<?php echo $Registro["correo_contacto"];?>" required></td>
                    <td><input type="text" name="TextSitioWeb" class="text-campo" placeholder="https://www.misitioweb.com/" value="<?php echo $Registro["sitio_web"];?>"></td>
                </tr>
                <tr>
                    <td colspan="2">Descripción</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="TextDescripcion" class="text-area" placeholder="Agregue descripción aquí..."  required><?php echo htmlspecialchars($Registro["descripcion"]);?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="GUARDAR" class="btn-guardar">
                    </td>
                </tr>
            </table>
    </form>
    <br>
    <center>
        <h5 style="color: green; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
        <?php
        if(isset($_GET["mensaje2"])){
            $Mensaje=$_GET["mensaje2"];
        echo "$Mensaje";
        }else{

        }
        ?>
        </h5>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
</body>
</html>