<?php
session_start();
include("../funciones.php");
$admin=verAdmmin();
if(!isset($_SESSION['jugador']) || $_SESSION['jugador']!=$admin) {
	header('Location: ../index.php');
}
else{
include("cabecera.html");
print '<div style="border:1px solid blue;"><table style="text-align:center;margin:auto;width:100%;height:100%;">
<tr>
	<th colspan="2" style="font-weight:bold;font-size:40px;color:#38019F;text-align:center;">Palabra m&aacute;s acertada<hr/></th>
</tr>
<tr>
	<th><img src="img/palabra.jpg" style="width:80px;height:80px;"></br></br></th>
	<th style="font-weight:bold;font-size:40px;font-weight:bold;">Aciertos</th>
</tr>';
include("../apertura-base.php");
$palabra = array();
$aciertos = array();
$tildes = array();
$consulta = "SELECT S.Palabra, MAX(P.Aciertos) as maximo,P.Tilde
FROM PALABRAS P
JOIN SPANISH S ON  P.IDP=S.IDS
GROUP BY S.Palabra  HAVING maximo>0 ORDER BY maximo DESC,S.Palabra ASC";
$resultado = $mysqli->query($consulta);
while ($fila = $resultado->fetch_row()) {
    $palabra[] = $fila[0];
    $aciertos[] = $fila[1];
	$tildes[] = $fila[2];
}
for ($x = 0; $x < count($palabra); $x++) {
	$palabra[$x]=sacar_palabras($palabra[$x],$tildes[$x]);
	$palabra[$x]=letras_no_ascii(195,$palabra[$x],"Ñ");
	$palabra[$x]=letras_no_ascii(183,$palabra[$x],"Á");
	$palabra[$x]=letras_no_ascii(212,$palabra[$x],"É");
	$palabra[$x]=letras_no_ascii(141,$palabra[$x],"Í");
	$palabra[$x]=letras_no_ascii(227,$palabra[$x],"Ó");
	$palabra[$x]=letras_no_ascii(233,$palabra[$x],"Ú");
    print '<tr><td style="font-weight:bold;font-size:35px;">' . $palabra[$x] . "</br></br></td>";
    print '<td style="font-weight:bold;font-size:35px;">' . $aciertos[$x] . "</br></td></tr>";
}
print "</table></div></body>
</html>";
}
?>