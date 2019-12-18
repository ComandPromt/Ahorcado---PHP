<?php
session_start();
include("../funciones.php");
$admin=verAdmmin();
if(!isset($_SESSION['jugador']) || $_SESSION['jugador']!=$admin) {
	header('Location: ../index.php');
}
else{
function recorrer_array(array $array,$indice,$numero){
	$datos=array();
	for($x=0;$x<strlen($indice);$x++){
		$i=$indice[$x];
		for ($x=0;$x<strlen($indice);$x++){
			if($array[$numero][$x]!=NULL && $array[$numero][$x+1]!=NULL){$separador=" , ";}
			else{$separador="";}
			$datos[]=$array[$numero][$x].$separador;
		}
	}
	return implode($datos);
}
include("cabecera.html");
print '<div style="border:1px solid blue;"><table style="text-align:center;margin:auto;width:100%;height:100%;">
	<tr>
	<hr/>
		<th style="font-size:30px;font-weight:bold;">
			2 letras<hr/>
		</th></tr>';
include("../apertura-base.php");
$consulta = "SELECT S.Palabra,P.Tilde FROM SPANISH S JOIN PALABRAS P ON S.IDS=P.IDP ORDER BY S.Palabra";
$resultado = $mysqli->query($consulta);
$array=array();
$palabra_2_letras=array();
$palabra_3_letras=array();
$palabra_4_letras=array();
$palabra_5_letras=array();
$palabra_6_letras=array();
$palabra_7_letras=array();
$palabra_8_letras=array();
$palabra_9_letras=array();
$palabra_10_letras=array();
while ($fila = $resultado->fetch_row()){
	$fila[0]=sacar_palabras($fila[0],$fila[1]);
	switch(strlen($fila[0])){
		case 2:
			$palabra_2_letras[]=$fila[0];
			$array[0][]=array_pop($palabra_2_letras);
			$indice[]=0;
			break;
		case 3:
			$palabra_3_letras[]=$fila[0];
			$array[1][]=array_pop($palabra_3_letras);
			$indice[]=1;
			break;
	
		case 4:
			$palabra_4_letras[]=$fila[0];
			$array[2][]=array_pop($palabra_4_letras);
			$indice[]=2;
			break;
	
		case 5:
			$palabra_5_letras[]=$fila[0];
			$array[3][]=array_pop($palabra_5_letras);
			$indice[]=3;
			break;
	
		case 6:
			$palabra_6_letras[]=$fila[0];
			$array[4][]=array_pop($palabra_6_letras);
			$indice[]=4;
			break;
	
		case 7:
		$palabra_7_letras[]=$fila[0];
		$array[5][]=array_pop($palabra_7_letras);
		$indice[]=5;
		break;
	
		case 8:
		$palabra_8_letras[]=$fila[0];
		$array[6][]=array_pop($palabra_8_letras);
		$indice[]=6;
		break;
	
		case 9:
		$palabra_9_letras[]=$fila[0];
		$array[7][]=array_pop($palabra_9_letras);
		$indice[]=7;
		break;
	}
}
$indice=implode($indice);
print '<tr>
		<td>&nbsp;'.recorrer_array($array,$indice,0).'<hr/></td>
	</tr>
	<tr>
	<th style="font-size:30px;font-weight:bold;">3 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,1).'<hr/></td></tr>

	<tr><th style="font-size:30px;font-weight:bold;">4 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,2).'<hr/></td></tr>
	

	<tr><th style="font-size:30px;font-weight:bold;">5 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,3).'<hr/></td></tr>
	
<tr><th style="font-size:30px;font-weight:bold;">6 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,4).'<hr/></td></tr>
	<tr><th style="font-size:30px;font-weight:bold;">7 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,5).'<hr/></td></tr>
	<tr><th style="font-size:30px;font-weight:bold;">8 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,6).'<hr/></td></tr>
<tr><th style="font-size:30px;font-weight:bold;">9 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,7).'<hr/></td></tr>
	

	<tr><th style="font-size:30px;font-weight:bold;">10 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,8).'<hr/></td></tr>
	

	<tr><th style="font-size:30px;font-weight:bold;">11 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,9).'<hr/></td></tr>
	

	<tr><th style="font-size:30px;font-weight:bold;">12 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,10).'<hr/></td></tr>
	

	<tr><th style="font-size:30px;font-weight:bold;">13 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,11).'<hr/></td></tr>
	

	<tr><th style="font-size:30px;font-weight:bold;">14 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,12).'<hr/></td></tr>
	

	<tr><th style="font-size:30px;font-weight:bold;">15 letras<hr/></th></tr>
	<tr><td>&nbsp;'.recorrer_array($array,$indice,13).'</td></tr>
</table></div>';

}
?>