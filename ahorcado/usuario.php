	    <div style="margin:auto;text-align:center;">
		<img style="margin-left:100px;height:60px;width:60px;" src="img/user.png" />&nbsp;&nbsp;
                   
    <?php print '<span style="text-align:center;
	font-weight:bold;
	color:#0C0CE8;
	font-size:60px;font-family:Aero;">'.$_SESSION['jugador'].'  </span>'; ?>
                    
                       <img style="width:140px;height:60px;margin:auto;" src="<?php print $imagen; ?>"/>
                   
                        
                    
                        <?php 

							print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img  style="height:60px;width:60px;margin:auto;" src="img/puntos.png" />';
                            print '<span style="text-align:center;
	font-weight:bold;
	color:#0C0CE8;
	font-size:60px;font-family:Aero;">'.saberPuntos($_SESSION['jugador']).'</span>';
                        
                        ?>
                                         
                        <a style="float:right;margin-top:-10px;" id href="#popup" class="popup-link"><img style="height:60px;width:120px;" src="img/exit.jpg"/></a>	
              
		
		</div>