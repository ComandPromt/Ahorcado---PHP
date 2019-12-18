<?php
session_start();
include("../funciones.php");
$admin=verAdmmin();
if(!isset($_SESSION['jugador']) || $_SESSION['jugador']!=$admin) {
	header('Location: ../index.php');
}
else{
include("cabecera.html");
include("../apertura-base.php");

// Realizar una consulta SQL
$consulta = "SELECT J.NOMBRE, A.IDP ,A.IDL,A.Aciertos,A.Fallos,Vidas FROM  ACIERTOS A JOIN JUGADORES J ON A.IDJ=J.IDJ ORDER BY J.NOMBRE,Orden";

$resultado = $mysqli->query($consulta);
$x=0;
print '<table style="text-align:center;margin:auto;font-weight:bold;font-size:40px;"><tr style="background-color:#E1ED03;color:#1E4762;"><th>Nombre</th><th>Palabra</th><th>Idioma</th><th>Aciertos</th><th>Fallos</th><th>Vidas</th></tr>';
while($fila = $resultado->fetch_row()){
switch($fila[2]){
	case 0:
		$tabla ="ANGLICISMOS";
		$indice="IDA";
		$imagen="anglicismos.jpg";
	break;
	
	case 1:
		$tabla ="SPANISH";
		$indice="IDS";
		$imagen="spanish.png";
	break;
	
	case 2:
		$tabla ="INGLES";
		$indice="IDI";
		$imagen="english.png";
	break;
	
	case 3:
		$tabla="FRANCES";
		$indice="IDF";
		$imagen="french.png";
	break;

}
	
$consulta2 ="SELECT Palabra,P.Tilde FROM $tabla A JOIN PALABRAS P ON A.$indice=P.IDP WHERE $indice=".$fila[1];
$resultado2 = $mysqli->query($consulta2);	
$fila2 = $resultado2->fetch_row();
$palabra = sacar_palabras($fila2[0],$fila2[1]);
if($palabra[$x][0]=="ñ"){
	$palabra[$x][0]="Ñ";
}	




print "<tr><td>".$fila[0]."</td>"."<td>".$palabra."</td>"."<td><img style=\"height:40px;width:40px;\" src=\"../img/$imagen".'"/></td>'."<td style=\"background-color:#2DF281;\">".$fila[3]."</td>"."<td style=\"background-color:#FE5555\">".$fila[4]."</td>"."<td style=\"background-color:#9BFCFF;\">".$fila[5]."</td></tr>";
$x++;
}
print "</table>";

$mysqli->close();
}
?>