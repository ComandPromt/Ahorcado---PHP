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

if (isset($_POST['enviar'])) {
    $jnombre = trim($_POST['jnombre']);
    $pass = trim($_POST['pass']);
    $sexo = $_POST['sexo'];
	$idioma = $_POST['idioma'];
    if ($jnombre == "" && $pass == "") {
        $mensaje = "rellena todos los datos";
    } 
    else {
        if ($jnombre == "") {
            $mensaje = "El nombre NO debe estar vac&iacute;o";
        }
        else {
            if ($pass == "") {
                $mensaje = "La contrase&ntilde;a NO debe estar vac&iacute;a";
            }
            else {
                include ("apertura-base.php");
                $consulta = mysqli_query($conexion, "SELECT Nombre FROM JUGADORES WHERE Nombre LIKE '$jnombre'");
                $fila = mysqli_fetch_row($consulta);
                if ($fila[0] != NULL && $fila[0] != "") {
                    $mensaje = 'El usuario <span style="color:red;">' . $jnombre . '</span> ya existe';
                }
                else {
                    include ("subida.php");
                    include ("funciones.php");
                    $consulta = mysqli_query($conexion, "SELECT IDJ FROM JUGADORES ORDER BY IDJ");
                    $numeros = array();
                    while ($fila = mysqli_fetch_row($consulta)) {
                        $numeros[] = $fila[0];
                    }
                    if ($numeros[0] == NULL) {
                        $numero = 1;
                    }
                    else {
                        $numero = consecutivos($numeros);
                    }
                    if ($avatar == "" || ord($avatar) == 0) {
                        $avatar = "no_user.png";
                    }
                    else {
                        $n_avatar = substr($avatar, 0, -4);
                        $extension = substr($avatar, -4);
                        $avatar = eliminar_tildes($avatar);
                        
                    }
					
					$insert = "INSERT INTO JUGADORES VALUES($numero,'$jnombre','$pass','$sexo',DEFAULT,DEFAULT,'$avatar',DEFAULT,DEFAULT,1,$idioma)";

                    $consulta = mysqli_query($conexion, $insert);
			
		$consulta = "SELECT Avatar FROM JUGADORES WHERE Nombre='$jnombre'";
		
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_row();
		if($avatar!="no_user.png"){
		$avatar = buscar_avatar($fila[0], $extension,true);
		$consulta = "UPDATE JUGADORES SET Avatar='$avatar' WHERE Nombre='$jnombre'";
		}
		
		$resultado = $mysqli->query($consulta);
                  
                    session_start();
                    $_SESSION['jugador'] = $jnombre;
                   header("Location: ahorcado.php");
                }
            }
        }
    }
}
?>	



<div class="ajustar">
    <div id="stylized" class="myform" style="zoom:150%;">
        <form enctype='multipart/form-data' class="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table style="text-align:center;" border="2">
                <tr>
                    <td colspan="2">
                        <? print $mensaje;?><br/><br/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;" src="img/user.png"/>
                    </td>
                    <td>
                        <input style="text-align:center;height:40px;font-size:30px;" type="text" name="jnombre"  maxlength="15" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;font-size:30px;" src="img/pass.png"/>
                    </td>
                    <td>
                        <input style="text-align:center;height:40px;font-size:30px;" type="password" name="pass" id="password" maxlength="15" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;" src="img/avatar.png"/>
                    </td>
                    <td>
                        <input style="height:40px;font-size:30px;" name="uploadedfile" type="file">
                    </td>
                </tr>
				<tr>
					<td>
						<br/>
					</td>
				</tr>
                <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;" src="img/hombre.png"/>
                    </td>
                    <td>
                        <input style="height:40px;width:40px;" type="radio" name="sexo" value="H"></input>
                    </td>
                </tr>
				
                <tr>
                    <td>
                        <img style="height:50px;width:40px;float:left;padding-left:15px;" src="img/mujer.png"/>
                    </td>
                    <td>
                        <input style="height:40px;width:40px;" type="radio" name="sexo" value="M"></input>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;" src="img/genero.png"/>
                    </td>
                    <td>
                        <input style="height:40px;width:40px;" type="radio" name="sexo" value="S" checked></input>
                    </td>
                </tr>
				<tr>
					<td>
						<br/>
					</td>
				</tr>
				  <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;" src="img/spanish.png"/>
                    </td>
                    <td>
                        <input style="height:40px;width:40px;" type="radio" name="idioma" value="1" checked></input>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;" src="img/english.png"/>
                    </td>
                    <td>
                        <input style="height:40px;width:40px;" type="radio" name="idioma" value="2"></input>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img style="height:70px;width:70px;float:left;" src="img/french.png"/>
                    </td>
                    <td>
                        <input style="height:40px;width:40px;" type="radio" name="idioma" value="3"></input>
                    </td>
                </tr>
				<tr>
					<td>
						<br/>
					</td>
				</tr>
                <tr>
                    <td colspan="2">
                        <button style="height:55px;width:200px;font-size:45px;margin-left:-25px;" name="enviar" type="submit">Go!</button>
                    </td>
                </tr>
				
            </table>
            <div class="spacer"></div>


        </form>
    </div>

	</div>
</section>
</body>
</html>	