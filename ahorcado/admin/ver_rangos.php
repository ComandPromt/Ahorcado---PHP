<?php
session_start();
include("../funciones.php");
$admin=verAdmmin();
if(!isset($_SESSION['jugador']) || $_SESSION['jugador']!=$admin) {
	header('Location: ../index.php');
}
else{
//include("apertura-base.php");
//print "Gestionar usuarios";
print '<table  style="border:1px solid black;text-align:center;margin:auto;">
<tr>
<th>Usuario</th>
<th>Puntos</th>
<th>Editar</th>
<th>Borrar</th>
</tr>';
include("../apertura-base.php");
$consulta = "SELECT Nombre,Puntos FROM JUGADORES ORDER by Nombre";
if ($resultado = $mysqli->query($consulta)) {
    /* obtener el array de objetos */
    while ($fila = $resultado->fetch_row()) {
        printf ("<tr><td>%s</td><td>%s</td>", $fila[0], $fila[1]);
		print "<td>Editar</td><td>Borrar</td>";
	}
    /* liberar el conjunto de resultados */
    $resultado->close();
}
print "<tr></table>";
/*
print "Gestionar palabras";
print "<table>
<tr>
<th>Palabra</th>
<th>Aciertos</th>
</tr>
</table>";
print "Grafica";
print "<table>
<tr>
<th>Palabra</th>
<th>Aciertos</th>
</tr>
</table>";
*/
}
?>