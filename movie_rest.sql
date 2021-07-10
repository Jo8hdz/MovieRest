drop database movie_rest;
create database movie_rest;

use movie_rest;


create table genero(
	idGenero int not null primary key,
	nombre varchar(100),
    deleted_at int (1)
);

create table pelicula(
    idPelicula int auto_increment not null primary key,
    nombre varchar(150),
    anio int,
    descripcion varchar(200),
    imagen varchar(100),
    idGenero int ,
    foreign key (idGenero) references genero(idGenero),
    deleted_at int (1)    
);

create table usuario(
	idusuario int not null primary key,
    nombre varchar(255),
	email varchar(255),
    password varchar(255),
    deleted_at int (1)
);

create TABLE IF NOT EXISTS `ci_sessions` (
    `id` varchar(128) NOT NULL,
    `ip_address` varchar(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` blob NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
);


insert into genero values   (1,'Terror',NULL),
                            (2,'Accion',NULL),
                            (3,'Drama',NULL),
                            (4,'Suspenso',NULL),
                            (5,'Ciencia Ficcion',NULL),
                            (6,'Animacion',NULL),
                            (7,'Musical',NULL);

insert into pelicula values (1,'El Rey Leon',1994,
                            'Tras la muerte de su padre, Simba vuelve a enfrentar a su malvado tío, Scar, y reclamar el trono de rey.',
                            NULL,6,NULL),
                            (2,'Volver al Futuro',1985,
                            'Una máquina del tiempo transporta a un adolescente a los años 50, cuando sus padres todavía estudiaban en la secundaria.',
                            NULL,5,NULL),
                            (3,'Lluvia de Hambuerguesas',2006,
                            'El suceso más delicioso desde que el macaroni se mezcló con queso. Inspirado por un libro de niños, la película se enfoca en una ciudad donde la comida cae del cielo como lluvia.',
                            NULL,6,NULL),
                            (4,'El brillo de una estrella',2001,
                            'La relación amorosa entre una cantante y su productor comienza a deteriorarse cuando ella alcanza el estrellato.',
                            NULL,7,NULL);

insert into usuario values  (1,'Alexa','alexa@gmail.com','$2y$10$9ZptYkIQZxEpxdymyhWhEuMFR3F6GeiC3xy.vqQzHR4E7W3SnVyNq',NULL),
                            (2,'Marin','marin@gmail.com','12345',NULL),
                            (3,'Dani','dani@gmail.com','12345',NULL),
                            (4,'Job','job@gmail.com','12345',NULL);                            



/*
cd /Applications/XAMPP/xamppfiles/bin
./mysql -u root -p


source /Applications/XAMPP/xamppfiles/htdocs/MovieRest/movie_rest.sql