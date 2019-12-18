<?php 
$target_path = "uploads/";
$avatar=$_FILES['uploadedfile']['name'];
$nombre = substr($avatar, 0, -4);
$extension= substr($avatar, -4);
if($extension=="jpeg"){
	$extension=".jpg";
}
if(strlen($nombre)>15){
	$nombre=substr($avatar, 0, 15);
	$avatar=$nombre.$extension; 
}
$target_path = $target_path . basename($avatar);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)){ 
	include("redimensionar.php");
}
if(strlen($_POST['no_user'])==2){
	$avatar="no_user.png";
	$avatar_viejo=verAvatarAntiguo($jugador);
	mysqli_query($conexion,"UPDATE JUGADORES SET Avatar = '$avatar' WHERE Nombre = '$jugador'");
	if($avatar!=null && file_exists ('uploads/'.$avatar_viejo) && $avatar_viejo!="no_user.png"){
		unlink('uploads/'.$avatar_viejo);
	}
}

?>