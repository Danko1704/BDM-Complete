SET SQL_SAFE_UPDATES = 0; 

DROP PROCEDURE IF EXISTS sp_validarUsuario;

DELIMITER %$
CREATE PROCEDURE sp_validarUsuario(
	pCorreo varchar(50),
    pContraseña varchar(30)
)
Begin
    select nombre, tipoUsuario FROM Usuario where correo=pCorreo and contraseña=pContraseña;
END %$
DELIMITER ; 

DROP PROCEDURE IF EXISTS sp_agregarUsuario;

DELIMITER %$
CREATE PROCEDURE sp_agregarUsuario(
	pNombre varchar(50),
    pCorreo varchar(30),
    pTelefono varchar(10),
    pContraseña varchar(30)
)
Begin
	INSERT INTO Usuario(nombre, correo, telefono, contraseña) 
    VALUES (pNombre, pCorreo, pTelefono, pContraseña);
END %$
DELIMITER ; 

DROP PROCEDURE IF EXISTS sp_agregarImagenUsuario;

DELIMITER %$
CREATE PROCEDURE sp_agregarImagenUsuario(
	IN pCorreo varchar (30),
    pImagen varchar(100)
)
Begin
	INSERT INTO Imagen 
    VALUES (0, pImagen);
    UPDATE Usuario SET imagenIdF = last_insert_id() WHERE correo = pCorreo;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_cambiarReportero;

DELIMITER %$
CREATE PROCEDURE sp_cambiarReportero(
	pNombre varchar(50)
)
Begin
    UPDATE Usuario
	SET tipoUsuario = 'Reportero'
	WHERE nombre = pNombre;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_cambiarUsuario;

DELIMITER %$
CREATE PROCEDURE sp_cambiarUsuario(
	pNombre varchar(50)
)
Begin
    UPDATE Usuario
	SET tipoUsuario = 'Usuario'
	WHERE nombre = pNombre;
END %$
DELIMITER ; 

DROP PROCEDURE IF EXISTS sp_selectUsuarios;

DELIMITER %$
CREATE PROCEDURE sp_selectUsuarios(
)
Begin
    SELECT Usuario.usuarioId, Usuario.nombre FROM Usuario ORDER BY Usuario.nombre ASC;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_infoUsuario;

DELIMITER %$
CREATE PROCEDURE sp_infoUsuario(
	pNombre varchar(50)
)
Begin
    SELECT Usuario.usuarioId, Usuario.nombre, Usuario.correo, Usuario.telefono, Usuario.contraseña, Imagen.imagenFile FROM Usuario INNER JOIN Imagen ON Usuario.imagenIdF = Imagen.imagenId WHERE Usuario.nombre = pNombre;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_updateUsuario;

DELIMITER %$
CREATE PROCEDURE sp_updateUsuario(
	oNombre varchar (50),
	pNombre varchar(50),
    pCorreo varchar(30),
    pTelefono varchar(10),
    pContraseña varchar(30),
    pImagen varchar(100)
)
Begin
	DECLARE idImagenSearch int;
	SET 
		idImagenSearch = (SELECT Usuario.imagenIdF FROM Usuario WHERE Usuario.nombre = oNombre);
	
    UPDATE Usuario, Imagen
    SET Usuario.nombre = pNombre,
    Usuario.correo = pCorreo,
    Usuario.telefono = pTelefono,
    Usuario.contraseña = pContraseña,
    Imagen.imagenFile = pImagen
    WHERE Usuario.nombre = oNombre AND Imagen.imagenId = idImagenSearch;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_agregarNoticia;

DELIMITER %$
CREATE PROCEDURE sp_agregarNoticia(
	pTitulo varchar (40),
	pSinopsis varchar(80),
    pTexto text,
    pPalabraClave1 varchar(25),
    pPalabraClave2 varchar(25),
    pPalabraClave3 varchar(25),
    pAutor varchar(50),
    pComentarioEditor varchar(1000),
	pCategoria varchar(50),
    pEspecial bool
)
Begin
DECLARE idSeccion int;
DECLARE idAutor int;
	SET 
		idSeccion = (SELECT Seccion.seccionId FROM Seccion WHERE Seccion.nombre = pCategoria),
        idAutor = (SELECT Usuario.usuarioId FROM Usuario WHERE Usuario.nombre = pAutor);
        
	INSERT INTO Noticia(titulo, sinopsis, texto, fechaCreacion, palabraClave1, palabraClave2, palabraClave3, autorIdF, comentarioEditor, seccionIdF, especial)
    VALUES (pTitulo, pSinopsis, pTexto, now(), pPalabraClave1, pPalabraClave2, pPalabraClave3, idAutor, pComentarioEditor, idSeccion, pEspecial);
    SELECT noticiaId FROM Noticia WHERE noticiaId = LAST_INSERT_ID();
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_agregarCategoria;

DELIMITER %$
CREATE PROCEDURE sp_agregarCategoria(
	pNombre varchar(25),
    pUsuario varchar(30),
    pColor varchar(7)
)
BEGIN
	DECLARE idAutor int;
	SET 
        idAutor = (SELECT Usuario.usuarioId FROM Usuario WHERE Usuario.nombre = pUsuario);

    INSERT INTO Seccion(Nombre, usuarioIdF, Color) VALUES (pNombre, idAutor, pColor);
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_llenarCategorias;

DELIMITER %$
CREATE PROCEDURE sp_llenarCategorias(

)
Begin
	SELECT Seccion.nombre FROM Seccion WHERE Seccion.isActive = true ORDER BY Seccion.nombre ASC;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_agregarImagenNoticia;

DELIMITER //
CREATE PROCEDURE sp_agregarImagenNoticia
(IN pImagen varchar(100))
BEGIN
INSERT INTO Imagen VALUES(0, pImagen);
SELECT imagenId FROM Imagen WHERE imagenId = LAST_INSERT_ID();
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_agregarVideoNoticia;

DELIMITER //
CREATE PROCEDURE sp_agregarVideoNoticia
(IN pVideo varchar(100))
BEGIN
INSERT INTO Video VALUES(0, pVideo);
SELECT videoId   FROM Video WHERE videoId  = LAST_INSERT_ID();
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_llenarMultimedia;

DELIMITER //
CREATE PROCEDURE sp_llenarMultimedia
(IN pIdMultimedia int, pNoticiaId int , mediaType int)
BEGIN
	if mediaType = 0 THEN
		INSERT INTO Multimedia VALUES(0, pIdMultimedia, null, pNoticiaId);
	ELSE
		INSERT INTO Multimedia VALUES(0, null, pIdMultimedia, pNoticiaId);
	END if;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_deleteCategorias;

DELIMITER %$
CREATE PROCEDURE sp_deleteCategorias(
	idCategoria int
)
BEGIN
	UPDATE Seccion SET isActive = 0 WHERE seccionId = idCategoria;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_cargaCategorias;

DELIMITER %$
CREATE PROCEDURE sp_cargaCategorias(
)
Begin
	SELECT Seccion.seccionId, Seccion.nombre, Seccion.color FROM seccion WHERE isActive = 1;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_Busqueda;

DELIMITER %$
CREATE PROCEDURE sp_Busqueda(
    IN Texto varchar(40),
    IN Seccion int,
    IN FechaIni timestamp,
    IN FechaFin timestamp
)
BEGIN
	

	#----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	IF (Texto IS NULL AND FechaIni IS NULL AND FechaFin IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE seccionIdF = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
        
	ELSEIF (Texto IS NULL AND FechaIni IS NULL AND Seccion IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE fechaCreacion < FechaFin
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
        
	ELSEIF (Texto IS NULL AND FechaIni IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (fechaCreacion < FechaFin) AND (seccionIdf = Seccion)
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
        
	ELSEIF (Texto IS NULL AND FechaFin IS NULL AND Seccion IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE fechaCreacion > FechaIni
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
        
	ELSEIF (Texto IS NULL AND FechaFin IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (fechaCreacion > FechaIni) AND (seccionIdf = Seccion)
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
        
	ELSEIF (Texto IS NULL AND Seccion IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE fechaCreacion BETWEEN FechaIni AND FechaFin
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
        
	ELSEIF (Texto IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
       
	#-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    ELSEIF (FechaIni IS NULL AND FechaFin IS NULL AND Seccion IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaIni IS NULL AND FechaFin IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');

	ELSEIF (FechaIni IS NULL AND Seccion IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND fechaCreacion < FechaFin
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaIni IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND fechaCreacion < FechaFin
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaFin IS NULL AND Seccion IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND fechaCreacion > FechaIni
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaFin IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND fechaCreacion > FechaIni
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
	
    ELSEIF (Seccion IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE (Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND (isActive = 1 AND estadoNoticia = 'Publicado');

    ELSEIF (FechaIni IS NOT NULL AND FechaFin IS NOT NULL AND Seccion IS NOT NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', titulo, '%') OR Texto LIKE CONCAT('%', palabraClave1, '%') OR Texto LIKE CONCAT('%', palabraClave2, '%') OR Texto LIKE CONCAT('%', palabraClave3, '%'))
        AND (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND seccionIdf = Seccion)
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
       
	END IF;

END %$
DELIMITER ;

select * from noticia;

INSERT INTO Usuario(nombre, correo, telefono, contraseña, tipoUsuario) VALUES ('danko', 'admin@hotmail.com', '9513375708', 'admin', 'Admin');

call sp_agregarUsuario('erick', 'lala@hotmail.com', '9512375708', 'dodo');
call sp_agregarImagenUsuario('lala@hotmail.com','monky_flip.mp4');
call sp_cambiarReportero ('orlando');
call sp_selectUsuarios();
call sp_llenarCategorias();
call sp_infoUsuario('danko');
call sp_imagenUsuarioMostrar('papotericudo');
call sp_updateUsuario ('papucho', 'perro', 'perro@hotmail.com', '9512278531', 'Peludin9$', 'perro.jpg');
call sp_agregarNoticia ('Una partida de Huevos', 'hubo muchos huevos', 'se sacaron los calzones', 'huevos', 'juegos', 'Lol', 'orlando', '', 'ps5', false);
call sp_agregarCategoria('el', 'danko', '#f0f0f0');
call sp_deleteCategorias('ella');

select * from Usuario;
select * from Imagen;
select * from video;
select * from Seccion;
select * from noticia;

SELECT Usuario.nombre, Usuario.correo, Usuario.telefono, Usuario.contraseña, Imagen.imagenFile FROM Usuario INNER JOIN Imagen ON Usuario.imagenIdF = Imagen.imagenId WHERE Usuario.nombre = 'erick';

INSERT INTO Noticia (titulo, sinopsis, texto, palabraClave1, palabraClave2, palabraClave3, autorIdF, isActive, estadoNoticia, seccionIdF)
					VALUES('Crossplay en Warzon', 'Jugadores de PC se quejan', 'Jugadores de PC se quejan por el autoaim de la consola', 'Warzone', 'Crossplay', 'Consola', '1', '1', 'Publicado', '10');
                    
INSERT INTO Noticia (titulo, sinopsis, texto, palabraClave1, palabraClave2, palabraClave3, autorIdF, isActive, estadoNoticia, seccionIdF, fechaCreacion)
					VALUES('Nueva temporada de Fornai', 'Nueva temporada esta semana', 'En esta semana se estrena la nueva temporada de Fortnite', 'Fortnite', 'Evento', 'Temporada', '1', '1', 'Publicado', '11', '2020-11-30 00:01:00');
                    
INSERT INTO Noticia (titulo, sinopsis, texto, palabraClave1, palabraClave2, palabraClave3, autorIdF, isActive, estadoNoticia, seccionIdF, fechaCreacion)
					VALUES('Chingo de frio en monterrey', 'Hace frio en monterrey', 'Si o no raza', 'Monterrey', 'Frio', 'Chingos', '1', '1', 'Publicado', '2', '2020-12-12 00:01:00');


CALL sp_Busqueda('Apex', NULL, NULL, NULL);

CALL sp_cargaCategorias();

CALL sp_validarUsuario('rodyap182@gmail.com', 'admin');

CALL sp_deleteCategorias('5');

SELECT nombre, tipoUsuario FROM Usuario where correo='orlando_gague17@hotmail.com' and contraseña='moquito';
select * from usuario;
select * from seccion WHERE isActive = 1;
select * from noticia WHERE isActive = 1 AND estadoNoticia = 'Publicado'
AND ('Apex' LIKE CONCAT('%', titulo, '%') OR 'Apex' LIKE CONCAT('%', palabraClave1, '%') OR 'Apex' LIKE CONCAT('%', palabraClave2, '%') OR 'Apex' LIKE CONCAT('%', palabraClave3, '%'));

TRUNCATE TABLE seccion;

INSERT INTO Usuario (nombre, correo, telefono, contraseña, imagenIdF, tipoUsuario) VALUES ('Rodrigo', 'rodyap182@gmail.com', '8116751678', 'admin', null, 'Admin');

INSERT INTO seccion SET Nombre = "Orange", isActive = 1, usuarioIdF = 1, Color = "#FF6633"
INSERT INTO seccion SET Nombre = "Pink", isActive = 1, usuarioIdF = 1, Color = "#FF80C0"
INSERT INTO seccion SET Nombre = "Cyan", isActive = 1, usuarioIdF = 1, Color = "#6FF6FF"

select * from Noticia;

UPDATE seccion SET isActive = 1 WHERE seccionId = 5
