CREATE OR REPLACE FUNCTION user_acceso(_user text,_correo text,out mensaje text,out estado text)
  RETURNS record AS
$BODY$ 
DECLARE


_cont int;



begin
select count(*) from usuarios where correo = $2 into _cont;

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


