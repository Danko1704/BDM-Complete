use proyectodb;

DROP FUNCTION IF EXISTS f_NumResultados;

DELIMITER %&
CREATE FUNCTION f_NumResultados(Texto varchar(40), Seccion int, FechaIni timestamp, FechaFin timestamp) RETURNS int DETERMINISTIC
BEGIN
	DECLARE numRes int;
		IF (Texto IS NULL AND FechaIni IS NULL AND FechaFin IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE seccionIdF = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
        
	ELSEIF (Texto IS NULL AND FechaIni IS NULL AND Seccion IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE fechaCreacion < FechaFin
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
        
	ELSEIF (Texto IS NULL AND FechaIni IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE (fechaCreacion < FechaFin) AND (seccionIdf = Seccion)
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
        
	ELSEIF (Texto IS NULL AND FechaFin IS NULL AND Seccion IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE fechaCreacion > FechaIni
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
        
	ELSEIF (Texto IS NULL AND FechaFin IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE (fechaCreacion > FechaIni) AND (seccionIdf = Seccion)
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
        
	ELSEIF (Texto IS NULL AND Seccion IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE fechaCreacion BETWEEN FechaIni AND FechaFin
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
        
	ELSEIF (Texto IS NULL ) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
       
	#-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    ELSEIF (FechaIni IS NULL AND FechaFin IS NULL AND Seccion IS NULL ) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
    
    ELSEIF (FechaIni IS NULL AND FechaFin IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;

	ELSEIF (FechaIni IS NULL AND Seccion IS NULL ) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion < FechaFin
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
    
    ELSEIF (FechaIni IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion < FechaFin
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
    
    ELSEIF (FechaFin IS NULL AND Seccion IS NULL ) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion > FechaIni
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
    
    ELSEIF (FechaFin IS NULL) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion > FechaIni
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
	
    ELSEIF (Seccion IS NULL ) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;

    ELSEIF (FechaIni IS NOT NULL AND FechaFin IS NOT NULL AND Seccion IS NOT NULL ) THEN
		SELECT COUNT(noticiaId) FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado')
        INTO numRes;
       
	END IF;
	RETURN (numRes);
END
//
DELIMITER %&