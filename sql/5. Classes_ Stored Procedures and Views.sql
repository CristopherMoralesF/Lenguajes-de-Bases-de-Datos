SET SERVEROUTPUT ON;

CREATE OR REPLACE VIEW CLASSES_LIST AS
    SELECT 
        C.ID_CLASE,
        C.DESCRIPCION_CLASE,
        (SELECT CC.ID_CUENTA FROM CLASE_CUENTA CC WHERE CC.ID_CLASE = C.ID_CLASE AND ID_CATEGORIA_CUENTA = 1) AS CUENTA_ACTIVO,
        (SELECT CC.ID_CUENTA FROM CLASE_CUENTA CC WHERE CC.ID_CLASE = C.ID_CLASE AND ID_CATEGORIA_CUENTA = 5) AS CUENTA_GASTO,
        (SELECT CC.ID_CUENTA FROM CLASE_CUENTA CC WHERE CC.ID_CLASE = C.ID_CLASE AND ID_CATEGORIA_CUENTA = 6) AS CUENTA_DEP_ACUMULADA
    FROM CLASE C;

CREATE OR REPLACE PROCEDURE CREATE_CLASS (
    IN_CLASS_DESCRIPTION    CLASE.DESCRIPCION_CLASE%TYPE,
    IN_ASSET_ACCOUNT        CUENTA_CONTABLE.ID_CUENTA%TYPE,
    IN_DEP_ACUM_ACCOUNT     CUENTA_CONTABLE.ID_CUENTA%TYPE,
    IN_EXPENSE_ACCOUNT      CUENTA_CONTABLE.ID_CUENTA%TYPE,
    OUT_RESULT              OUT VARCHAR
)
AS
    
    VAR_SIMILAR_ACCOUNTS    NUMBER(30);
    VAR_ERROR_TRACKER       VARCHAR(255);
BEGIN

    -- Validate no repetitive asset account
    SELECT COUNT(*) INTO VAR_SIMILAR_ACCOUNTS FROM CLASSES_LIST WHERE CUENTA_ACTIVO = IN_ASSET_ACCOUNT;
    
    IF VAR_SIMILAR_ACCOUNTS > 0 THEN
        VAR_ERROR_TRACKER := 'The asset account is already in use for other class, select another asset account';
    END IF;  
    
    -- Validate no repetitive accumulative depreciation account
    SELECT COUNT(*) INTO VAR_SIMILAR_ACCOUNTS FROM CLASSES_LIST WHERE CUENTA_DEP_ACUMULADA = IN_DEP_ACUM_ACCOUNT;
    
    IF VAR_SIMILAR_ACCOUNTS > 0 THEN
        VAR_ERROR_TRACKER := 'The accumulated depreciation account is already in use for other class, select another accumulated depreciation account';
    END IF;  
    
    -- Validate no repetitive expense account
    SELECT COUNT(*) INTO VAR_SIMILAR_ACCOUNTS FROM CLASSES_LIST WHERE CUENTA_GASTO = IN_EXPENSE_ACCOUNT;
    
    IF VAR_SIMILAR_ACCOUNTS > 0 THEN
        VAR_ERROR_TRACKER := 'The expense account is already in use for other class, select another expense account';
    END IF;  
    
    -- Define the final return from the procedure
    IF LENGTH(VAR_ERROR_TRACKER) > 0 THEN
        OUT_RESULT := VAR_ERROR_TRACKER;
    ELSE
        OUT_RESULT := 'Successful';
    END IF; 
    
END;

DECLARE
    VAR_CLASS_DESCRIPTION   VARCHAR(255);
    VAR_ASSET_ACCOUNT       CUENTA_CONTABLE.ID_CUENTA%TYPE;
    VAR_DEP_ACUM_ACCOUNT    CUENTA_CONTABLE.ID_CUENTA%TYPE;
    VAR_EXPENSE_ACCOUNT     CUENTA_CONTABLE.ID_CUENTA%TYPE;
    VAR_RESULT              VARCHAR(255);
BEGIN

    VAR_CLASS_DESCRIPTION := 'Software';
    VAR_ASSET_ACCOUNT := '1-2-2-167461';
    VAR_DEP_ACUM_ACCOUNT := '6-2-3-167405';
    VAR_EXPENSE_ACCOUNT := '5-2-2-167405';
    CREATE_CLASS(VAR_CLASS_DESCRIPTION,VAR_ASSET_ACCOUNT,VAR_DEP_ACUM_ACCOUNT,VAR_EXPENSE_ACCOUNT,VAR_RESULT);
    DBMS_OUTPUT.PUT_LINE(VAR_RESULT);
END;

DESCRIBE CLASE;

COMMIT;
