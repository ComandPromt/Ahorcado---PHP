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
	<th colspan="2" style="font-weight:bold;font-size:40px;color:#38019F;text-align:center;">Palabra m&aacute;s jugada<hr/></th>
</tr>
<tr>
	<th>
		<img src="img/palabra.jpg" style="width:80px;height:80px;"/>
	</th>
	<th style="font-weight:bold;font-size:40px;font-weight:bold;">Veces</th>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>';
include("../apertura-base.php");
$palabra = array();
$aciertos = array();
$tildes = array();
$consulta = "SELECT S.Palabra, count( A.IDP ) AS total,P.Tilde
FROM ACIERTOS A
JOIN SPANISH S ON S.IDS = A.IDP AND A.IDL=1 JOIN PALABRAS P ON P.IDP=S.IDS
GROUP BY A.IDP
ORDER BY total DESC,S.Palabra ASC";
$resultado = $mysqli->query($consulta);
while ($fila = $resultado->fetch_row()) {
    $palabra[] = $fila[0];
    $aciertos[] = $fila[1];
	$tildes[] = $fila[2];
}
for ($x = 0; $x < count($palabra); $x++) {
	$palabra[$x]=sacar_palabras($palabra[$x],$tildes[$x]);
    print '<tr><td style="font-weight:bold;font-size:35px;">' . $palabra[$x] . "</br></br></td>";
    print '<td style="font-weight:bold;font-size:35px;">' . $aciertos[$x] . "</br></td></tr>";
}
print "</table></div>";
}
?>
</body>
</html>