CREATE OR REPLACE PROCEDURE 
 alter_usuario(var_id_usuario in number,var_nombre in VARCHAR2 ,var_correo in varchar2 ,var_password in varchar2 ,var_role in varchar2 ,  Alerta out varchar2) 
 AS
 validador_si_existe_usuario number;
 var_id_role number;
 BEGIN
 SELECT count(*) 
 into validador_si_existe_usuario
 from usuario
 where  id_usuario=var_id_usuario;

 if validador_si_existe_usuario = 1 then
  
 Case WHEN var_role='ADMIN' THEN  
 
 update usuario set NOMBRE=var_nombre,CORREO=var_correo,USER_PASSWORD=var_password,ID_ROLE=1 
 where id_usuario=var_id_usuario;
 
 
 WHEN var_role='CONTADOR' THEN
 
 update usuario set NOMBRE=var_nombre,CORREO=var_correo,USER_PASSWORD=var_password,ID_ROLE=2 
 where id_usuario=var_id_usuario;
 
 WHEN var_role='TAGGER' THEN
 
 update usuario set NOMBRE=var_nombre,CORREO=var_correo,USER_PASSWORD=var_password,ID_ROLE=3 
 where id_usuario=var_id_usuario;
 
 END CASE;
 Alerta:='Se ha logrado alterar correctamente el usuario';
 end if;

 EXCEPTION 
    WHEN NO_DATA_FOUND THEN 
 Alerta:='No se encontro usuario';
 
 END;



CREATE OR REPLACE PROCEDURE 
 BUSCAR_USUARIO_POR_ID ( var_id_usuario in number,var_id_usuario_out out number,var_nombre out varchar2,var_correo out VARCHAR2,var_user_password out VARCHAR2 , Alerta out varchar2) 
 AS
 validador_usuario number;
 
 BEGIN
 SELECT count(*) 
 into validador_usuario
 from usuario
 where usuario.id_usuario = var_id_usuario;

 

 
 Select id_usuario, nombre ,correo,user_password into var_id_usuario_out ,var_nombre,var_correo,var_user_password from usuario
 where usuario.id_usuario = var_id_usuario;
    

 if validador_usuario = 1 then
  Alerta:='Se ha encontrado Usuario';
  
 end if;

 EXCEPTION 

    WHEN NO_DATA_FOUND THEN 

        alerta:='No se ha logrado encontrar usuario'; 
 END;



CREATE OR REPLACE FUNCTION BUSCAR_USUARIO_POR_ID( var_id_usuario in number)
return SYS_REFCURSOR
as
c_usuarios SYS_REFCURSOR;
                        
begin
    open c_usuarios FOR select nombre ,correo,user_password 
                                from  usuario where usuario.id_usuario=var_id_usuario; --- se trasladas los datos del disco a la memoria
    
   
   return c_usuarios;
 
end BUSCAR_USUARIO_POR_ID ;
