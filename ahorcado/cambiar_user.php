<?
session_start();
include("settings.php");
print "<br/>";
if(isset($_POST['enviar'])){

	$nuevo_nombre=trim($_POST['nuevo_nombre']);
	
	if($nuevo_nombre!=""){

		include("apertura-base.php");
		$jugador=$_SESSION['jugador'];
		$consulta = "SELECT IDJ FROM JUGADORES where Nombre='$jugador'";
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_row();
			if($fila[0]>0 && $fila[0]!=null){
				$consulta = "SELECT Nombre FROM JUGADORES WHERE Nombre='$jugador'";
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_row();
		if($fila[0]=="" || $fila[0]==null){
				$consulta = "UPDATE JUGADORES SET Nombre = '$nuevo_nombre' WHERE IDJ =$fila[0]";
				$resultado = $mysqli->query($consulta);
				
				$mensaje='<img style="width:120px;height:120px;" src="img/check-in-guy.png"/>';
			$_SESSION['jugador']=$nuevo_nombre;
		}
		else{
			$mensaje="<h1 style=\"font-size:30px;color:red;font-weight:bold;\">The user ' $nuevo_nombre '  already exist!</h1>";
		}
			}
			else{
				if($fila[0]==""){
					$mensaje='<img style="width:40px;height:40px;" src="img/error.png"/>';
				}
			}
		
	}
	else{$mensaje='<img style="width:40px;height:40px;" src="img/error.png"/>';}
	
	print "$mensaje<br/><br/><hr/><br/><br/>";
}

?>
	
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<div>
		<div>
				<div style="font-weight:bold;font-size:25px;"><img style="width:80px;height:80px;" src="img/user.png"/></div>
				<div style="font-size:35px;font-family:Aero;color:#062B5D;">
		
					<?php print $_SESSION['jugador']?>
			
				</div>
				<br/>
			</div>
			<div>
				<div><br/><h1 style="font-weight:bold;font-size:30px;color:#3878A3;">NEW NAME</h1></div><br/>
				<div style="padding-left:10px;">
					<input style="width:240px;height:40px;text-align:center;font-size:25px;" name="nuevo_nombre" type="text"/>
				</div>
				<br/>
			</div>
		<div>
			<div>
				<input style="width:120px;height:80px;font-size:25px;" name="enviar" value="Change!" type="submit" />
			</div>
			</div>
		</div>
		<br/><br/>
	</form>
</body>
</html>