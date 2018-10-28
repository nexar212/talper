CREATE OR REPLACE FUNCTION consulta_solicitudes(_correo text)
  RETURNS solicitudes AS
$BODY$ 
DECLARE


_cont int;

begin
select folio_solicitud,estado,cantidad,fecha_solicitud from solicitudes where correo = $1 into _cont;

IF _cont > 0 THEN

   mensaje:= 'usuario registrado';
   estado:= '0';  
      RETURN;    

END IF;

   insert into usuarios(nom_user,correo)values(_user,_correo);
   
   mensaje:= 'usuario no registrado';
   estado:= '1';

 RETURN;

end;$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;


SELECT * FROM user_acceso('alexis','nexar_212@hotmail.com')

DROP FUNCTION user_acceso(text,text) CASCADE

select * from usuarios

truncate table usuarios cascade
drop table usuarios cascade;

create table usuarios(
id_user		serial not null,
nom_user	varchar(50) not null,
correo		varchar(50) not null,
fecha_registro	timestamp default now()

);