SET SERVEROUTPUT ON;

CREATE OR REPLACE VIEW ACCOUNTS_RESUME AS
    SELECT 
        ID_CUENTA,
        DESCRIPCION_CUENTA,
        ID_CATEGORIA
    FROM CUENTA_CONTABLE
    ORDER BY ID_CUENTA ASC;
    
SELECT * FROM ACCOUNTS_RESUME;  

SELECT * FROM CUENTA_CONTABLE;
    
CREATE OR REPLACE VIEW ACCOUNTS_BALANCE_RESUME AS
    SELECT 
        CC.ID_CUENTA,
        CC.DESCRIPCION_CUENTA,
        CC.NATURALEZA,
        CAT.DESCRIPCION_CATEGORIA,
        CC.TOTAL_DEBITOS,
        CC.TOTAL_CREDITOS,
        CC.BALANCE
    FROM CUENTA_CONTABLE CC
    INNER JOIN CATEGORIA_CUENTA CAT ON CAT.ID_CATEGORIA = CC.ID_CATEGORIA
    ORDER BY CC.ID_CUENTA ASC;
    

CREATE OR REPLACE PROCEDURE CREATE_ACCOUNT (
    IN_ACCOUNT              IN CUENTA_CONTABLE.ID_CUENTA%TYPE,
    IN_ACCOUNT_DESCRIPTION  IN CUENTA_CONTABLE.DESCRIPCION_CUENTA%TYPE,
    IN_ACCOUNT_CATEGORY     IN CUENTA_CONTABLE.ID_CATEGORIA%TYPE,
    IN_ACCOUNT_NATURE       IN CUENTA_CONTABLE.NATURALEZA%TYPE,
    OUT_RESULT              OUT VARCHAR
)
AS
    VAR_FIRST_CARACTER      VARCHAR2(1);
    VAR_SIMILAR_ACCOUNTS    NUMBER(10,2);
    VAR_FORMAT_VALIDATION   VARCHAR2(255);
    VAR_ERROR_TRACKER       VARCHAR(255);
BEGIN

    -- Validate that the account ID match with the account category
    VAR_FIRST_CARACTER := SUBSTR(IN_ACCOUNT,1,1);
    
    IF VAR_FIRST_CARACTER != IN_ACCOUNT_CATEGORY THEN
        VAR_ERROR_TRACKER := 'Account does not match with the selected category';
    END IF;
    
    -- Validate if the account already exists
    SELECT COUNT(*) INTO VAR_SIMILAR_ACCOUNTS FROM CUENTA_CONTABLE WHERE ID_CUENTA = IN_ACCOUNT;
    
    IF VAR_SIMILAR_ACCOUNTS > 0 THEN 
        VAR_ERROR_TRACKER := 'The account already exists, select another account number';
    END IF;
    
    -- Validate that the format of the account is correct based on the system format:
    -- ([1-5])-([1-9])-([1-9])-([1-9][1-9][1-9][1-9][1-9][1-9])
    SELECT REGEXP_SUBSTR(IN_ACCOUNT,'([1-6])-([1-9])-([1-9])-([1-9][0-9][0-9][0-9][0-9][0-9])') INTO VAR_FORMAT_VALIDATION FROM DUAL;
    
    IF VAR_FORMAT_VALIDATION IS NULL THEN
        VAR_ERROR_TRACKER := 'Account format does not match, please ensure you follow the format N-N-N-NNNNNN';
    END IF; 
    
    -- Define the final return from the procedure
    IF LENGTH(VAR_ERROR_TRACKER) > 0 THEN
        OUT_RESULT := VAR_ERROR_TRACKER;
    ELSE
        OUT_RESULT := 'Successful';
        INSERT INTO CUENTA_CONTABLE VALUES (IN_ACCOUNT,IN_ACCOUNT_DESCRIPTION,IN_ACCOUNT_CATEGORY ,0,0,0,IN_ACCOUNT_NATURE);
    END IF;    
    
END;

DECLARE
    VAR_OUTPUT  VARCHAR(255);
BEGIN
    CREATE_ACCOUNT('1-2-2-167461','Activo Fijo - Software',1,'D',VAR_OUTPUT);
    DBMS_OUTPUT.PUT_LINE(VAR_OUTPUT);
END;


SELECT * FROM CUENTA_CONTABLE WHERE ID_CUENTA = '1-2-2-167461';

SELECT * FROM CUENTA_CONTABLE;