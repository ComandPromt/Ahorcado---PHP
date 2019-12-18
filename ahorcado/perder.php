<?php
session_start();
$_SESSION['tiempo']=0;
if (!isset($_SESSION['jugador']) || $_SESSION['jugador'] == "") {
    header('Location: index.php');
} else {
    include("funciones.php");
    include("apertura-base.php");
    $jugador = $_SESSION['jugador'];
    if (strlen($_SESSION['palabra']) > 1) {
        if (strpos($_SESSION['palabra'], "-") >= 0) {
            $_SESSION['palabra'] = str_replace("-", "ñ", $_SESSION['palabra']);
        }
		if (strpos($_SESSION['palabra'], ".") >= 0) {
            $_SESSION['palabra'] = str_replace(".", "ü", $_SESSION['palabra']);
        }
        if ($jugador != "") {
            $palabra = $_SESSION['palabra'];
			$idioma=$_SESSION['idioma'];
            $IDJ = verIDJ(IDJ);
            $IDP = verIDP($_SESSION['palabra']);
            $fallospalabra = saberAciertos(false);
            mysqli_query($conexion, "UPDATE PALABRAS SET FALLOS=$fallospalabra WHERE IDP=$IDP AND IDL=$idioma");
            $consulta = mysqli_query($conexion, "SELECT Fallos FROM JUGADORES WHERE NOMBRE = '$jugador'");
            $fallos = mysqli_fetch_row($consulta);
            $fallos = $fallos[0] + 1;
            $consulta = mysqli_query($conexion, "SELECT Fallos FROM ACIERTOS WHERE IDJ=$IDJ AND IDP=$IDP AND IDL=$idioma");
            $fallosAC = mysqli_fetch_row($consulta);
            $fallosAC = $fallosAC[0];
            mysqli_query($conexion, "UPDATE JUGADORES SET Fallos=$fallos WHERE NOMBRE ='$jugador'");
            if (strlen($fallosAC) > 0 && $fallosAC != NULL) {
                mysqli_query($conexion, "UPDATE ACIERTOS SET FALLOS=$fallosAC+1 WHERE IDJ=$IDJ AND IDP=$IDP AND IDL=$idioma");
            } else {
				 $consulta = mysqli_query($conexion, "SELECT Orden FROM ACIERTOS ORDER BY Orden");
                    $numeros = array();
                    while ($fila = mysqli_fetch_row($consulta)) {
                        $numeros[] = $fila[0];
                    }
                    $numero = consecutivos($numeros);
					mysqli_query($conexion, "INSERT INTO ACIERTOS VALUES($IDJ,$IDP,$idioma,0,1,0,$numero)");
            }
            $resultado = saberPuntos($jugador);
            if ($resultado > 0) {
                $resultado -= 1;
				mysqli_query($conexion, "UPDATE JUGADORES SET PUNTOS = $resultado WHERE NOMBRE = '$jugador'");
            }
        
    }
    liberarVariables();
    header('Location: lose.php');
}
}
?>