CREATE OR REPLACE FUNCTION consulta_solicitudes(_correo text)
   RETURNS SETOF solicitudes AS
 $BODY$
 declare
 tabla record;
 begin
	for tabla in select folio_solicitud,estado,cantidad,fecha_solicitud,correo,tarjeta,mensualidades,edad from solicitudes where correo = $1 
	loop
 return next tabla;
 end loop;
 return;
 end
 $BODY$
 LANGUAGE 'plpgsql'

