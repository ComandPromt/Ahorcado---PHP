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
<body id="zoom" style="-moz-transform: scale(1,1.03);">
      <section class="contenido">
<?php

?>
<div>
    <br/>
    <nav>
        <ul style="font-size:20px;" class="primary">
            <?php
            session_start();
            if (isset($_SESSION['jugador']) && $_SESSION['jugador'] != "") {
                print '
	 <li>
        <a href="cambiar_user.php">
          <img style="height:60px;width:60px;" src="img/edit_user.png"/>
        </a>
       </li>
    <li>
        <a href="cambiar_pass.php">
          <img style="height:60px;width:60px;" src="img/user_pass.png"/>
        </a>
         </li>
	   <li>
        <a href="cambiar_avatar.php">
          <img style="height:60px;width:60px;" src="img/change_avatar.png"/>
        </a>
        </li>
	   <li>
        <a href="cambiar_sexo.php">
          <img style="height:60px;width:60px;" src="img/sexo.png"/>
        </a>
          </li>
		  <li>
        <a href="cambiar_idioma.php">
          <img style="height:60px;width:60px;" src="img/idiomas.png"/>
        </a>
          </li>
		  <li>
        <a href="index.php">
          <img style="height:60px;width:60px;" src="img/home.png"/>
        </a>
          </li>
		  <li></li>
     ';
            }
            ?>
        </ul>
    </nav>
</div>