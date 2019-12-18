<?php

function comprobar_tabla($con, $bd, $table) {
    $consulta = mysqli_query($con, "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$bd' AND TABLE_NAME = '$table'");

    while ($fila = mysqli_fetch_row($consulta)) {
        $comprobar_bd = $fila[0];
    }
    return $comprobar_bd;
}

if (isset($_POST['enviar'])) {
    error_reporting(0);
    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);
    $con = mysqli_connect("localhost", "$user", "$pass", "information_schema") or die(header('Location: #'));
    $bd = trim($_POST['bd']);
    $server = trim($_POST['server']);
    $valido = "";

    if (mysqli_connect_errno()) {
        $mensaje = "Fallo al conectar con la BD";
    } else {
        mysqli_select_db($con, "phpmyadmin");

        $consulta = mysqli_query($con, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$bd'");

        while ($fila = mysqli_fetch_row($consulta)) {
            $comprobar_bd = $fila[0];
        }

        if ($comprobar_bd == null) {
            mysqli_query($con, "CREATE DATABASE $bd");
        }

        $con = mysqli_connect("$server", "$user", "$pass", "$bd");
        $comprobar_bd = comprobar_tabla($con, $bd, "IDIOMAS");

        if ($comprobar_bd != null) {
            $valido = "A";
        } else {
            mysqli_query($con, "CREATE TABLE IDIOMAS (
  IDL INT(11) PRIMARY KEY AUTO_INCREMENT,
  Idioma varchar(15) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

            mysqli_query($con, "INSERT INTO IDIOMAS VALUES(0,'Anglicismo');");
            mysqli_query($con, "INSERT INTO IDIOMAS VALUES(1,'Spanish');");
            mysqli_query($con, "INSERT INTO IDIOMAS VALUES(2,'English');");
            mysqli_query($con, "INSERT INTO IDIOMAS VALUES(3,'French');");
        }

        $comprobar_bd = comprobar_tabla($con, $bd, "JUGADORES");

        if ($comprobar_bd != null) {
            $valido .= "B";
        } else {
            mysqli_query($con, "CREATE TABLE JUGADORES (
  IDJ INT(11) PRIMARY KEY AUTO_INCREMENT,
  Nombre varchar(25) NOT NULL UNIQUE,
  Pass varchar(20) NOT NULL,
  Sexo char(1) NOT NULL,
  Puntos INT(11) NOT NULL DEFAULT 0,
  Posicion INT(11) NOT NULL DEFAULT 0,
  Avatar varchar(27) DEFAULT NULL,
  Aciertos INT(11) NOT NULL DEFAULT 0,
  Fallos INT(11) NOT NULL DEFAULT 0,
  Online INT(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8;");

            mysqli_query($con, "ALTER TABLE JUGADORES
ADD CONSTRAINT CK1_JUGADORES CHECK (Online IN(0, 1));");
            mysqli_query($con, "ALTER TABLE JUGADORES
ADD CONSTRAINT CK2_JUGADORES CHECK (Sexo IN('H','M','S'));");
            mysqli_query($con, "ALTER TABLE JUGADORES ADD COLUMN Rango varchar(20) DEFAULT 'NOVATO';");
        }

        $comprobar_bd = comprobar_tabla($con, $bd, "PALABRAS");

        if ($comprobar_bd != null) {
            $valido .= "C";
        } else {
            mysqli_query($con, "CREATE TABLE PALABRAS (
  IDP INT(11) PRIMARY KEY AUTO_INCREMENT,
  IDL INT(11),
  Palabra varchar(25) NOT NULL UNIQUE,
  Tilde INT(1) DEFAULT 0,
  Num_letras INT(2) NOT NULL,
  Aciertos INT(11) NOT NULL DEFAULT 0,
  Fallos INT(11) NOT NULL DEFAULT 0,
  FOREIGN KEY (IDL) REFERENCES IDIOMAS(IDL)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;");

            $query = '';
            $sqlScript = file('palabras.sql');
            foreach ($sqlScript as $line) {

                $startWith = substr(trim($line), 0, 2);
                $endWith = substr(trim($line), -1, 1);

                if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                    continue;
                }

                $query = $query . $line;
                if ($endWith == ';') {
                    mysqli_query($con, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query . '</b></div>');
                    $query = '';
                }
            }
        }

        $comprobar_bd = comprobar_tabla($con, $bd, "ACIERTOS");

        if ($comprobar_bd != null) {
            $valido .= "D";
        } else {
            mysqli_query($con, "CREATE TABLE ACIERTOS (
				IDJ INT(11) NOT NULL DEFAULT 0,
				IDP INT(11) NOT NULL DEFAULT 0,
				Aciertos INT(11) NOT NULL DEFAULT 0,
				Fallos INT(11) NOT NULL DEFAULT 0,
				Vidas INT(11) NOT NULL DEFAULT 0,
				PRIMARY KEY (IDJ,IDP),
				FOREIGN KEY (IDJ) REFERENCES JUGADORES (IDJ),
				FOREIGN KEY (IDP) REFERENCES PALABRAS (IDP)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        }

        mysqli_close($con);

        if ($valido == "ABCD") {

            $mensaje = "Ya tienes instalado el juego.";
        } else {

            $mensaje = "Instalaci&oacute;n finalizada.";
        }
        $mensaje .= "<br/> Por favor, borra la carpeta Install";
    }
}
print '<body style="background-color:#CCCFC5;">';
print '<div style="margin:auto;text-align:center;">';
print '<img style="width:100%;height:220px;" src="../img/success.jpg"/><br/><br/>';
if ($mensaje != "" && $mensaje != null) {
	print '<img style="weight:80px;height:80px;" src="../img/delete.png"/>
	<h1 style="background-color:white">Install</h1>';
	print '<img  style="weight:80px;height:80px;"src="../img/edit.png"/>
	<h1 style="background-color:white">apertura-base.php</h1>';

}
?>
<br/>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <img style="weight:80px;height:80px;" src="../img/ip.png" /> <input style="height:50px;text-align:center;font-size:35px;" name="server" type="text" value="localhost"/><br/><br/>
    <img style="weight:80px;height:80px;" src="../img/database-mysql.png" /> <input style="height:50px;text-align:center;font-size:35px;" name="bd" type="text" /><br/><br/>
   <img style="weight:80px;height:80px;" src="../img/user.png" /> <input style="height:50px;text-align:center;font-size:35px;" name="user" type="text" placeholder="BD User"/><br/><br/>
   <img style="weight:80px;height:80px;" src="../img/pass.png" /> <input style="height:50px;text-align:center;font-size:35px;" name="pass" type="password" placeholder="BD Pass"/><br/><br/>
    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="height:50px;text-align:center;font-size:35px;" name="enviar" type="submit"/>
</form>
</div>
</body>