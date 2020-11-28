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
    SELECT Usuario.nombre FROM Usuario ORDER BY Usuario.nombre ASC;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_infoUsuario;

DELIMITER %$
CREATE PROCEDURE sp_infoUsuario(
	pNombre varchar(50)
)
Begin
    SELECT Usuario.nombre, Usuario.correo, Usuario.telefono, Usuario.contraseña, Imagen.imagenFile FROM Usuario INNER JOIN Imagen ON Usuario.imagenIdF = Imagen.imagenId WHERE Usuario.nombre = pNombre;
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
    pAutorId int,
    pComentarioEditor varchar(1000),
	pCategoria int
)
Begin
	INSERT INTO Noticia(titulo, sinopsis, fechaCreacion, palabraClave1, palabraClave2, palabraClave3, autorIdF, comentatioEditor, seccionIdF)
    VALUES (pTitulo, pSinopsis, now(), pPalabraClave1, pPalabraClave2, pPalabraClave3, pAutorId, pComentarioEditor, pCategoria);
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_agregarCategoria;

DELIMITER %$
CREATE PROCEDURE sp_agregarCategoria(
	pTitulo varchar (40),
	pSinopsis varchar(80),
    pTexto text,
    pPalabraClave1 varchar(25),
    pPalabraClave2 varchar(25),
    pPalabraClave3 varchar(25),
    pAutorId int,
    pComentarioEditor varchar(1000),
	pCategoria int
)
Begin
	INSERT INTO Noticia(titulo, sinopsis, fechaCreacion, palabraClave1, palabraClave2, palabraClave3, autorIdF, comentatioEditor, seccionIdF)
    VALUES (pTitulo, pSinopsis, now(), pPalabraClave1, pPalabraClave2, pPalabraClave3, pAutorId, pComentarioEditor, pCategoria);
END %$
DELIMITER ;

select * from noticia;

INSERT INTO Usuario(nombre, correo, telefono, contraseña, tipoUsuario) VALUES ('danko', 'admin@hotmail.com', '9513375708', 'admin', 'Admin');

call sp_agregarUsuario('erick', 'lala@hotmail.com', '9512375708', 'dodo');
call sp_agregarImagenUsuario('lala@hotmail.com','monky_flip.mp4');
call sp_cambiarReportero ('erick');
call sp_selectUsuarios();
call sp_infoUsuario('papotericudo');
call sp_imagenUsuarioMostrar('papotericudo');
call sp_updateUsuario ('papucho', 'perro', 'perro@hotmail.com', '9512278531', 'Peludin9$', 'perro.jpg');
call sp_agregarNoticia ('huevos', 'muchos huevos', 'huevo1', 'huevo2', 'huevo3', '6', 'no hay pah', '2');
select * from Usuario;
select * from Imagen;

SELECT Usuario.nombre, Usuario.correo, Usuario.telefono, Usuario.contraseña, Imagen.imagenFile FROM Usuario INNER JOIN Imagen ON Usuario.imagenIdF = Imagen.imagenId WHERE Usuario.nombre = 'papotericudo';

TRUNCATE TABLE Usuario;

INSERT INTO Imagen(imagenfile) VALUES ("huevos");