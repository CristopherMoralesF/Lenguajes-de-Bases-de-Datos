-- Create a procedure that validates the log in
CREATE OR REPLACE PROCEDURE VALIDAR_USUARIOS(
        IN_CORREO           IN VARCHAR2,
        OUT_ID_USUARIO      OUT NUMBER,
        IN_USER_PASSWORD    IN VARCHAR2,
        OUT_NOMBRE          OUT VARCHAR2,
        OUT_ROLE            OUT VARCHAR2,
        OUT_ALERTA          OUT VARCHAR2
) AS
    VAR_USER_FOUND  NUMBER(10,2);
BEGIN
    
    SELECT COUNT(*) INTO VAR_USER_FOUND FROM USUARIO U WHERE U.CORREO LIKE IN_CORREO AND U.USER_PASSWORD LIKE IN_USER_PASSWORD;
    DBMS_OUTPUT.PUT_LINE('Var user found: ' || VAR_USER_FOUND);
    
    IF VAR_USER_FOUND > 0 THEN
        SELECT
            U.NOMBRE,
            U.ID_USUARIO,
            (SELECT R.NOMBRE_ROLE FROM USUARIO_ROLE R WHERE R.ID_ROLE = U.ID_ROLE)
        INTO
            OUT_NOMBRE,
            OUT_ID_USUARIO,
            OUT_ROLE
        FROM USUARIO U
        WHERE U.CORREO = IN_CORREO AND U.USER_PASSWORD = IN_USER_PASSWORD;
        
        OUT_ALERTA := 'Se ha logrado ingresar';
    
    ELSE
        OUT_ALERTA := 'No se ha logrado ingresar';
    END IF;    

END;

-- test the procedure

DECLARE
    VAR_CORREO          VARCHAR2(255);
    VAR_ID_USUARIO      NUMBER(10,2);
    VAR_USER_PASSWORD   VARCHAR2(255);
    VAR_NOMBRE          VARCHAR2(255);
    VAR_ROLE            VARCHAR2(50);
    VAR_ALETAR          VARCHAR2(255);
BEGIN

    VAR_CORREO := 'cmorale@asset_management.com';
    VAR_USER_PASSWORD := 'Cris13@';


    VALIDAR_USUARIOS(VAR_CORREO,VAR_ID_USUARIO,VAR_USER_PASSWORD,VAR_NOMBRE,VAR_ROLE,VAR_ALETAR);
    DBMS_OUTPUT.PUT_LINE(VAR_ALETAR);
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


 