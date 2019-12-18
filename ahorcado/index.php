<?php
include("cabecera.html");
include("funciones.php");
session_start();
liberarVariables();
?>
<div style="margin-top:-15px;zoom:120%;">
    <nav>
        <ul style="font-size:20px;" class="primary">
   <li>
               <a href="ayuda.php">
                    <img style="height:60px;width:60px;" src="img/about.ico"/>
                </a>
            </li>
			 <li>
              <a href="ver_ranking.php">
                    <img style="height:60px;width:60px;" src="img/ranking.png"/>
					
                </a>
            </li>

            <?php
            session_start();

            if (isset($_SESSION['jugador']) && $_SESSION['jugador'] != "") {
                print'
		<li>
			<a href="settings.php" target="_self">
          <img style="height:60px;width:60px;" src="img/settings.png"/>
			</a>
           </li>';
            }
            ?>
<li style="height:32px;">

            </li>
        </ul>
    </nav>
</div>
<div id="indice" style="margin-left:-80px;zoom:110%;">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <br/>
		<div style="margin:auto;">
        <table border="2" style="text-align:center;font-size:20px;">
            <?
			print '<tr  style="background-color:#E6F3FD;">
            <td colspan="2" style="padding-left:100px;text-align:center;"><a style="color:blue;font-size:35px;font-family:Aero;font-weight:bold;color:#2C0461;" href="online.php" target="_blank"><img style="height:80px;width:80px;"src="img/online.png"/></a>
			</td>
			<td colspan="2"><a style="color:blue;font-size:35px;font-family:Aero;font-weight:bold;color:#0B7974;" href="online.php" target="_blank">Online: '.usuarios_en_linea().'</a>
            </td>
            </tr>';
			
            if ($_SESSION['jugador']!="" || $_SESSION['jugador']!=null){
            print '<tr id="actual">
            <td><img style="padding-left:100px;height:60px;width:60px;" src="img/user.png"/>
            </td>
            <td style="font-size:30px;font-family:Aero;color:#062B5D;">'.
            $_SESSION['jugador'].' 
            </td>
            <td style="font-size:35px;font-family:Aero;font-weight:bold;color:#2C0461;">
			<a style="color:blue;font-size:35px;font-family:Aero;font-weight:bold;color:#2C0461;" href="ahorcado.php" target="_self">Play!<img style="height:80px;width:80px;" src="img/games.png"/></a></td>
           <td>
			<a style="color:blue;font-size:30px;font-family:Aero;font-weight:bold;color:#0C6475;padding-right:120px;" href="ver_ranking.php" target="_blank"><img style="height:60px;width:60px;" src="img/puntos.png"/>Points:&nbsp;'.saberPuntos($_SESSION['jugador']).'</a>
            ';
			
                    if (isset($_SESSION['jugador']) && $_SESSION['jugador'] != "" ) {
                        print '
                  
                <div style=float:left;padding-top:10px;padding-left:40px;">
				
            
				<p style="padding-bottom:15px;font-weight:bold;font-family:Bloody;color:red;font-size:40px;">Sign off</p>
                    <a href="salir.php">
                        <img style="height:100px; width:100px" src="img/exit.jpg"/>
                    </a>
                </div>
				';
					}
			print "	
			</td></tr></table>
            </div> </form>";
            }

            

	if ($_SESSION['jugador'] == "" || $_SESSION['jugador'] == null) {
				print '
           
	                <div style="text-align:center;padding-bottom:15px;padding-top:15px;">
				<a href="entrar.php" style="color:#081A8D;font-family:Aero;font-weight:bold;font-size:30px;" target="_self">Log in
                        <img height="100px" width="100px" src="img/usuario-registrado-1.png"/>
                    </a>
                  <div style="float:right;padding-right:10px;"><br/> <a href="registrar.php" style="color:#081A8D;font-family:Aero;font-weight:bold;font-size:30px;" target="_self">Register
                    <img height="100px" width="100px" src="img/registrar.png"/>
                </a></div>
 
                </div>';
			}
	?>
</section>
</div>
</body>
</html>