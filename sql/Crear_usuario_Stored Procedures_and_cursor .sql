CREATE OR REPLACE PROCEDURE 
 crear_usuario(var_nombre in VARCHAR2 ,var_correo in varchar2 ,var_password in varchar2 ,var_role in varchar2 ,  Alerta out varchar2) 
 AS
 validador_si_existe_usuario number;
 var_id_role number;
 BEGIN
 SELECT count(*) 
 into validador_si_existe_usuario
 from usuario
 where correo=var_correo and USER_PASSWORD = var_password;

 if validador_si_existe_usuario = 1 then
  Alerta:='Estos datos coinciden con un usuario de la base de datos';
 else
 Case WHEN var_role='ADMIN' THEN  
 insert into usuario(NOMBRE,CORREO,USER_PASSWORD,ID_ROLE) values(var_nombre,var_correo,var_password,1);
 WHEN var_role='CONTADOR' THEN
 insert into usuario(NOMBRE,CORREO,USER_PASSWORD,ID_ROLE) values(var_nombre,var_correo,var_password,2);
 WHEN var_role='TAGGER' THEN
 insert into usuario(NOMBRE,CORREO,USER_PASSWORD,ID_ROLE) values(var_nombre,var_correo,var_password,3);
 END CASE;
 Alerta:='Se ha logrado ingresar correctamente el usuario';
 end if;
 
 END;


CREATE OR REPLACE FUNCTION mostrar_Tabla_Usuarios
return SYS_REFCURSOR
as
c_usuarios SYS_REFCURSOR;
                        
begin
    open c_usuarios FOR select *
                                from  usuario a inner join  usuario_role b on b.id_role=a.id_role  ; --- se trasladas los datos del disco a la memoria
    
   
   return c_usuarios;
    

end mostrar_Tabla_Usuarios ;