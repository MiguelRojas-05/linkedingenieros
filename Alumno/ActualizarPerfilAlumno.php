<?php
include '../Auth/Alumno.php';
include '../Conexion.php';

$c=$_SESSION["codigo_usuario"];

$Sql = "select * from alumno
where codigo='$c'";

$Fila=mysqli_query($cn,$Sql);
$Registro=mysqli_fetch_assoc($Fila);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno - Actualizar Datos</title>
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
    <link rel="stylesheet" href="../css/EstiloActualizar.css?ver=1.4" type="text/css">
</head>
<body>

<?php  
include '../Componentes/NavBarAlumno.php';
?>
    <br><br>
    <form class="mt-4" action="ProcesoActualizarPerfilAlumno.php" method="post">
        <center>
            <h3 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">ACTUALIZAR PERFIL</h3>
        </center>
        <table class="tb-apa" width="420" border="0">
            <br>
            <tr>
                <td colspan="2">Nombre(s)</td>
            </tr>
            <tr>
                <td colspan="2"><input type="text" name="txtnombre" value="<?php echo $Registro["nombre"]; ?>"></td>
            </tr>
            <tr>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
            </tr>
            <tr>
                <td><input type="text" name="txtap" value="<?php echo $Registro["a_paterno"]; ?>"></td>
                <td><input type="text" name="txtam" value="<?php echo $Registro["a_materno"]; ?>"></td>
            </tr>
            <tr>
                <td>Escuela Profesional</td>
                <td>Celular</td>
            </tr>
            <tr>
                <td>
                <?php
                    $IngSis="";
                    $IngInd="";
                    $IngElec="";
                    $IngInf="";
                    if ($Registro["escuela"]==="Ingeniería Industrial") {
                        $IngInd= "selected";
                    }
                    else if($Registro["escuela"]==="Ingeniería de Sistemas"){
                        $IngSis= "selected";
                    }
                    else if($Registro["escuela"]==="Ingeniería de Informática"){
                        $IngInf= "selected";
                    }
                    else if($Registro["escuela"]===null){

                    }
                    else{
                        $IngElec= "selected";
                    }
                    ?>
                    <select name="lstescuela" class="lst-escuela">
                        <option value="" disabled >Seleccione una escuela</option>
                        <option value="Ingeniería de Sistemas" <?php echo $IngSis; ?> >Ingeniería de Sistemas</option>
                        <option value="Ingeniería de Informática" <?php echo $IngInf; ?> >Ingeniería Informática</option>
                        <option value="Ingeniería Industrial" <?php echo $IngInd; ?> >Ingeniería Industrial</option>
                        <option value="Ingeniería Electrónica" <?php echo $IngElec; ?> >Ingeniería Electrónica</option>
                    </select>
                </td>
                <td><input type="text" name="txtcel" value="<?php echo $Registro["celular"]; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Actualizar Datos" class="btn-actualizar"></td>
            </tr>
        </table>
    </form>
    <br>
    <center>
        <h5 style="color: green; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
        <?php
        if(isset($_GET["mensaje"])){
            $Mensaje=$_GET["mensaje"];
        echo "$Mensaje";
        }else{

        }
        ?>
        </h5>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>