<?
session_start();
include("settings.php");
include("funciones.php");
print "<br/>";
if(isset($_POST['enviar'])){
	$idioma=trim($_POST['idioma']);
	
	if($idioma!=""){

		include("apertura-base.php");
		$jugador=$_SESSION['jugador'];
		$consulta = "SELECT IDJ FROM JUGADORES where Nombre='$jugador'";
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_row();
			if($fila[0]>0 && $fila[0]!=null){
				$consulta = "UPDATE JUGADORES SET Idioma = $idioma WHERE IDJ =$fila[0]";
				$resultado = $mysqli->query($consulta);
				$mensaje= '<img style="width:140px;height:140px;" src="img/check-in-guy.png"/>';
			}
			else{
				if($fila[0]==""){
					$mensaje= '<img style="width:80px;height:80px;" src="img/error.png"/>';
				}
			}
	}
	else{$mensaje='<img style="width:80px;height:80px;" src="img/error.png"/>';}
	print "$mensaje<br/><br/><hr/><br/><br/>";
}

?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<div>
		<div>
				<div style="font-weight:bold;font-size:35px;"><img style="width:80px;height:80px;" src="img/user.png"/></div>
				<div style="font-size:35px;font-family:Aero;color:#062B5D;">
		
					<?php print $_SESSION['jugador']?>
			
				</div>
				<div style="font-size:35px;font-family:Aero;color:#062B5D;">
		
					<?php
						$idioma=verIDJ(Idioma);
						
						switch($idioma){
							case 1:
							$bandera="spanish.png";
							break;
							
							case 2:
							$bandera="english.png";
							break;
							
							case 3:
							$bandera="french.png";
							break;
							
							
						}
						print "<br/><img style=\"width:80px;height:80px;\" src=\"img/$bandera\"/><hr/>";
					?>
			
				</div>
				<br/>
			</div>
			<div>
				<div><br/>
				<input name="idioma" value="1" type="radio"><img style="width:80px;height:80px;" src="img/spanish.png"/></input><br/>
				<input name="idioma" value="2" type="radio"><img style="width:50px;height:70px;" src="img/english.png"/></input><br/>
				<input name="idioma" value="3" type="radio"><img style="width:80px;height:80px;" src="img/french.png"/></input><br/>
				</div><br/>
			</div>
		<div>
			<div>
				<input style="width:100px;height:80px;font-size:20px;" name="enviar" value="Change!" type="submit" />
			</div>
			</div>
		</div>
		<br/><br/>
	</form>
</body>
</html>