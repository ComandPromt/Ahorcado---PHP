<?php
include("apertura-base.php");
$consulta=mysqli_query($conexion,"SELECT Nombre FROM JUGADORES WHERE onnline = 1 ORDER BY Nombre");
$fila = mysqli_affected_rows($conexion);

include("cabecera.html");
?>
<div style="margin-top:-15px;zoom:120%;">
    <nav>
        <ul style="font-size:20px;" class="primary">
            <li style="padding-top:10px;">
                <a href="index.php">Home
                    <img style="height:60px;width:60px;" src="img/home.png"/>
                </a>
            </li>

<li>
</li>
        </ul>
    </nav>
</div>
<?php
print '<table style="font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse;">
<tr>
<th style=" font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; ">Nombre<hr/></th>
</tr>';
if($fila>0){
	while ($fila = mysqli_fetch_row($consulta)){
      print '<tr><td style="padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; ">'.$fila[0]."</td></tr>";

	}
}

print '</table>';




?>