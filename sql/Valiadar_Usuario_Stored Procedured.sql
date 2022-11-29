CREATE OR REPLACE PROCEDURE 
 validar_usuarios ( var_correo in VARCHAR2,var_id_usuario out number,var_user_password in VARCHAR2 ,var_nombre out varchar2,var_role out varchar2 ,  Alerta out varchar2) 
 AS
 validador_usuario number;
 
 BEGIN
 SELECT count(*) 
 into validador_usuario
 from usuario
 where correo=var_correo and USER_PASSWORD = var_user_password;

 Select nombre ,ID_USUARIO into var_nombre ,var_id_usuario from usuario
 where correo=var_correo and USER_PASSWORD = var_user_password;
  
 select b.NOMBRE_ROLE into var_role from  usuario a inner join  usuario_role b on b.id_role=a.id_role 
 where a.correo=var_correo and a.USER_PASSWORD = var_user_password;

 if validador_usuario = 1 then
  Alerta:='Se ha logrado ingresar';
 else
  Alerta:='No se ha logrado ingresar';
 end if;
 
 END;

---Buscar por id usuario

 CREATE OR REPLACE PROCEDURE 
 Buscar_por_id_usuarios (var_id_usuarios in number,imprimir OUT VARCHAR2) 
 AS
 var_usuario usuario%rowtype;                                                       
 BEGIN
 SELECT Nombre ,Correo 
 into var_usuario.nombre,var_usuario.correo 
 from usuario where id_usuario=var_id_usuarios;
 
 
 
 imprimir := 'Nombre ' || var_usuario.nombre ||' Correo '|| var_usuario.correo ;
 
 END;

 