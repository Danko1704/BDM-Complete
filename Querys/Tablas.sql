CREATE DATABASE IF NOT EXISTS proyectodb;

USE proyectodb;

DROP TABLE IF EXISTS Imagen;

CREATE TABLE IF NOT EXISTS Imagen(
	imagenId int auto_increment not null comment 'Id de la imagen en la tabla',
    imagenFile mediumblob comment 'Archivo de imagen',
    primary key (imagenId)
);

DROP TABLE IF EXISTS Video;

CREATE TABLE IF NOT EXISTS Video(
	videoId int auto_increment not null comment 'Id del video en la tabla',
    videoFile mediumblob comment 'Archivo de video',
    primary key (videoId)
);

DROP TABLE IF EXISTS Usuario;

CREATE TABLE IF NOT EXISTS Usuario(
	usuarioId int auto_increment not null comment 'Id del usuario en la tabla',
	nombre varchar(50) not null comment 'nombre de el usuario',
	correo varchar(30) not null comment 'correo del usuario',
	telefono varchar(10) not null comment 'telefono del usuario', 
	contraseña varchar(30) not null comment 'contraseña del usuario',
	imagenIdF int comment 'id que hace referencia a la imagen almacenada en la tabla de imagenes',
	tipoUsuario enum ('Admin','Reportero','Usuario') default 'Usuario' comment 'tipos de usuario existentes',
	isActive bool default true,
	primary key (usuarioId),
	foreign key (imagenIdF) References Imagen(imagenId)
);

DROP TABLE IF EXISTS Noticia;

CREATE TABLE IF NOT EXISTS Noticia(
	noticiaId int auto_increment not null comment 'Id de la noticia en la tabla',
	titulo varchar(40) not null comment 'titulo de la noticia',
	sinopsis varchar(80) not null comment 'sinopsis/descripcion de la noticia',
	texto text not null comment 'texto de la noticia',
	fechaCreacion timestamp not null default now() comment 'fecha y hora de la noticia',
	palabraClave1 varchar (25) not null comment 'palabra clave1 de la noticia',
	palabraClave2 varchar (25) not null comment 'palabra clave2 de la noticia',
	palabraClave3 varchar (25) not null comment 'palabra clave3 de la noticia',
	autorIdF int not null comment 'id del autor/usuario de la noticia',
	isActive bool default false comment 'booleana para "eliminar" la noticia',
    comentarioEditor varchar(65535) null comment 'comentario del editor para errores',
	estadoNoticia enum ('Edicion','Revision','Publicado') default 'Edicion' comment 'estado de la noticia',
	primary key (noticiaId),
	foreign key(autorIdf) References Usuario(usuarioId)
);

DROP TABLE IF EXISTS LikeNoticia;

CREATE TABLE IF NOT EXISTS LikeNoticia(
	likeNoticiaId int auto_increment not null comment 'Id del like en la noticia en la tabla',
	isActive bool default false comment 'ver si esta activa la noticia o el like',
	usuarioIdF int not null comment 'id del usuario que le da like',
	noticiaIdF  int not null comment 'id de la noticia que recibira like',
	primary key (likeNoticiaId),
	foreign key (usuarioIdF) references Usuario(usuarioId),
	foreign key (noticiaIdF) references Noticia(noticiaId)
);

DROP TABLE IF EXISTS Multimedia;

CREATE TABLE IF NOT EXISTS Multimedia(
	multimediaId int auto_increment not null,
	imagenIdF int, 
	videoIdF int,
	noticiaIdF int not null,
	primary key (multimediaId),
	foreign key (imagenIdF) references Imagen(imagenId),
	foreign key (videoIdF) references  Video(videoId),
	foreign key (noticiaIdF) references Noticia(noticiaId)
);

DROP TABLE IF EXISTS Comentario;

CREATE TABLE IF NOT EXISTS Comentario (
	comentarioId int auto_increment not null comment 'Id del comentario en la tabla',    
	comentario text comment 'texto del comentario',
	usuariIdF int,
	isActive bool default true comment 'comentario activo o no',
	fecha timestamp not null default now() comment 'fecha actual',
	respuestaIdF int,
	noticiaIdF int,
	primary key (comentarioId),
	foreign key  (respuestaIdF) references Comentario(comentarioId),
	foreign key  (noticiaIdF) references Noticia(noticiaId)
);