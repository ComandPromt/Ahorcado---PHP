<?php
session_start();
include("apertura-base.php");
include ("funciones.php");
$jugador=$_SESSION['jugador'];
mysqli_query($conexion, "UPDATE JUGADORES SET onnline = '0' WHERE Nombre='$jugador'");
liberarVariables();
$_SESSION['jugador']="";
header ("Location: index.php");
?>