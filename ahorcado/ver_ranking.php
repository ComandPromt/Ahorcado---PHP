<?php
error_reporting(0);
session_start();
function posicion_actual(){
	include ("apertura-base.php");
	$posicion=mysqli_query($conexion, "SELECT Posicion FROM JUGADORES WHERE Nombre='".$_SESSION['jugador']."'");
	$posicion =mysqli_fetch_row($posicion);
	return $posicion[0];
}

function insertarPosicion(){
	include ("apertura-base.php");
	$idj=mysqli_query($conexion,"SELECT IDJ FROM JUGADORES ORDER BY Puntos DESC");
	$posicion=1;
	while ($fila = mysqli_fetch_row($idj)){
		mysqli_query($conexion, "UPDATE JUGADORES SET Posicion =".$posicion++." WHERE IDJ =".$fila[0]);	
	}
}

function verRanking(){
	include ("apertura-base.php");
	$consulta=mysqli_query($conexion,"SELECT Posicion,Nombre,Puntos FROM JUGADORES ORDER BY Puntos DESC LIMIT 10");	
	$ranking=array();
	while ($fila = mysqli_fetch_row($consulta)){
       $ranking[]=$fila[0];
	   $ranking[]=$fila[1];
	   $ranking[]=$fila[2];
	}
	$clase=array("<img  style='width:80px;heigth:80px;' src='img/1_st.png'/>","<img style='width:80px;heigth:80px;' src='img/2_nd.png'/>","<img style='width:80px;heigth:80px;' src='img/3_rd.png'/>",);
	$row=posicion_actual();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Ahorcado</title>
  <link rel="icon" href="img/favicon.png" type="image/x-icon"/>
  <link rel="stylesheet" href="css/reset.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/fuente.css">
   <link rel="stylesheet" href="css/registro.css">
</head>
<body  style="-moz-transform: scale(1.01,1);">
      <section class="contenido">

	   <div style="float:left;font-size:25px;padding-left:20px;padding-top:10px;font-family:Aero;color:#081A8D">
	   Home<a href="index.php"><img style="height:60px;width:60px;" src="img/home.png"/></a>
	   </div>
		
	  <?php
	print '
	<table style="text-align:center;margin-left:-6px;font-weight:bold;font-size:35px;font-family:Aero;color:#062B5D;" border="1">
	<tr style="background-color:#E1ED03;color:black;">
		<th>
			Posici&oacute;n
		</th>
		<th>
			Usuario
		</th>
		<th>
			Puntos
		</th>
	</tr>';
	$posicion=4;
	$puesto=0;

	for($x=0;$x<count($ranking);$x++){

		if($puesto<3){
			$tabla= "<tr>
			<td>".$clase[$puesto]."</td>
			<td>".$ranking[++$x]."</td>
			<td>".$ranking[++$x]."</td>
			</tr>";
			$puesto++;
		}
		else{
			$tabla="<tr><td>".++$puesto."</td><td>".$ranking[++$x]."</td><td>".$ranking[++$x]."</td></tr>";	
		}
		if($row==$puesto){
			$tabla=str_replace("<tr>",'<tr id="actual">',$tabla);	
		}
		print $tabla;
	}
	if($row>10){
		print '<tr id="actual"><td>'.$row."</td><td>".$_SESSION['jugador']."</td><td>".print saberPuntos($_SESSION['jugador'])."</td></tr>";
	}
	print '</table></section></body></html>';
}

insertarPosicion();
verRanking();
?>