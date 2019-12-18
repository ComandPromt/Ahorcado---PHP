VIEW `ahorcado`.`palabra_mas_acertada` AS
    (SELECT 
        `ahorcado`.`PALABRAS`.`Palabra` AS `Palabra`,
        MAX(`ahorcado`.`ACIERTOS`.`Aciertos`) AS `maximo`
    FROM
        (`ahorcado`.`ACIERTOS`
        JOIN `ahorcado`.`PALABRAS` ON ((`ahorcado`.`PALABRAS`.`IDP` = `ahorcado`.`ACIERTOS`.`IDP`)))
    GROUP BY `ahorcado`.`PALABRAS`.`Palabra`
    ORDER BY MAX(`ahorcado`.`ACIERTOS`.`Aciertos`) DESC)
	
VIEW `ahorcado`.`palabra_mas_jugada` AS
    (SELECT 
        `ahorcado`.`PALABRAS`.`Palabra` AS `Palabra`,
        COUNT(`ahorcado`.`ACIERTOS`.`IDP`) AS `total`
    FROM
        (`ahorcado`.`ACIERTOS`
        JOIN `ahorcado`.`PALABRAS` ON ((`ahorcado`.`PALABRAS`.`IDP` = `ahorcado`.`ACIERTOS`.`IDP`)))
    GROUP BY `ahorcado`.`ACIERTOS`.`IDP`
    ORDER BY COUNT(`ahorcado`.`ACIERTOS`.`IDP`) DESC)