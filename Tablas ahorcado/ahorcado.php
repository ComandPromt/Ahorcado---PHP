<?php
session_start();
if (!isset($_SESSION['jugador']) || $_SESSION['jugador'] == "") {
    header('Location: index.php');
} 

    include 'funciones.php';
    $imagen = saber_avatar($_SESSION['jugador']);
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <link rel="stylesheet" href="css/juego.css">
            <link rel="stylesheet" href="css/fuente.css">
	
            <link rel="icon" type="image/png" href="img/letters.png">
            <style type="text/css">
			
			 @media (max-width: 480px) and (orientation:portrait){
 *{zoom:88%;}
			.movil{zoom:130%;padding-left:-80px;}
			
                    .juego {text-align:center;width:100%;}
                    .jugada{font-size:2em;background:#dec;text-align:center;font-size:40px;}
                    .palabra{text-align:center;font-size:50px;height:70px;border:2;}
                    #container { 

                        -webkit-transform: rotate(0deg);
                        -moz-transform: rotate(0deg);
                        -o-transform: rotate(0deg);
                        -ms-transform: rotate(0deg);
                        transform: rotate(0deg);
                    }
				
                }
	 @media (min-width: 480px) and (orientation:landscape){
			*{zoom:85%;}
			.movil{zoom:130%;padding-left:140px;pagging:-5px;}
			.juego {text-align:center;width:100%;}
                    .jugada{font-size:2em;background:#dec;text-align:center;font-size:40px;}
                    .palabra{text-align:center;font-size:50px;height:70px;border:2;}
			
			
			
                }			
				@media (min-width: 768px) and (orientation:landscape){
				
                    .juego {text-align:center;width:100%;}
                    .jugada{font-size:2em;padding:9px;margin:7px;background:#dec;text-align:center;font-size:40px;}
                    .palabra{text-align:center;font-size:50px;height:70px;border:2;}
                   
                }
			
			@media (min-width: 1124px)  { 
			
			*{zoom:98%;}
			.movil{padding-left:100px;}
			}
              @media (min-width: 800px) and (max-width: 800px) { 
			
			*{zoom:94%;}
			} 

              
            </style>
        </head>
        <script>
            $(document).ready(function(){
            var width = document.getElementById('hijo').offsetWidth;
            var height = document.getElementById('hijo').offsetHeight;
            var windowWidth = $(document).outerWidth();
            var windowHeight = $(document).outerHeight();
            var r = 1;
            r = Math.min(windowWidth / width, windowHeight / height)
                    $('#hijo').css({
            '-webkit-transform': 'scale(' + r + ')',
                    '-moz-transform': 'scale(' + r + ')',
                    '-ms-transform': 'scale(' + r + ')',
                    '-o-transform': 'scale(' + r + ')',
                    'transform': 'scale(' + r + ')'
            });
            });
            #padre{
            overflow - x: visible;
            white - space: nowrap;
            }
            #hijo{
            left: 0;
            position: fixed;
            overflow: visible;
            - moz - transform - origin: top left;
            - ms - transform - origin: top left;
            - o - transform - origin: top left;
            - webkit - transform - origin: top left;
            transform - origin: top left;
            - moz - transition: all .2s ease - in - out;
            - o - transition: all .2s ease - in - out;
            - webkit - transition: all .2s ease - in - out;
            transition: all .2s ease - in - out;
            }
        </script>
        <title>Ahorcado</title>
    </head>
    <body style="overflow-y:hidden;overflow-x:hidden" id="padre" onLoad="timer()"  class="zoom" >
        <div id="container">
      
    <?php
    $_SESSION['userbd'] = "root";
    $_SESSION['passbd'] = "rootroot";
    $_SESSION['BD'] = "palabras";

    $_SESSION['letras_jugadas'][] = $_POST["letra"];
    switch (array_pop($_SESSION['letras_jugadas'])){
        case A:
            $_SESSION['desactivarA'] = "disabled";
            break;

        case B:
            $_SESSION['desactivarB'] = "disabled";
            break;

        case C:
            $_SESSION['desactivarC'] = "disabled";
            break;

        case D:
            $_SESSION['desactivarD'] = "disabled";
            break;

        case E:
            $_SESSION['desactivarE'] = "disabled";
            break;

        case F:
            $_SESSION['desactivarF'] = "disabled";
            break;

        case G:
            $_SESSION['desactivarG'] = "disabled";
            break;

        case H:
            $_SESSION['desactivarH'] = "disabled";
            break;

        case I:
            $_SESSION['desactivarI'] = "disabled";
            break;

        case J:
            $_SESSION['desactivarJ'] = "disabled";
            break;

        case K:
            $_SESSION['desactivarK'] = "disabled";
            break;

        case L:
            $_SESSION['desactivarL'] = "disabled";
            break;

        case M:
            $_SESSION['desactivarM'] = "disabled";
            break;

        case N:
            $_SESSION['desactivarN'] = "disabled";
            break;

        case Ñ:
            $_SESSION['desactivarNG'] = "disabled";
            break;

        case O:
            $_SESSION['desactivarO'] = "disabled";
            break;

        case P:
            $_SESSION['desactivarP'] = "disabled";
            break;

        case Q:
            $_SESSION['desactivarQ'] = "disabled";
            break;

        case R:
            $_SESSION['desactivarR'] = "disabled";
            break;

        case S:
            $_SESSION['desactivarS'] = "disabled";
            break;

        case T:
            $_SESSION['desactivarT'] = "disabled";
            break;

        case U:
            $_SESSION['desactivarU'] = "disabled";
            break;

        case V:
            $_SESSION['desactivarV'] = "disabled";
            break;

        case W:
            $_SESSION['desactivarW'] = "disabled";
            break;

        case X:
            $_SESSION['desactivarX'] = "disabled";
            break;

        case Y:
            $_SESSION['desactivarY'] = "disabled";
            break;

        case Z:
            $_SESSION['desactivarZ'] = "disabled";
            break;
			
		case ".":
         $_SESSION['desactivarDU'] = "disabled";
            break;	
    }
    if ($_POST["letra"] != "" && $_POST['palabra'] != "") {
        jugar($_POST["letra"]);
    } else {
        if ($_POST['palabra'] != "") {
            $_SESSION['chkpalabra'] = true;
            jugar($_POST['palabra']);
        }
        if ($_POST["letra"] != "") {
            $_SESSION['chkpalabra'] = false;
            jugar($_POST["letra"]);
        }
        if ($_SESSION['juego'] != "ok") {
			if($_SESSION['jugador']=="An&oacute;nimo"){
            empezar("");
			}
			else{
			$idioma=saberIdioma($_SESSION['jugador']);
			empezar();	
			}

            $_SESSION['juego'] = "ok";
        }
    }
	include("usuario.php");
    print '<table id="tabla1" class="juego">
			<tr>
				<td>
					<img style="height:80px;width;80px;" src="img/fail.png">
				</td>
				<td>
					<img style="height:80px;width;80px;" src="img/heart.png">
				</td>
				<td>
					<img style="height:80px;width;80px;" src="img/time.gif">
				</td>
			</tr>
			<tr>
				<td style="color:#ff0000;font-size:150px;font-weight:normal;font-family:B de bonita;">
					' . $_SESSION['fallos'] . '
				</td>';
    if ($_SESSION['vidas'] < 4) {
        print '<td style="color:#ff0000;font-size:80px;font-weight:bold;">' . $_SESSION['vidas'] . '</td>';
    } else {
        print '<td style="color:#456789;font-size:80px;font-weight:bold;">' . $_SESSION['vidas'] . '</td>';
    }
    print '<td id="contador" style="text-align:center;font-weight:bold;font-size:80px;">';
    ?>	
            <script language="javascript">
                function timer(){
                var t = setTimeout("timer()", 1000);
                document.getElementById('contador').innerHTML = i--;
                document.getElementById('contador').style.color = "#3878A3";
                var pierde_por_tiempo = false;
                if (i > 2){
                document.getElementById('contador').style.color = "#3878A3";
                }
                else{
                document.getElementById('contador').style.color = "#ff0000";
                }
                if (i == - 1){
                location.href = "pierde_por_tiempo.php";
                clearTimeout(t);
                }
                }
                i = 25;
            </script>
        </td>
    </tr>
    </table>
    <br/>
    <table align="center" style="text-align:center;align:center">
        <tr>
        <div id="letras" class="jugada">
    <?php
    $palabra = $_SESSION['cifrado'];
    if ($_SESSION['jugador'] != "An&oacute;nimo") {
        include("apertura-base.php");
        $consulta = mysqli_query($conexion, "SELECT Tilde FROM PALABRAS WHERE IDP=" . $_SESSION['aleatorio']);
        $tilde = mysqli_fetch_row($consulta);
        $tilde = $tilde[0];
        if ($tilde > 0) {
            $tilde -= 1;
            if ($palabra[$tilde] != "_") {
                switch ($palabra[$tilde]) {
                    case "a":
                        $palabra[$tilde] = "&aacute;";
                        break;

                    case "e":
                        $palabra[$tilde] = "&eacute;";
                        break;

                    case "i":
                        $palabra[$tilde] = "&iacute;";
                        break;

                    case "o":
                        $palabra[$tilde] = "&oacute;";
                        break;

                    case "u":
                        $palabra[$tilde] = "&uacute;";
                        break;

                    case "A":
                        $palabra[$tilde] = "&Aacute;";
                        break;

                    case "E":
                        $palabra[$tilde] = "&Eacute;";
                        break;

                    case "I":
                        $palabra[$tilde] = "&Iacute;";
                        break;

                    case "O":
                        $palabra[$tilde] = "&Oacute;";
                        break;

                    case "U":
                        $palabra[$tilde] = "&Uacute;";
                        break;
                }
            }
        }
        if ($palabra[0] == "-") {
            $palabra[0] = "Ñ";
        }
    }

    foreach ($palabra as $letra) {
		switch($letra){
			case "-":
			$letra = "ñ";
			break;
			
			case ".":
			 $letra = "ü";
			break;
		}
        
        echo '<b style="font-size:50px;"id="hijo" class="letras">' .$letra . '</b>';
    }
    print '</div>
		</tr>
		</table>
		<form method="post" id="padre">
	
			<table class="movil" align="center" style="text-align:center;">
				<tr>
					<td>
						<input border="2" id="hijo"  style="margin-top:10px;text-align:center;width:70%;height:80px;font-size:30px;border:1px solid blue;" type="search" name="palabra" placeholder="Palabra ¿? (1 intento)" size="25">
					</td>
					<td>
						<input align="center"  id="go" class="palabra" type="submit" value="GO!"></input>
					</td>
				</tr>
			</table>
			<audio src="sounds/tic-tac.mp3" autoplay loop></audio>
	
		</form>
	
		<div>
		';
		
		print '
		</div>
		<form method="post" id="padre">

			<table class="movil" align="center" style="margin-top:-40px;width:100%;">
				<tr>
					<td>
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarA'] . ' class="letra" type="submit" name="letra" VALUE="A"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarB'] . ' class="letra" type="submit" name="letra" VALUE="B"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarC'] . ' class="letra" type="submit" name="letra" VALUE="C"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarD'] . ' class="letra" type="submit" name="letra" VALUE="D"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarE'] . ' class="letra" type="submit" name="letra" VALUE="E"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarF'] . ' class="letra" type="submit" name="letra" VALUE="F"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarG'] . ' class="letra" type="submit" name="letra" VALUE="G"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarH'] . ' class="letra" type="submit" name="letra" VALUE="H"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarI'] . ' class="letra" type="submit" name="letra" VALUE="I"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarJ'] . ' class="letra" type="submit" name="letra" VALUE="J"/>
					</td>                                   
				</tr>                                       
				<tr>                                        
				<td>                                        
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarK'] . ' class="letra" type="submit" name="letra" VALUE="K"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarL'] . ' class="letra" type="submit" name="letra" VALUE="L"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarM'] . ' class="letra" type="submit" name="letra" VALUE="M"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarN'] . ' class="letra" type="submit" name="letra" VALUE="N"/>
					</td>                                   
				<td>                                        
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarNG'] . ' class="letra" type="submit" name="letra" VALUE="Ñ"/>
					</td>                                   
					                                        
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarO'] . ' class="letra" type="submit" name="letra" VALUE="O"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarP'] . ' class="letra" type="submit" name="letra" VALUE="P"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarQ'] . ' class="letra" type="submit" name="letra" VALUE="Q"/>
					</td>                                   
					<td>                                   
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarR'] . ' class="letra" type="submit" name="letra" VALUE="R"/>
					</td>                                  
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarS'] . ' class="letra" type="submit" name="letra" VALUE="S"/>
					</td>                                   
				</tr>                                       
				<tr>                                        
				<td>                                        
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarT'] . ' class="letra" type="submit" name="letra" VALUE="T"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarU'] . ' class="letra" type="submit" name="letra" VALUE="U"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarV'] . ' class="letra" type="submit" name="letra" VALUE="V"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarW'] . ' class="letra" type="submit" name="letra" VALUE="W"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarX'] . ' class="letra" type="submit" name="letra" VALUE="X"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarY'] . ' class="letra" type="submit" name="letra" VALUE="Y"/>
					</td>                                   
					<td>                                    
						<input style="width: 70px;  height: 60px;" border="2" ' . $_SESSION['desactivarZ'] . ' class="letra" type="submit" name="letra" VALUE="Z"/>
					</td>
					<td>
						<button '.$_SESSION['desactivarDU'].' style="width: 70px;  height: 60px;" border="2"  class="letra" type="submit" name="letra" VALUE=".">ü</button>
					</td>
			';
		?>
		</tr>
				<tr align="center">
					<br/><br/><br/>
				</tr>
			</table>
		</form>	
		<div class="modal-wrapper" id="popup">
			<div class="popup-contenedor">
				<a class="popup-cerrar" href="#">X</a>
				<a href="perder.php"><img src="img/check.ico"/></a>
				<a style="margin-left:75%;"href="#"><img src="img/error.ico"/></a>
			</div>
		</div>
		</div>
	
	</body>
</html>