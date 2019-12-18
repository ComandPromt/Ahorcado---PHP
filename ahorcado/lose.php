<?
session_start();
include("funciones.php");
if (!isset($_SESSION['jugador']) || $_SESSION['jugador']=="")
{
	header('Location: index.php');
}
else{
	$salir=$_POST['salir'];
	if($salir=="si"){
		header ("Location: index.php");
	}
	else{
		if($salir=="no"){
			header ("Location: ahorcado.php");
		}
		$link = "sounds/gameover.mp3";
		include("cabecera.php");
	}
}

?>
<script LANGUAGE="JavaScript">
var pagina="index.php"
function redireccionar() 
{
location.href=pagina
} 
setTimeout ("redireccionar()", 3000);
</script>
			