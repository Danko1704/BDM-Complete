use proyectodb;

DROP VIEW IF EXISTS v_NoticiasEspeciales;

CREATE VIEW v_NoticiasEspeciales AS 
SELECT N.noticiaId, N.titulo, N.sinopsis, N.texto, N.fechaCreacion, N.palabraClave1, N.palabraClave2, N.palabraClave3, U.nombre AS 'Autor', S.nombre AS 'Seccion', N.comentarioEditor FROM Noticia N
INNER JOIN Usuario U ON U.usuarioId = N.autorIdF
INNER JOIN Seccion S ON S.seccionId = N.seccionIdF
WHERE especial = true AND N.isActive = true ORDER BY noticiaId DESC
LIMIT 3;

DROP VIEW IF EXISTS v_NoticiasRegulares;

CREATE VIEW v_NoticiasRegulares AS 
SELECT N.noticiaId, N.titulo, N.sinopsis, N.texto, N.fechaCreacion, N.palabraClave1, N.palabraClave2, N.palabraClave3, U.nombre AS 'Autor', S.nombre AS 'Seccion', N.comentarioEditor FROM Noticia N
INNER JOIN Usuario U ON U.usuarioId = N.autorIdF
INNER JOIN Seccion S ON S.seccionId = N.seccionIdF
WHERE especial = false AND N.isActive = true ORDER BY noticiaId DESC
LIMIT 3;

DROP VIEW IF EXISTS v_imagenesEspeciales;

CREATE VIEW v_imagenesEspeciales AS 
SELECT I.imagenId , I.imagenFile FROM Imagen I
INNER JOIN Multimedia M ON M.imagenIdF = I.imagenId
INNER JOIN Noticia N ON N.noticiaId = M.noticiaIdF
WHERE N.especial = true and N.isActive = true ORDER BY imagenId DESC
LIMIT 9;

DROP VIEW IF EXISTS v_imagenesRegulares;

CREATE VIEW v_imagenesRegulares AS 
SELECT I.imagenId , I.imagenFile FROM Imagen I
INNER JOIN Multimedia M ON M.imagenIdF = I.imagenId
INNER JOIN Noticia N ON N.noticiaId = M.noticiaIdF
WHERE N.especial = false and N.isActive = true ORDER BY imagenId DESC
LIMIT 9;

Select * from v_noticiasespeciales;

Select * from v_NoticiasRegulares;

select * from v_imagenesEspeciales;

select * from v_imagenesRegulares;