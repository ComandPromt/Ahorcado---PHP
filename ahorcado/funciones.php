<?php

function letras_no_ascii($numero,$palabra,$reemplazo){
	if(ord($palabra[0])==$numero){
		$palabra=substr($palabra,2,strlen($palabra));
		$palabra=$reemplazo.$palabra;
		
	}
	return $palabra;
}

function sacar_palabras($palabra,$tilde){
	if($tilde>0){
	$principio=substr($palabra,0,$tilde-1);
	$final=substr($palabra,$tilde,strlen($palabra));
switch($palabra[$tilde-1]){
	case "a":
	$tilde="á";
	break;
	
	case "e":
	$tilde="é";
	break;
	
	case "i":
	$tilde="í";
	break;
	
	case "o":
	$tilde="ó";
	break;
	
	case "u":
	$tilde="ú";
	break;
	
	case "A":
	$tilde="Á";
	break;
	
	case "E":
	$tilde="É";
	break;
	
	case "I":
	$tilde="Í";
	break;
	
	case "O":
	$tilde="Ó";
	break;
	
	case "U":
	$tilde="Ú";
	break;
}
$palabra=$principio.$tilde.$final;
}	
$palabra=str_replace("-","ñ",$palabra);
$palabra=str_replace(".","ü",$palabra);
return $palabra; 
}

function png_a_jpg($archivo){ 
    if ( is_file($archivo) ) 
    { 
        $imagen = imagecreatefrompng($archivo); 
        $archivo=str_replace(".png", ".jpg", $archivo); 
        imagejpeg($imagen,$archivo,100); 
    } 
         
} 

function buscar_avatar($n_avatar,$extension,$ok){
date_default_timezone_set('Europe/Madrid');
$nombre=date("Y")."_".date("d")."_".date("m")."_".date("H")."-".date("i")."-".date("s");
$x=0;
$n_avatar=str_replace("/",".",$n_avatar);
if($ok){
$origen="uploads/".$n_avatar;	
}
else{
	$origen="uploads/".$n_avatar.$extension;
}
			switch($extension){
				case ".png":
				case ".PNG":
	
                    if (!file_exists($nombre . "_" . $x . ".jpg") && $n_avatar!="no_user") {
                    
						$destino="uploads/".$nombre . "_" . $x.".png";
						rename($origen, $destino);
						png_a_jpg($destino);	
						unlink($destino);   
                    }
			
				break;
				case ".GIF":
				case ".gif":
        $destino = "uploads/".$nombre . "_" . $x.".jpg";
        imagejpeg(imagecreatefromstring(file_get_contents($origen)), $destino);
				rename($origen, $destino);
				break;
				case "JPEG":
				case ".jpg":
				$destino="uploads/".$nombre . "_" . $x.".jpg";
				rename($origen, $destino);
				break;
			}
			
 return $destino=$nombre . "_" . $x.".jpg";
	
}

function eliminar_tildes($cadena){
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );
    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'e', 'e', 'e', 'e'),
        $cadena 
	);
    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'i', 'i', 'i', 'i'),
        $cadena
	);
    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'o', 'o', 'o', 'o'),
        $cadena
	);
    $cadena = str_replace(
        array('ú', 'ù', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'u', 'u', 'u'),
        $cadena
	);
	$cadena = str_replace('Ñ','ñ',$cadena);
	
	$cadena = str_replace('.','/',$cadena);
	
	$cadena = str_replace('-','/',$cadena);
	
	return $cadena;
}

function pasar_la_primera_letra_a_mayuscula($letra){
	$buscar=strpos($letra, "ñ");
	if($buscar){
		$letra=str_replace ( "ñ" , "-" , $letra);
	}
	$buscar=strpos($letra, "ü");
	if($buscar){
		$letra=str_replace ( "ü" , "." , $letra);
	}
	$letra=trim($letra);
	$letra[0]=strtoupper($letra[0]);
	for($i=1;$i<=strlen($letra)-1;$i++){
		if(ctype_upper($letra[$i])){
			$letra[$i]=strtolower($letra[$i]);	
		}
	}
	return $letra;
}

function vidas($vidas){
	switch ($vidas){
		case 1:
		case 2:
		case 3:
		case 4:
		$vidas=2;
		break;

		case 5:
		case 6:
		$vidas=3;
		break;
		
		case 7:
		case 8:
		$vidas=4;
		break;
		
		default:
		$vidas=5;
		break;
	}
	return $vidas;
}

function empezar(){

	$palabra=elegirtitulo();
	$_SESSION['palabra']=$palabra[0];
	$longitud=strlen($_SESSION['palabra']);
	
	$_SESSION['vidas_por_defecto']=$_SESSION['vidas'];
	for($i=0;$i<$longitud;$i++){
		if($palabra[0][$i]===' '){
			$cifrado[$i]='&nbsp;&nbsp;';
		}	
		else{
			$cifrado[$i]=' _ ';
		}
	}
	$_SESSION['numerofallos']=0;
	$_SESSION['cifrado']=$cifrado;
	$_SESSION['fallos']=' ';
	$_SESSION['yajugada']=' ';
	$_SESSION['aciertos']=0;
	$_SESSION['posiciones']=array_count_values($_SESSION['cifrado']);
	return $palabra;
}

function elegirtitulo(){
	$salida=array();
	$_SESSION['letras_jugadas']=array();
	include ("apertura-base.php");
	$idl=verIDJ("Idioma");
	if($idl==1 || $idl==2 ){
		$escoger=mt_rand(0,1);
		switch($escoger){
			case 0:
			$tabla="ANGLICISMOS";
			$indice="IDA";
			$_SESSION['idioma']=0;
			break;
			
			case 1:
				switch($idl){
					case 1:
						$tabla="SPANISH";
						$indice="IDS";
						$_SESSION['idioma']=1;
					break;
					case 2:
						$tabla="INGLES";
						$indice="IDI";
						$_SESSION['idioma']=2;
					break;
				}
			break;
		}	
	}
	else{
			$tabla="FRANCES";
			$indice="IDF";
			$_SESSION['idioma']=3;
	}
	
	$consulta=mysqli_query($conexion, "SELECT MAX($indice) from $tabla");
	$maximo =mysqli_fetch_row($consulta);
	$maximo=$maximo[0];
	$aleatorio=mt_rand(1,$maximo);
	$consulta=mysqli_query($conexion, "SELECT Palabra from $tabla WHERE $indice='$aleatorio'");
	$palabra = mysqli_fetch_row($consulta);
	$palabra=pasar_la_primera_letra_a_mayuscula($palabra[0]);

	if (strpos($palabra,"Ñ")>=0){
		$palabra=str_replace ("Ñ" , "-" , $palabra);
	}
	if (strpos($palabra,"ñ")>=0){
		$palabra=str_replace ("ñ" , "-" , $palabra);
	}
	if (strpos($palabra,"ü")>=0){
		$palabra=str_replace ("ü" , "." , $palabra);
	}
	
	$salida[]=$palabra;
	$salida[]=$aleatorio;
	
	/*
	//Manual
	$_SESSION['idioma']=1;
	$salida[]="La casa";
	$salida[]=79699;*/
	
    return $salida;
}

function yajugada($letra){
	$estado=false;
	if(strpos($_SESSION['yajugada'],$letra)){
		$estado=true;
	}
	else{
		$_SESSION['yajugada'].=$letra;
	}
	return $estado;
}

function jugar($letra){
	if($_SESSION['chkpalabra']==true){
		$letra=eliminar_tildes($letra);	
		$letra=pasar_la_primera_letra_a_mayuscula($letra); 	
		//Aqui vemos si la palabra introducida tiene ñ
		if(strpos($_SESSION['palabra'], "-")>=0 ){
			$letra=str_replace ( "ñ" , "-" , $letra);
			$letra=str_replace ( "Ñ" , "-" , $letra);
		}
		
		if(strcmp ($letra,$_SESSION['palabra'])==0){
			sacarResultado(4,$_SESSION['palabra'][1]);
		}
		else{
			sacarResultado(3,"");
		}
	}	
	else{
		if($letra=="Ñ"){
			$letra=str_replace ( "Ñ" , "-" , $letra);
		}

		if(ctype_upper ($letra)){
			$letra=strtolower ($letra);
		}
		$valor;$estado=false;$valida=true;
		if(ctype_alpha($letra)==false && $letra !="-" && $letra !="."){
			$valida=false;
		}
		else if(yajugada($letra)){
			$valor=0;
		}
		else{
			for($i=0;$i <count($_SESSION['cifrado']);$i++){
				if($_SESSION['palabra'][$i]==$letra || $_SESSION['palabra'][$i]==strtoupper($letra)){
					$_SESSION['cifrado'][$i]=$_SESSION['palabra'][$i];
					$_SESSION['aciertos']+=1;
					$estado=true;
				}
				else{
					$valor=2;
				}
			}
			if($estado==false){
				$_SESSION['numerofallos']+=1;
				$_SESSION['vidas']-=1;
				$_SESSION['fallos'].=$letra." ";
				
			}
			if($estado==true){
				$valor=1;
				$_SESSION['acertadas'].=$letra." ";
			}
			if($_SESSION['vidas']<=0){
				$valor=3;
			}
			if($_SESSION['aciertos']==$_SESSION['posiciones'][' _ ']){
				$valor=4;
			}
		}	
		if($valida){
			sacarResultado($valor,$letra);
		}
	}	
}

function sacarResultado($valor,$letra){
	switch($valor){
		case 2:
		$link = "sounds/fail.mp3";
		$audio = "<audio id='padre' src='$link' autoplay></audio>";
		if($letra=="-"){
			$_SESSION['fallos']=substr($_SESSION['fallos'], 0, -2);
			$_SESSION['fallos'] .="ñ ";
		}	
		if($letra=="."){
			$_SESSION['fallos']=substr($_SESSION['fallos'], 0, -2);
			$_SESSION['fallos'] .="ü ";
		}
		echo $audio;
		break;
		
		case 3:
		header ("Location: perder.php");
		break;

		case 4:
		header ("Location: win.php");
		break;
	}
}

function asignar_Puntos($aciertos,$fallos,$puntos,$adicional){
	if($aciertos==$fallos || $fallos>$aciertos){
		$puntuacion=0;
	}
	else{
		$puntuacion=$aciertos-$fallos;	
	}	
	return $puntos+$puntuacion+$adicional;	
}

function saberPuntos($jugador){
	include ("apertura-base.php");
	$consulta=mysqli_query($conexion, "SELECT Puntos FROM JUGADORES WHERE Nombre = '$jugador'");
	$puntos =mysqli_fetch_row($consulta);
	return $puntos[0];
}

function verIDJ($celda){
	include ("apertura-base.php");
	$consulta=mysqli_query($conexion, "SELECT $celda FROM JUGADORES WHERE NOMBRE = '".$_SESSION['jugador']."'");
	$IDJ=mysqli_fetch_row($consulta);
	return $IDJ[0];
}

function verAdmmin(){
	include ("apertura-base.php");
	$consulta=mysqli_query($conexion, "SELECT Nombre FROM JUGADORES WHERE IDJ = 1");
	$admin=mysqli_fetch_row($consulta);
	return $admin[0];
}

function verIDP($palabra){
	include ("apertura-base.php");
	$palabra=pasar_la_primera_letra_a_mayuscula($palabra);
	switch($_SESSION['idioma']){
		case 0:
			$tabla="ANGLICISMOS";
			$indice="IDA";
		break;
		
		case 1:
			$tabla="SPANISH";
			$indice="IDS";
		break;
		
		case 2:
			$tabla="INGLES";
			$indice="IDI";
		break;
		
		case 3:
			$tabla="FRANCES";
			$indice="IDF";
		break;
	}
	$consulta=mysqli_query($conexion, "SELECT $indice FROM $tabla WHERE Palabra =  '$palabra'");
	$IDP =mysqli_fetch_row($consulta);
	return $IDP[0];
}

function saberAciertos($comprobacion){
	$idioma=$_SESSION['idioma'];
	if($comprobacion){
		$celda="Aciertos";
	}
	else{
		$celda="Fallos";
	}
	include ("apertura-base.php");
	$idp=verIDP($_SESSION['palabra']);
	$consulta=mysqli_query($conexion, "SELECT $celda FROM PALABRAS WHERE IDP =$idp AND IDL=$idioma");
	$aciertos =mysqli_fetch_row($consulta);
	return $aciertos[0]+1;
}


function asignar_Puntos_Adicional($vidas_por_defecto,$vidas){
	if($vidas_por_defecto==1 && $vidas==1 || $vidas_por_defecto==2 && $vidas==2){
		$adicional=10;
	}
	else{
		$adicional=$vidas;
	}
	return $adicional;
}

function liberarVariables(){
	$_SESSION['vidas']=0;
	$_SESSION['aleatorio']="";
	$_SESSION['fallos']="";
	$_SESSION['numerofallos']=0;
	$_SESSION['acertadas']="";
	$_SESSION['aciertos']=0;
	$_SESSION['aleatorio']="";
	$_SESSION['letras_jugadas'][]="";
	$_SESSION['desactivarA']="";
	$_SESSION['desactivarB']="";
	$_SESSION['desactivarC']="";
	$_SESSION['desactivarD']="";
	$_SESSION['desactivarE']="";
	$_SESSION['desactivarF']="";
	$_SESSION['desactivarG']="";
	$_SESSION['desactivarH']="";
	$_SESSION['desactivarI']="";
	$_SESSION['desactivarJ']="";
	$_SESSION['desactivarK']="";
	$_SESSION['desactivarL']="";
	$_SESSION['desactivarM']="";
	$_SESSION['desactivarN']="";
	$_SESSION['desactivarNG']="";
	$_SESSION['desactivarO']="";
	$_SESSION['desactivarP']="";
	$_SESSION['desactivarQ']="";
	$_SESSION['desactivarR']="";
	$_SESSION['desactivarS']="";
	$_SESSION['desactivarT']="";
	$_SESSION['desactivarU']="";
	$_SESSION['desactivarV']="";
	$_SESSION['desactivarW']="";
	$_SESSION['desactivarX']="";
	$_SESSION['desactivarY']="";
	$_SESSION['desactivarZ']="";
	$_SESSION['desactivarDU']="";
}

function verAvatarAntiguo($jugador){
	include ("apertura-base.php");
		$consulta="SELECT Avatar FROM JUGADORES WHERE Nombre = '$jugador'";
					$resultado=mysqli_query($conexion,$consulta);
					$avatar_viejo =mysqli_fetch_row($resultado);
					return $avatar_viejo[0];
}

function consecutivos($array){
	if($array[0]!=null && $array[0]==1){
		$numAnt = array();
		$x=0;
		foreach($array as $pos => $num){
			if($pos>0){
				if(!($numAnt[($pos-1)]+1)==$num){
					$noc=array();
					$noc1=$numAnt[($pos-1)];
					$noc[] = $noc1;
					if($noc[1]-$noc[0]!=1){
						$numero=$noc[0]+1;
					}
				}
			}
			$numAnt[$pos]=$num; 
			$x++;
		}
		if($numAnt[0]!=1 && $array[0] !=1){
			$numero=$numAnt[0]-1;
			
		}
		else{
			$validar=false;
			for($x=0;$x<count($numAnt);$x++){
				if($numero==null){
				
					if($numAnt[$x]+1==$numAnt[$x+1]){
						$validar=true;
					}
					else{
						$numero=$numAnt[$x]+1;
					}
				}
			}
			if($numero==null){
				if(!$validar ){
					$numero=$array[$x-1]-1;
				}
				else{
					$numero=array_pop($array)+1;
				}
			}
			
		}
	}
	else{
		$numero=1;
	}
	return $numero;
}

function saber_avatar($nombre){
		include ("apertura-base.php");
		$consulta = "SELECT Avatar FROM JUGADORES WHERE Nombre='$nombre'";
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_row();
		if($fila[0]!="" && $fila[0]!=NULL){
		$avatar="uploads/".$fila[0];
		}
		else{
			$avatar="img/no_user.png";	
		}
	return $avatar;
}

function usuarios_en_linea(){
include ("apertura-base.php");
$consulta=mysqli_query($conexion,"SELECT Nombre FROM JUGADORES WHERE onnline = 1 ORDER BY Nombre");
$fila = mysqli_affected_rows($conexion);
return $fila;
}

?>