<?php

function consecutivos($array) {
    if ($array[0] != null && $array[0] == 1) {
        $numAnt = array();
        $x = 0;
        foreach ($array as $pos => $num) {
            if ($pos > 0) {
                if (!($numAnt[($pos - 1)] + 1) == $num) {
                    $noc = array();
                    $noc1 = $numAnt[($pos - 1)];
                    $noc[] = $noc1;
                    if ($noc[1] - $noc[0] != 1) {
                        $numero = $noc[0] + 1;
                    }
                }
            }
            $numAnt[$pos] = $num;
            $x++;
        }
        if ($numAnt[0] != 1 && $array[0] != 1) {
            $numero = $numAnt[0] - 1;
        } else {
            $validar = false;
            for ($x = 0; $x < count($numAnt); $x++) {
                if ($numero == null) {

                    if ($numAnt[$x] + 1 == $numAnt[$x + 1]) {
                        $validar = true;
                    } else {
                        $numero = $numAnt[$x] + 1;
                    }
                }
            }
            if ($numero == null) {
                if (!$validar) {
                    $numero = $array[$x - 1] - 1;
                } else {
                    $numero = array_pop($array) + 1;
                }
            }
        }
    } else {
        $numero = 1;
    }
    return $numero;
}

function eliminar_ene($palabra) {
    $palabra = str_replace("ñ", "-", $palabra);
    $palabra = str_replace("Ñ", "-", $palabra);
	$palabra = str_replace("ü", ".", $palabra);
	$palabra = str_replace("'", "", $palabra);
    return $palabra;
}

function saber_tilde($palabra) {
    $tildes = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú");
    $blanco = array();
    for ($x = 0; $x < count($tildes); $x++) {
        $buscar = strpos($palabra, $tildes[$x]);
        if ($buscar != NULL && $buscar != "") {
            $tilde = $buscar;
            $tilde += 1;
        } 
		else {
            $blanco[] = $buscar;
        }
    }
    if (count($blanco) == 10) {
        for ($x = 0; $x < count($blanco); $x++) {
            if (is_integer($blanco[$x])) {
                $tilde = 1;
            }
        }
    }
    if ($tilde == "") {
        $tilde = 0;
    }
    return $tilde;
}

function eliminar_espacios($palabra) {
    $palabra = str_replace("á", "a", $palabra);
    $palabra = str_replace("é", "e", $palabra);
    $palabra = str_replace("í", "i", $palabra);
    $palabra = str_replace("ó", "o", $palabra);
    $palabra = str_replace("ú", "u", $palabra);
    $palabra = str_replace("Á", "A", $palabra);
    $palabra = str_replace("É", "E", $palabra);
    $palabra = str_replace("Í", "I", $palabra);
    $palabra = str_replace("Ó", "O", $palabra);
    $palabra = str_replace("Ú", "U", $palabra);
    return $palabra;
}

function pasar_la_primera_letra_a_mayuscula($letra) {
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

?>