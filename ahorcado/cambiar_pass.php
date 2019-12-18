<?
session_start();
include("settings.php");
print "<br/>";
if(isset($_POST['enviar'])){
	$color="red";
	$old=$_POST['passold']=trim($_POST['passold']);
	$new=$_POST['passnew']=trim($_POST['passnew']);
	if($new!="" && $old!=""){
		include("apertura-base.php");
		$jugador=$_SESSION['jugador'];
		$consulta = "SELECT IDJ FROM JUGADORES where Pass='$old' and Nombre='$jugador'";
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_row();
		if($fila[0]>0 && $new==$old){
			$mensaje="Las contrase&ntilde;as son id&eacute;nticas";
		}
		else{
			if($fila[0]!="" && $fila[0]!=NULL && $old!=$new){
				$color="#062B5D;";
				$consulta = "UPDATE JUGADORES SET Pass = '$new' WHERE IDJ =$fila[0]";
				$resultado = $mysqli->query($consulta);
				
				print '<img style="width:120px;height:120px;" src="img/check-in-guy.png"/>';
				$mensaje="Se ha cambiado la contrasae&ntilde;a";
			}
			else{
				if($fila[0]==""){
					$mensaje='<img style="width:40px;height:40px;" src="img/error.png"/>';
				}
			}
		}
	}
	else{$mensaje='<img style="width:40px;height:40px;" src="img/error.png"/>';}
	print "<h1 style=\"font-size:25px;font-family:Aero; color:$color;\">$mensaje</h1>";
	print '<br/><br/><hr/><br/><br/>';
}

?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

	<div>
	<div>
			<div style="font-weight:bold;font-size:25px;"><img style="width:80px;height:80px;" src="img/user.png"/></div>
			<div style="font-size:45px;font-family:Aero;color:#062B5D;">
	
				<?php print $_SESSION['jugador'];?>
		
			</div>
			<br/>
		</div>
		<div>
			<div><img style="width:80px;height:80px;" src="img/key.ico"/></div>
			<div style="padding-left:10px;">
				<input style="width:240px;height:40px;text-align:center;font-size:25px;" name="passold" type="password"/>
			</div>
			<br/>
		</div>
		
		<div>
			<div><img style="width:80px;height:80px;" src="img/pass.png"/></div>
			<div style="padding-left:10px;">
				<input  style="width:240px;height:40px;text-align:center;font-size:25px;" name="passnew" type="password"/>
			</div>
			<br/>
		</div>

		<div>
		<div><img style="width:100px;height:100px;" src="img/password.png"/></div>
		
			<div>
				<input style=" background:url(img/key.png) no-repeat center;width:80px;height:80px; " name="enviar" value="" type="submit" />
			</div>
		</div>
	</div>
	<br/><br/>
</form>
</body></html>