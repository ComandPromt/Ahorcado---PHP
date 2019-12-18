<?php
session_start();
$_SESSION['tiempo']=0;
include("funciones.php");
$link = "sounds/victory.mp3";

include("cabecera.php");

    if (!isset($_SESSION['jugador']) || $_SESSION['jugador'] == "") {
        header('Location: index.php');
    } else {
        $salir = $_POST['salir'];
        if ($salir == "si") {
            header("Location: index.php");
        } else {
            if ($salir == "no") {
                header("Location: ahorcado.php");
            }
           
            include("apertura-base.php");
            $palabra = $_SESSION['palabra'];
            $aciertos = $_SESSION['aciertos'];
            $fallos = $_SESSION['numerofallos'];
            $vidas_por_defecto = $_SESSION['vidas_por_defecto'];
            $vidas = $_SESSION['vidas'];
            $jugador = $_SESSION['jugador'];
            if (strpos($_SESSION['palabra'], "-") >= 0) {
                $_SESSION['palabra'] = str_replace("-", "ñ", $_SESSION['palabra']);
            }
			if (strpos($_SESSION['palabra'], ".") >= 0) {
            $_SESSION['palabra'] = str_replace(".", "ü", $_SESSION['palabra']);
        }
            if ($jugador != "") {
                if ($_SESSION['palabra'] != "") {
                    $puntos = saberPuntos($jugador);

                    if (strlen($_SESSION['palabra']) == 1) {
                        $puntuacion = $puntos + 100;
                    } else {
                        $adicional = asignar_Puntos_Adicional($vidas_por_defecto, $vidas);
						$puntuacion = asignar_Puntos($aciertos, $fallos, $puntos, $adicional);
                    }

                    $palabra = $_SESSION['palabra'];
					$idioma= $_SESSION['idioma'];
                    $IDJ = verIDJ(IDJ);
                    $IDP = verIDP($_SESSION['palabra']);
                    $aciertospalabra = saberAciertos(true);
                    mysqli_query($conexion, "UPDATE PALABRAS SET ACIERTOS=$aciertospalabra WHERE IDP=$IDP AND IDL = $idioma");

                    $consulta = mysqli_query($conexion, "SELECT ACIERTOS FROM JUGADORES WHERE NOMBRE = '$jugador'");
                    $aciertos = mysqli_fetch_row($consulta);
                    $aciertos = $aciertos[0] + 1;
                    $consulta = mysqli_query($conexion, "SELECT ACIERTOS FROM ACIERTOS WHERE IDJ=$IDJ AND IDP=$IDP AND IDL = $idioma");
	                $aciertosAC = mysqli_fetch_row($consulta);
                    $aciertosAC = $aciertosAC[0];
                    mysqli_query($conexion, "UPDATE JUGADORES SET ACIERTOS=$aciertos WHERE NOMBRE ='$jugador'");
                    $consulta = mysqli_query($conexion, "SELECT Vidas FROM ACIERTOS WHERE IDP = $IDP AND IDL = $idioma");
                    $nuevasvidas = mysqli_fetch_row($consulta);
                    $nuevasvidas = $nuevasvidas[0];
                    if ((strlen($aciertosAC) > 0 && $aciertosAC != NULL) && (strlen($nuevasvidas) > 0 && $nuevasvidas != NULL)) {
                        $nuevasvidas += $vidas;

                        mysqli_query($conexion, "UPDATE ACIERTOS SET ACIERTOS=$aciertosAC+1 WHERE IDJ=$IDJ AND IDL=$idioma AND IDP=$IDP");
						mysqli_query($conexion, "UPDATE ACIERTOS SET VIDAS=$nuevasvidas WHERE IDJ=$IDJ AND IDL=$idioma AND IDP=$IDP");
                    } else {

 $consulta = mysqli_query($conexion, "SELECT Orden FROM ACIERTOS ORDER BY Orden");
                    $numeros = array();
                    while ($fila = mysqli_fetch_row($consulta)) {
                        $numeros[] = $fila[0];
                    }
                   
                        $numero = consecutivos($numeros);

                        mysqli_query($conexion, "INSERT INTO ACIERTOS VALUES($IDJ,$IDP,$idioma,1,0,$vidas,$numero)");
                    }

                   mysqli_query($conexion, "UPDATE JUGADORES SET PUNTOS = $puntuacion WHERE NOMBRE='$jugador'");

                    $_SESSION['palabra'] = "";
                }
            }
        }
        
    }

liberarVariables();
?>

<script LANGUAGE="JavaScript">
var pagina="index.php"
function redireccionar() 
{
location.href=pagina
} 
setTimeout ("redireccionar()", 3000);
</script>