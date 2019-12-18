<?php  
$hostbd="localhost";
$userbd="root";
$passbd="ratonatqm71114";
$conexion=mysqli_connect($hostbd,$userbd,$passbd,"ahorcado");
mysqli_select_db($conexion,'ahorcado');
$mysqli = new mysqli('localhost', 'root', $passbd, 'ahorcado');
?> 