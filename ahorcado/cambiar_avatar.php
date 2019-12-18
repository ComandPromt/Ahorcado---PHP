<?php
session_start();
include("settings.php");
if(isset($_POST['cambiar'])){
$jugador=$_SESSION['jugador'];
	include("apertura-base.php");
	include ("funciones.php");
	include ("subida.php");

	$avatar_viejo=verAvatarAntiguo($jugador);
	if($avatar_viejo!="no_user.png" || strlen($_POST['no_user'])!=2){
	$resultado=mysqli_query($conexion,"SELECT IDJ FROM JUGADORES ORDER BY IDJ");
					$numeros=array();
					while ($fila = mysqli_fetch_row($resultado)){
						$numeros[]=$fila[0];
					}
					if($numeros[0]==NULL){
						$numero=1;
					}
					else{
						$numero=consecutivos($numeros);
					}	
					
					if($avatar=="" || ord($avatar)==0){
						$mensaje="Debes subir una imagen";
					}
					else{
						$n_avatar=substr($avatar, 0, -4);
						$extension=substr($avatar, -4);
						$avatar=eliminar_tildes($avatar);
						$avatar=buscar_avatar($n_avatar,$extension,false);
						mysqli_query($conexion,"UPDATE JUGADORES SET Avatar = '$avatar' WHERE Nombre = '$jugador'");
						$resultado=mysqli_query($conexion, "SELECT Avatar FROM JUGADORES WHERE Nombre = '$jugador'");
						$avatar_nuevo =mysqli_fetch_row($resultado);
						$avatar_nuevo=$avatar_nuevo[0];
			
					if($avatar!=null && file_exists ('uploads/'.$avatar_viejo) && $avatar_nuevo!=$avatar_viejo && $avatar_viejo!="no_user.png"){
						unlink('uploads/'.$avatar_viejo);
					}
					
					}
}
unset($_POST['cambiar']);					
}		
print '<br/><div style="font-weight:bold;font-size:25px;"><img style="width:80px;height:80px;" src="img/user.png"/></div>
			<div style="font-size:35px;font-family:Aero;color:#062B5D;">';

				print $_SESSION['jugador'];
print '</div>';
?>
<br/>
<form enctype='multipart/form-data' class="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input style="-ms-transform: scale(2);
  -moz-transform: scale(2);
  -webkit-transform: scale(2);
  -o-transform: scale(2);" name="no_user" type="checkbox"><br/><br/><img style="width:60px;height:60px;" src="img/noavatar.png"></input><br/><br/>
<div>
<div>
<div style="font-weight:bold;font-size:25px;"></div>
<?php
$jugador=$_SESSION['jugador'];
include("apertura-base.php");
		$resultado = "SELECT Avatar FROM JUGADORES WHERE Nombre='$jugador'";
		$resultado = $mysqli->query($resultado);
		$fila = $resultado->fetch_row();
		if($fila[0]=="" || $fila[0]==null){$fila[0]="no_user.png";}
		if(file_exists ('uploads/'.$fila[0])){
		print '<img src=uploads/'.$fila[0].'>';
		}
		print '<br/><br/><br/><br/>

</div>
<div>

	<input style="height:120px;width:120px;" name="uploadedfile" type="file"><br/><br/><br/>
<input style="height:60px;font-size:30px;" name="cambiar" type="submit" value="Change!">
</div>
			</form>	
</body>
</html>';
?>