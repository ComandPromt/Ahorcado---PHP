<?
session_start();
include("settings.php");
include("funciones.php");
print "<br/>";
if(isset($_POST['enviar'])){
	$sexo=trim($_POST['sexo']);
	
	if($sexo!=""){

		include("apertura-base.php");
		$jugador=$_SESSION['jugador'];
		$consulta = "SELECT IDJ FROM JUGADORES where Nombre='$jugador'";
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_row();
			if($fila[0]>0 && $fila[0]!=null){
				$consulta = "UPDATE JUGADORES SET Sexo = '$sexo' WHERE IDJ =$fila[0]";
				$resultado = $mysqli->query($consulta);
				$mensaje= '<img style="width:140px;height:140px;" src="img/check-in-guy.png"/>';
			}
			else{
				if($fila[0]==""){
					$mensaje= '<img style="width:40px;height:40px;" src="img/error.png"/>';
				}
			}
	}
	else{$mensaje= '<img style="width:40px;height:40px;" src="img/error.png"/>';}
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
						$idioma=verIDJ("Sexo");
						
						switch($idioma){
							case "H":
							$bandera="hombre.png";
							break;
							
							case "M":
							$bandera="mujer.png";
							break;
							
							case "S":
							$bandera="genero.png";
							break;
							
							
						}
						print "<br/><img style=\"width:100px;height:100px;\" src=\"img/$bandera\"/><hr/>";
					?>
			
				</div>
				<br/>
			</div>
			<div>
				<div><br/>
				<input name="sexo" value="H" type="radio"><img style="width:100px;height:100px;" src="img/hombre.png"/></input><br/>
				<input name="sexo" value="M" type="radio"><img style="width:50px;height:90px;" src="img/mujer.png"/></input><br/>
				<input name="sexo" value="S" type="radio"><img style="width:100px;height:100px;" src="img/genero.png"/></input><br/>
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