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
    pUsuarioIdF int,
    pColor varchar(7)
)
Begin
	INSERT INTO Seccion(Nombre, usuarioIdF, Color) VALUES (pNombre, pUsuarioIdF, pColor);
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_llenarCategorias;

DELIMITER %$
CREATE PROCEDURE sp_llenarCategorias(

)
Begin
	SELECT Seccion.nombre FROM Seccion ORDER BY Seccion.nombre ASC;
END %$
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_agregarImagenNoticia
(IN pImagen varchar(100))
BEGIN
INSERT INTO Imagen VALUES(0, pImagen);
SELECT imagenId FROM Imagen WHERE imagenId = LAST_INSERT_ID();
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE sp_agregarVideoNoticia
(IN pVideo varchar(100))
BEGIN
INSERT INTO Video VALUES(0, pVideo);
SELECT videoId   FROM Video WHERE videoId  = LAST_INSERT_ID();
END //
DELIMITER ;


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
call sp_agregarCategoria('ps5', '1', '#f0f0f0');

select * from Usuario;
select * from Imagen;
select * from video;
select * from Seccion;
select * from noticia;

SELECT Usuario.nombre, Usuario.correo, Usuario.telefono, Usuario.contraseña, Imagen.imagenFile FROM Usuario INNER JOIN Imagen ON Usuario.imagenIdF = Imagen.imagenId WHERE Usuario.nombre = 'erick';