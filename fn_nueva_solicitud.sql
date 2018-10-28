CREATE OR REPLACE FUNCTION nueva_solicitud(_correo text,_cantidad text,_tarjeta text,_mensualidades text,_edad int)
   RETURNS SETOF text AS
 $BODY$
 declare
 estado text;
 mensaje text;
 begin
	insert into solicitudes (estado,cantidad,tarjeta,mensualidades,correo,edad)values('pendiente',_cantidad,_tarjeta,_mensualidades,_correo,_edad);
	estado:='0';

	
 return next estado;
 return;
 end
 $BODY$
 LANGUAGE 'plpgsql'

