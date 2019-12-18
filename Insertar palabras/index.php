<?php
if(isset($_POST['enviar']) && $_POST['lang']!=null){
// Las palabras con espacios en el fichero y terminado en .
// Se insertaran con espacios ej: la CAsa. --> La casa
// Hay que poner las tildes en el fichero de texto
// Se insertaran con espacios ej: atún --> atun
include("funciones.php");
//$mysqli = new mysqli('localhost', 'root', 'root', 'ahorcado');
$mysqli = new mysqli('192.168.1.100', 'root', 'ratonatqm71114', 'ahorcado');
$lineas = file('palabras.txt');
$palabras = array();
$tilde = array();
foreach ($lineas as $num_línea => $lineas) {
    $palabra = trim(htmlspecialchars($lineas));
	$palabra = str_replace("0", "", $palabra);
    $palabra = str_replace("1", "", $palabra);
    $palabra = str_replace("2", "", $palabra);
    $palabra = str_replace("3", "", $palabra);
    $palabra = str_replace("4", "", $palabra);
    $palabra = str_replace("5", "", $palabra);
    $palabra = str_replace("6", "", $palabra);
    $palabra = str_replace("7", "", $palabra);
    $palabra = str_replace("8", "", $palabra);
    $palabra = str_replace("9", "", $palabra);
	
    if (substr($palabra, -1) == ".") {
        $palabra = str_replace(".", "", $palabra);
    } else {
        $palabra = str_replace(" ", "", $palabra);
    }
    $palabras[] = $palabra;
}
for ($x = 0; $x < count($palabras); $x++) {
	 $palabras[$x] = eliminar_ene($palabras[$x]);
    $tilde[] = saber_tilde($palabras[$x]);
   
}

switch($_POST['lang']){
	case 0:
	$idioma="ANGLICISMOS";
	$indice="IDA";
	break;
	case 1:
	$idioma="SPANISH";
	$indice="IDS";
	break;
	case 2:
	$idioma="INGLES";
	$indice="IDI";
	break;
	case 3:
	$idioma="FRANCES";
	$indice="IDF";
	break;
}

$consulta = "SELECT MAX($indice)+1 FROM $idioma";

$resultado = $mysqli->query($consulta);
$fila = $resultado->fetch_row();

if($fila[0]==NULL){$idp =1;}
else{
	$idp = $fila[0];
}
$y=0;

for ($x = 0; $x < count($palabras); $x++) {
	$palabras[$x] = eliminar_espacios($palabras[$x]);

    $consulta = "SELECT Palabra FROM $idioma WHERE Palabra='$palabras[$x]'";

	$resultado = $mysqli->query($consulta);
    $fila = $resultado->fetch_row();
	if($_POST['lang']!=1){
		$tilde[$x]=0;
	}

	if ($fila[0] == "" && $palabras[$x] != "" ) {
		$y++;
        $palabras[$x] = pasar_la_primera_letra_a_mayuscula($palabras[$x]);
        $long=strlen($palabras[$x]);
        $consulta = "INSERT INTO $idioma VALUES ($idp,'$palabras[$x]')";
		$resultado = $mysqli->query($consulta) or die("Error. Revisa la consulta ".$consulta);
		$consulta = "INSERT INTO PALABRAS VALUES ($idp,".$_POST['lang'].",$long,$tilde[$x],DEFAULT,DEFAULT)";
		$resultado = $mysqli->query($consulta) or die("Error. Revisa la consulta ".$consulta);
	    }
	else {
        $idp -= 1;
    }
    $idp++;
}

print "<h1>Numero de filas insertadas: ".$y."</h1>";

}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<img src="flag-english.png"/>
<input name="lang" type="radio" value="0">Anglicismo</input>
<img src="flag-english.png"/>
<input name="lang" type="radio" value="1">Espa&ntilde;ol</input>
<img src="flag-english.png"/>
<input name="lang" type="radio" value="2">English</input>
<img src="flag-english.png"/>
<input name="lang" type="radio" value="3">Français</input>
<input type="submit" name="enviar"/>
</form>