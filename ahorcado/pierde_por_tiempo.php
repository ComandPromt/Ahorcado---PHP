<?php
session_start();
if (!isset($_SESSION['jugador']) || $_SESSION['jugador']==""){
	header('Location: index.php');
}
else{
	include("funciones.php");
	include("apertura-base.php");	
	$jugador=$_SESSION['jugador'];
	if(strlen($_SESSION['palabra'])>1){
		$resultado=saberPuntos($jugador);
		if($resultado==0 || ($resultado-5)<=0){
			mysqli_query($conexion, "UPDATE JUGADORES SET Puntos = 0 WHERE Nombre = '$jugador'");
		}
		else{

			if(count($_SESSION['letras_jugadas'])==0 &&  strlen($_SESSION['yajugada'])==1){
				$resultado-=15;
			}
			$resultado-=5;
			mysqli_query($conexion, "UPDATE JUGADORES SET Puntos = $resultado WHERE Nombre = '$jugador'");
		}
	}
	header('Location: perder.php');
}
?>