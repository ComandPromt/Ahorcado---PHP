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
<body id="zoom">
      <section class="contenido">
<?php
session_start();

if ($_SESSION['jugador'] == "") {
    if (isset($_POST['procesar'])) {
        include("apertura-base.php");
        $consulta = mysqli_query($conexion, "SELECT Nombre FROM JUGADORES WHERE Nombre = '" . $_POST['nombre'] . "'");
        $nombre = mysqli_fetch_row($consulta);
        $nombre = $nombre[0];
        $consulta = mysqli_query($conexion, "SELECT Pass FROM JUGADORES WHERE Nombre = '" . $_POST['nombre'] . "'");
        $contrasenya = mysqli_fetch_row($consulta);
        $contrasenya = $contrasenya[0];
        $jugador = trim($_POST['nombre']);
        $llave = trim($_POST['pass']);
        if ($jugador == "" && $llave == "") {
            $mensaje = "rellena todos los datos";
        } else {
            if ($jugador == "") {
                $mensaje = "El nombre NO debe estar vac&iacute;o";
            } else {
                if ($llave == "") {
                    $mensaje = "La contrase&ntilde;a NO debe estar vac&iacute;a";
                } else {
                    if ($jugador == null || $nombre == null) {
                        print '<br/><h1 style="color:red">El usuario ' . $jugador . ' NO EXISTE<span></h1>';
                    }

                    if (strcmp($jugador, $nombre) == 0 && strcmp($llave, $contrasenya) == 0) {
                        $_SESSION['jugador'] = $jugador;
						mysqli_query($conexion, "UPDATE JUGADORES SET onnline = '1' WHERE Nombre='$jugador'");
						header('Location: index.php');
                    }
                }
            }
        }
    }
    print "<br/>";
    if ($mensaje != "") {
        print '<h1 style="color:red;">' . $mensaje . '</h1>';
    }
    print'	<body id="zoom">
		<div style="margin-top:15px;">';
    print'	<form method="post" action="';
    print $_SERVER['PHP_SELF'];
    print ' ">
				<table>
					<tr>
						<td class="centrar"><img style="height:100px;width:100px;" src="img/user.png" class="imagesize" /></td>
					</tr>
					<tr>
						<td colspan="6" class="centrar"><input placeholder="Usuario" style="height:50px;font-size:45px;font-weight:bold;" class="centrar" name="nombre" type="text" value=""/><br/></td>
					</tr>
					<tr>
						<td class="centrar"><br/><img style="height:100px;width:100px;" src="img/pass.png" class="imagesize" /></td>
					<tr/>
					<tr>
					<td colspan="6" class="centrar">
						<input placeholder="Contraseña" style="height:50px;font-size:45px;font-weight:bold;" name="pass" type="password" class="centrar" value=""></input></td>
					</tr>
					<tr>
						<td colspan="7" class="centrar">
							<br/>
							<button name="procesar" type="submit">
								<img style="height:100px;width:100px;" src="img/login.ico" class="imagesize" />
							</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>';
} else {
    header('Location: index.php');
}
?>