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
    SELECT Usuario.usuarioId, Usuario.nombre FROM Usuario WHERE tipoUsuario = 'Usuario' OR tipoUsuario = 'Reportero'
    ORDER BY Usuario.nombre ASC ;
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
	pTitulo varchar (150),
	pSinopsis varchar(150),
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

DROP PROCEDURE IF EXISTS sp_noticiasPendientes;

DELIMITER %$
CREATE PROCEDURE sp_noticiasPendientes(
)
Begin
	SELECT Noticia.noticiaId, Noticia.titulo FROM Noticia WHERE estadoNoticia = 'Edicion';
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
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaIni IS NULL AND FechaFin IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');

	ELSEIF (FechaIni IS NULL AND Seccion IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion < FechaFin
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaIni IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion < FechaFin
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaFin IS NULL AND Seccion IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion > FechaIni
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
    
    ELSEIF (FechaFin IS NULL) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND fechaCreacion > FechaIni
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
	
    ELSEIF (Seccion IS NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND (isActive = 1 AND estadoNoticia = 'Publicado');

    ELSEIF (FechaIni IS NOT NULL AND FechaFin IS NOT NULL AND Seccion IS NOT NULL ) THEN
		SELECT noticiaId, titulo, sinopsis FROM Noticia
		WHERE ((Texto LIKE CONCAT('%', palabraClave1, '%')) OR (Texto LIKE CONCAT('%', palabraClave2, '%')) OR (Texto LIKE CONCAT('%', palabraClave3, '%')) OR (titulo LIKE CONCAT('%', Texto, '%')))
        AND (fechaCreacion BETWEEN FechaIni AND FechaFin)
        AND seccionIdf = Seccion
        AND (isActive = 1 AND estadoNoticia = 'Publicado');
       
	END IF;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_noticiaParaRevision;

DELIMITER %$
CREATE PROCEDURE sp_noticiaParaRevision(
	pTitulo varchar(150)
)
Begin
	DECLARE  autorNombre varchar(30);
    DECLARE  seccionNombre varchar(30);
    DECLARE  idAutor int;
    DECLARE idSeccion int;
	SET 
		idSeccion = (SELECT Noticia.seccionIdf FROM Noticia WHERE noticia.titulo = pTitulo),
		idAutor = (SELECT Noticia.autorIdF FROM Noticia Where noticia.titulo = pTitulo),
        autorNombre = (SELECT Usuario.nombre FROM Usuario WHERE Usuario.usuarioId = idAutor),
        seccionNombre = (SELECT Seccion.nombre FROM Seccion WHERE Seccion.seccionId = idSeccion);
        
	SELECT Noticia.noticiaId, Noticia.titulo, Noticia.sinopsis, Noticia.texto, Noticia.fechaCreacion, noticia.palabraClave1, noticia.palabraClave2, noticia.palabraClave3, autorNombre, seccionNombre, noticia.comentarioEditor FROM Noticia WHERE titulo = pTitulo;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_imagenesParaRevision;

DELIMITER %$
CREATE PROCEDURE sp_imagenesParaRevision(
	pTitulo varchar(150)
)
Begin
    DECLARE  idNoticia int;
	SET 
		idNoticia = (SELECT Noticia.noticiaId FROM Noticia WHERE Noticia.titulo = pTitulo);
        
	SELECT 	multimedia.imagenIdF, imagen.imagenFile 
    from multimedia 
    INNER JOIN imagen on multimedia.imagenIdF = imagen.imagenId AND multimedia.noticiaIdF = idNoticia;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_videosParaRevision;

DELIMITER %$
CREATE PROCEDURE sp_videosParaRevision(
	pTitulo varchar(150)
)
Begin
    DECLARE  idNoticia int;
	SET 
		idNoticia = (SELECT Noticia.noticiaId FROM Noticia WHERE Noticia.titulo = pTitulo);
        
	SELECT 	multimedia.videoIdF, video.videoFile 
    from multimedia 
    INNER JOIN video on multimedia.videoIdF = video.videoId AND multimedia.noticiaIdF = idNoticia;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_updateComentarioAdmin;

DELIMITER %$
CREATE PROCEDURE sp_updateComentarioAdmin(
	pTitulo varchar(150),
    pComentario varchar(1000)
)
Begin
    DECLARE  idNoticia int;
	SET 
		idNoticia = (SELECT Noticia.noticiaId FROM Noticia WHERE Noticia.titulo = pTitulo);
        
	UPDATE noticia
	SET comentarioEditor = pComentario
	WHERE noticia.noticiaId = idNoticia;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_aceptarNoticia;

DELIMITER %$
CREATE PROCEDURE sp_aceptarNoticia(
	pTitulo varchar(150)
)
Begin
    DECLARE  idNoticia int;
	SET 
		idNoticia = (SELECT Noticia.noticiaId FROM Noticia WHERE Noticia.titulo = pTitulo);
        
	UPDATE noticia
	SET estadoNoticia = 'Publicado', isActive = true
	WHERE noticia.noticiaId = idNoticia;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_noticiasReportero;

DELIMITER %$
CREATE PROCEDURE sp_noticiasReportero(
	pReportero varchar(30)
)
Begin
	DECLARE idReportero int;
    SET	
		idReportero = (SELECT usuario.usuarioId from Usuario WHERE usuario.nombre = pReportero);
	SELECT Noticia.noticiaId, Noticia.titulo FROM Noticia WHERE estadoNoticia = 'edicion' and noticia.autorIdF = idReportero;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_editarNoticia;

DELIMITER %$
CREATE PROCEDURE sp_editarNoticia(
	oTitulo varchar(150),
	pTitulo varchar (150),
	pSinopsis varchar(150),
    pTexto text,
    pPalabraClave1 varchar(25),
    pPalabraClave2 varchar(25),
    pPalabraClave3 varchar(25),
	pCategoria varchar(50),
    pEspecial bool
)
Begin
DECLARE idSeccion int;
DECLARE idNoticia int;
	SET 
		idSeccion = (SELECT Seccion.seccionId FROM Seccion WHERE Seccion.nombre = pCategoria),
        idNoticia = (SELECT Noticia.noticiaId FROM Noticia WHERE noticia.titulo = oTitulo);
    
    UPDATE noticia
	SET titulo = pTitulo,
    sinopsis = pSinopsis,
    texto = pTexto,
    fechaCreacion = now(),
    PalabraClave1 = pPalabraClave1,
    PalabraClave2 = pPalabraClave2,
    PalabraClave3 = pPalabraClave3,
    seccionIdF = idSeccion,
    especial = pEspecial
	WHERE noticia.noticiaId = idNoticia;
    
    SELECT noticiaId FROM Noticia WHERE noticiaId = idNoticia;
END %$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_updateImagenNoticia;

DELIMITER //
CREATE PROCEDURE sp_updateImagenNoticia
(IN pImagen varchar(100), idImagen int)
BEGIN
	IF pImagen != '' THEN
		UPDATE Imagen 
		SET imagenFile = pImagen WHERE imagenId = idImagen;
	END IF;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_updateVideoNoticia;

DELIMITER //
CREATE PROCEDURE sp_updateVideoNoticia
(IN pVideo varchar(100), idVideo int)
BEGIN
INSERT INTO Video VALUES(0, pVideo);
	IF pVideo != '' THEN
		UPDATE Video 
			SET videoFile = pVideo WHERE videoId = idVideo;
	END IF;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_NoticiasEspeciales;

DELIMITER //
CREATE PROCEDURE sp_NoticiasEspeciales
()
BEGIN
	SELECT 	v_noticiasespeciales.noticiaId, v_noticiasespeciales.titulo, v_noticiasespeciales.sinopsis, v_noticiasespeciales.texto, v_noticiasespeciales.fechaCreacion,
			v_noticiasespeciales.palabraClave1, v_noticiasespeciales.palabraClave2, v_noticiasespeciales.palabraClave3, v_noticiasespeciales.autor,
			v_noticiasespeciales.seccion, v_noticiasespeciales.comentarioEditor
	FROM v_noticiasespeciales;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_NoticiasRegulares;

DELIMITER //
CREATE PROCEDURE sp_NoticiasRegulares
()
BEGIN
	SELECT 	v_NoticiasRegulares.noticiaId, v_NoticiasRegulares.titulo, v_NoticiasRegulares.sinopsis, v_NoticiasRegulares.texto, v_NoticiasRegulares.fechaCreacion,
			v_NoticiasRegulares.palabraClave1, v_NoticiasRegulares.palabraClave2, v_NoticiasRegulares.palabraClave3, v_NoticiasRegulares.autor,
			v_NoticiasRegulares.seccion, v_NoticiasRegulares.comentarioEditor
	FROM v_NoticiasRegulares;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_imagenesEspeciales;

DELIMITER //
CREATE PROCEDURE sp_imagenesEspeciales
()
BEGIN
	SELECT 	v_imagenesEspeciales.imagenId, v_imagenesEspeciales.imagenFile
	FROM v_imagenesEspeciales;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_imagenesRegulares;

DELIMITER //
CREATE PROCEDURE sp_imagenesRegulares
()
BEGIN
	SELECT 	v_imagenesRegulares.imagenId, v_imagenesRegulares.imagenFile
	FROM v_imagenesRegulares;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_NoticiasUnica;

DELIMITER //
CREATE PROCEDURE sp_NoticiasUnica
(pIdNoticia int)
BEGIN
	SELECT 	v_unicaNoticia.noticiaId, v_unicaNoticia.titulo, v_unicaNoticia.sinopsis, v_unicaNoticia.texto, v_unicaNoticia.fechaCreacion,
			v_unicaNoticia.palabraClave1, v_unicaNoticia.palabraClave2, v_unicaNoticia.palabraClave3, v_unicaNoticia.autor,
			v_unicaNoticia.seccion, v_unicaNoticia.comentarioEditor
	FROM v_unicaNoticia WHERE noticiaId = pIdNoticia;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_imagenesUnica;

DELIMITER //
CREATE PROCEDURE sp_imagenesUnica
(pNoticiaId int)
BEGIN
	SELECT 	v_imagenesUnica.imagenId, v_imagenesUnica.imagenFile
	FROM v_imagenesUnica where noticiaIdF = pNoticiaId;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_videosUnica;

DELIMITER //
CREATE PROCEDURE sp_videosUnica
(pNoticiaId int)
BEGIN
	SELECT 	v_videosUnica.videoId, v_videosUnica.videoFile
	FROM v_videosUnica where v_videosUnica.noticiaIdF = pNoticiaId;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_comentariosNoticia;

DELIMITER //
CREATE PROCEDURE sp_comentariosNoticia
(pNoticiaId int)
BEGIN
	
	SELECT 	Comentario.comentario, U.nombre
	FROM Comentario INNER JOIN usuario U ON U.usuarioId = comentario.usuarioIdF 
    where Comentario.noticiaIdF = pNoticiaId AND isActive = true;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_agregarComentario;

DELIMITER //
CREATE PROCEDURE sp_agregarComentario(
	com text, 
    usuario varchar(50),
    noticia int
)
BEGIN
	DECLARE idusuario int;
    SET idusuario = (SELECT usuarioId FROM Usuario WHERE nombre = usuario);

	INSERT INTO Comentario (comentario, usuarioIdF, noticiaIdF) VALUES (com, idusuario, noticia);

END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_mostrarComentarios;

DELIMITER //
CREATE PROCEDURE sp_mostrarComentarios(
	noticia int
)
BEGIN
	SELECT U.nombre, C.comentario FROM Comentario C
    INNER JOIN Usuario U ON U.usuarioId = C.usuarioIdF
    WHERE C.noticiaIdF = noticia AND C.isActive = true;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_NoticiasReporteroActivas;

DELIMITER //
CREATE PROCEDURE sp_NoticiasReporteroActivas(
	spUser varchar(50)
)
BEGIN
	DECLARE userID int;
    SET userID = (SELECT usuarioId FROM Usuario WHERE nombre = spUser);
    
	SELECT titulo FROM Noticia
    WHERE autorIdF = userID AND noticia.isActive = true AND estadoNoticia = 'Publicado';

END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_NoticiasReporteroNoActivas;

DELIMITER //
CREATE PROCEDURE sp_NoticiasReporteroNoActivas(
	spUser varchar(50)
)
BEGIN
	DECLARE userID int;
    SET userID = (SELECT usuarioId FROM Usuario WHERE nombre = spUser);
    
	SELECT titulo FROM Noticia
    WHERE autorIdF = userID AND noticia.isActive = false AND estadoNoticia = 'Publicado';

END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_bajaNoticia;

DELIMITER //
CREATE PROCEDURE sp_bajaNoticia(
	pTitulo varchar(150)
)
BEGIN
    UPDATE noticia set isActive = false WHERE titulo = pTitulo;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_alzaNoticia;

DELIMITER //
CREATE PROCEDURE sp_alzaNoticia(
	pTitulo varchar(150)
)
BEGIN
    UPDATE noticia set isActive = true WHERE titulo = pTitulo;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_comentariosActivos;

DELIMITER //
CREATE PROCEDURE sp_comentariosActivos(
	pTitulo varchar(150)
)
BEGIN
DECLARE idTitulo int;
SET
	idTitulo = (SELECT noticia.noticiaId FROM noticia WHERE titulo = pTitulo);
    SELECT U.nombre FROM comentario C
	INNER JOIN Usuario U ON U.usuarioId = C.usuarioIdF
	WHERE C.isActive = true AND C.noticiaIdF = idTitulo;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_NoticiasReporteroGeneral;

DELIMITER //
CREATE PROCEDURE sp_NoticiasReporteroGeneral(
    spUser varchar(50)
)
BEGIN
    DECLARE userID int;
    SET userID = (SELECT usuarioId FROM Usuario WHERE nombre = spUser);
    
    SELECT titulo FROM Noticia
    WHERE autorIdF = userID AND estadoNoticia = 'Publicado';
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_eliminarComentarios;

DELIMITER //
CREATE PROCEDURE sp_eliminarComentarios(
    spUser varchar(50),
    spTitulo varchar(150)
)
BEGIN
    DECLARE user_ID int;
    DECLARE noticia_ID int;
    SET user_ID = (SELECT usuarioId FROM Usuario WHERE Usuario.nombre = spUser);
    SET noticia_ID = (SELECT noticiaId FROM Noticia WHERE Noticia.titulo = spTitulo);
    
    UPDATE Comentario SET isActive = false WHERE noticiaIdF = noticia_ID AND usuarioIdF = user_ID;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_ImagenUsuario;

DELIMITER //
CREATE PROCEDURE sp_ImagenUsuario(
    spUsuario varchar(50)
)
BEGIN

    SELECT I.imagenFile FROM Usuario U
    INNER JOIN Imagen I ON I.imagenId = U.imagenIdF
    WHERE U.nombre = spUsuario;

END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_NoticiasRelacionadas;

DELIMITER //
CREATE PROCEDURE sp_NoticiasRelacionadas(
    pNoticia int
)
BEGIN
    DECLARE miSeccion int;
    SET miSeccion = (SELECT seccionIdF FROM noticia WHERE noticia.noticiaId = pNoticia);

    SELECT N.noticiaId, N.titulo, N.sinopsis, N.fechaCreacion FROM noticia N
    INNER JOIN Seccion S ON S.seccionId = N.seccionIdF
    WHERE N.isActive = true AND N.estadoNoticia = 'Publicado' AND S.isActive = true AND N.seccionIdF = miSeccion AND N.noticiaId <> pNoticia
    ORDER BY N.noticiaId DESC
    LIMIT 3;

END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_ImagenNoticia;

DELIMITER //
CREATE PROCEDURE sp_ImagenNoticia(
    pNoticia int
)
BEGIN

    SELECT I.imagenFile FROM Multimedia M
    INNER JOIN imagen I ON I.imagenId = M.imagenIdF
    WHERE noticiaIdF = pNoticia
	limit 1;
END //
DELIMITER ;