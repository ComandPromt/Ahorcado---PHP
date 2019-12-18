<?php
session_start();
include("../funciones.php");
$admin=verAdmmin();
if(!isset($_SESSION['jugador']) || $_SESSION['jugador']!=$admin) {
	header('Location: ../index.php');
}
else{
	include("cabecera.html");
print "	</body>
</html>";
}
?>