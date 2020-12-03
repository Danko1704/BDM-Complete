use proyectodb;

DROP VIEW IF EXISTS v_NoticiasEspeciales;

CREATE VIEW v_NoticiasEspeciales AS 
SELECT N.noticiaId, N.titulo, N.sinopsis, N.texto, N.fechaCreacion, N.palabraClave1, N.palabraClave2, N.palabraClave3, U.nombre AS 'Autor', S.nombre AS 'Seccion', N.comentarioEditor FROM Noticia N
INNER JOIN Usuario U ON U.usuarioId = N.autorIdF
INNER JOIN Seccion S ON S.seccionId = N.seccionIdF
WHERE especial = true
LIMIT 3;

DROP VIEW IF EXISTS v_NoticiasRegulares;

CREATE VIEW v_NoticiasRegulares AS 
SELECT N.noticiaId, N.titulo, N.sinopsis, N.texto, N.fechaCreacion, N.palabraClave1, N.palabraClave2, N.palabraClave3, U.nombre AS 'Autor', S.nombre AS 'Seccion', N.comentarioEditor FROM Noticia N
INNER JOIN Usuario U ON U.usuarioId = N.autorIdF
INNER JOIN Seccion S ON S.seccionId = N.seccionIdF
WHERE especial = false;

Select * from v_noticiasespeciales;

Select * from v_NoticiasRegulares;

Select * from v_Noticias;