create table solicitudes(
folio_solicitud	serial,
estado		text,
cantidad	text,
fecha_solicitud	date default now()::date,
correo		text,
mensualidades	text,
tarjeta		text,
edad		int
)



create table usuarios(
id_user		serial not null,
nom_user	varchar(50) not null,
correo		varchar(50) not null,
fecha_registro	timestamp default now()

);

