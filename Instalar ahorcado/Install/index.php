<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript">

			function mostrarReferencia(){

				if (document.fcontacto.Conocido[1].checked == true) {
					document.getElementById('desdeotro').style.display='block';
				}

				else {
					document.getElementById('desdeotro').style.display='none';
				}
			}
		</script>
	</head>
	<body>
<?php
error_reporting(0);

function limpiar_cadena($cadena){
    $cadena = str_replace("  ", " ", $cadena);
    $cadena = trim($cadena);
    return $cadena;
}

$mensaje="";

if (isset($_POST['enviar']) && isset($_POST['ip']) && trim($_POST['ip']) != ""
    && isset($_POST['userbd']) && trim($_POST['userbd']) != ""
    && isset($_POST['adminuser']) && trim($_POST['adminuser']) != ""
    && isset($_POST['passuser']) && trim($_POST['passuser']) != ""
    && isset($_POST['Conocido'])
) {
    $_POST['ip'] = limpiar_cadena($_POST['ip']);
    $_POST['userbd'] = limpiar_cadena($_POST['userbd']);
    $_POST['adminuser'] = limpiar_cadena($_POST['adminuser']);

    if ($_POST['Conocido'] == "Si") {
        $pass = trim($_POST['passbd']);
	}
	
    if ($_POST['Conocido'] == "No") {
        $pass = "";
    }

    $conexion = mysqli_connect($_POST['ip'], $_POST['userbd'], $pass, "phpmyadmin");

	if (mysqli_connect_errno() != null) {
		$mensaje='<h1 class="mensaje error">Fallo en la IP y/o usuario y/o contrase&ntilde;a de la BD</h1>';
	}

	else {
        	mysqli_query($conexion, "DROP DATABASE ahorcado");
       	 	mysqli_query($conexion, "CREATE DATABASE ahorcado");
        	$conexion = mysqli_connect($_POST['ip'], $_POST['userbd'], $pass, "ahorcado");
        	mysqli_select_db($conexion, 'ahorcado');
            $texto = file_get_contents("ahorcado.sql");
			$sentencia = explode(";", $texto);
			
            for ($i = 0; $i < (count($sentencia) - 1); $i++) {
                $sentencia[$i] .= ";";
                mysqli_query($conexion, $sentencia[$i]);
  
                //    mysqli_query ($conexion,"INSERT INTO JUGADORES VALUES(0," . $_POST['adminuser'] . " " . $_POST['passuser'] . " );";
            }

            mysqli_close($conexion);
            $mensaje='<h1 class="mensaje" style="text-align:center;color:blue;">Instalaci&oacute;n realizada correctamente</h1>';
            $mensaje.='<h1 class="mensaje" style="text-align:center;color:blue;">Borra esta carpeta</h1>';
    }

}
else{
	if(isset($_POST['enviar'])){
	if (!isset($_POST['userbd']) || trim($_POST['userbd']) == "") {
		$mensaje.='<h2 class="mensaje error" style="color:red;">Inserta el nombre de usuario de la BD</h2>';
	}

	if (!isset($_POST['ip']) || trim($_POST['ip']) == "") {
		$mensaje.='<h2 class="mensaje error" style="color:red;">Inserta la IP o el nombre de dominio de la BD</h2>';
	}

	if(!isset($_POST['adminuser']) || trim($_POST['adminuser'])==""){
		$mensaje.='<h2 class="mensaje error" style="color:red;">El administrador del juego no debe estar vac&iacute;o</h2>';
	}
	if(!isset($_POST['passuser']) || trim($_POST['passuser'])==""){
		$mensaje.='<h2 class="mensaje error" style="color:red;">La contrase&ntilde;a del administrador del juego no debe estar vac&iacute;a</h2>';
	}
}
}

if($mensaje!=""){
	print '<div style="background-color:#D9DACD;">';
	print $mensaje.'</div>';
	print "<hr/>";
}
include 'formulario.html';
?>