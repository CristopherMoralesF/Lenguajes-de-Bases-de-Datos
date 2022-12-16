SET SERVEROUTPUT ON; 

-- Create view to resume all the journal information. 
CREATE OR REPLACE VIEW RESUMEN_ASIENTOS AS
    SELECT 
        A.ID_ASIENTO,
        A.FECHA,
        A.DESCRIPCIÓN,
        
        -- Define la clase del activo
        CASE WHEN ID_CLASE IS NOT NULL THEN
            (SELECT C.DESCRIPCION_CLASE FROM CLASE C WHERE C.ID_CLASE = A.ID_CLASE)
        ELSE
            (SELECT 'No relacionado a activos' FROM DUAL)
        END AS DESCRIPCION_CLASE,
        
        -- Se optione el total del monto del journal
        (SELECT SUM(DEBITO) FROM ASIENTO_LINEA AL WHERE AL.ID_ASIENTO = A.ID_ASIENTO) AS TOTAL_ASIENTO
    FROM ASIENTO A
    ORDER BY A.ID_ASIENTO ASC;

SELECT * FROM RESUMEN_ASIENTOS;
SELECT * FROM RESUMEN_ASIENTOS WHERE ID_ASIENTO = 1;

-- Create view to calculate the accounting equation based on the amounts posted in the journals and the GL used. 
CREATE OR REPLACE VIEW ECUACION_CONTABLE AS
    SELECT 
        CAT.DESCRIPCION_CATEGORIA AS CATEGORIA,
        SUM(
            CASE WHEN (CC.NATURALEZA = 'D') THEN        
                AL.DEBITO - AL.CREDITO
            ELSE
                AL.CREDITO - AL.DEBITO
            END    
        ) AS TOTAL_BALANCE
    FROM ASIENTO_LINEA AL
    INNER JOIN CUENTA_CONTABLE CC ON CC.ID_CUENTA = AL.ID_CUENTA_CONTABLE
    INNER JOIN CATEGORIA_CUENTA CAT ON CAT.ID_CATEGORIA = CC.ID_CATEGORIA
    GROUP BY CAT.DESCRIPCION_CATEGORIA;
    
SELECT * FROM ECUACION_CONTABLE;

DROP VIEW RESUMEN_ASIENTO_LINEAS;

-- Create view to check the body of the journal;
CREATE OR REPLACE VIEW RESUMEN_ASIENTO_LINEAS AS
    SELECT
        AL.ID_ASIENTO_LINEA,
        AL.ID_CUENTA_CONTABLE,
        AL.DESCRIPCION_LINEA,
        AL.DEBITO,
        AL.CREDITO,
        AL.DEBITO - AL.CREDITO AS BALANCE
    FROM ASIENTO_LINEA AL;

CREATE OR REPLACE PROCEDURE RESUMEN_ASIENTO_LINEAS_BODY(
    IN_ASIENTO_ID       IN  ASIENTO.ID_ASIENTO%TYPE,
    OUT_RESUMEN_ASIENTO OUT SYS_REFCURSOR
)
AS
    C_RESUMEN_ASIENTO SYS_REFCURSOR;
BEGIN

    OPEN C_RESUMEN_ASIENTO FOR
         SELECT
            AL.ID_ASIENTO_LINEA,
            AL.ID_CUENTA_CONTABLE,
            AL.DESCRIPCION_LINEA,
            AL.DEBITO,
            AL.CREDITO,
            AL.DEBITO - AL.CREDITO AS BALANCE
        FROM ASIENTO_LINEA AL
        WHERE AL.ID_ASIENTO = IN_ASIENTO_ID;
        
    OUT_RESUMEN_ASIENTO := C_RESUMEN_ASIENTO;    
END;

------ Comprobación
DECLARE
    OUT_KPI_RESUME  SYS_REFCURSOR;
BEGIN
    RESUMEN_ASIENTO_LINEAS_BODY(1,OUT_KPI_RESUME);
    DBMS_SQL.RETURN_RESULT(OUT_KPI_RESUME);
END;    

-- Function to create a new journal when the a new asset is created. 
CREATE OR REPLACE PROCEDURE RECONOCIMIENTO_ACTIVO_NUEVO_HEADER (
    IN_ID_CLASE IN ASIENTO.ID_CLASE%TYPE,
    OUT_RESULT  OUT BOOLEAN
)
AS
    VAR_DESCRIPCION_ASIENTO ASIENTO.DESCRIPCIÓN%TYPE;
    VAR_CLASE               CLASE.DESCRIPCION_CLASE%TYPE;
    VAR_FECHA               ASIENTO.FECHA%TYPE;
BEGIN

    SELECT DESCRIPCION_CLASE INTO VAR_CLASE FROM CLASE WHERE ID_CLASE = IN_ID_CLASE;
    SELECT TO_DATE(CURRENT_DATE) INTO VAR_FECHA FROM DUAL;
    
    VAR_DESCRIPCION_ASIENTO := 'Reconocimiento activo clase: ' || VAR_CLASE || ' - ' || VAR_FECHA;
    DBMS_OUTPUT.PUT_LINE(VAR_DESCRIPCION_ASIENTO);
    
    INSERT INTO ASIENTO (ID_CLASE,FECHA,DESCRIPCIÓN) VALUES (IN_ID_CLASE,VAR_FECHA,VAR_DESCRIPCION);
    OUT_RESULT := TRUE;
    
END;

EXECUTE RECONOCIMIENTO_ACTIVO_NUEVO(1);

SELECT * FROM ASIENTO;


CREATE OR REPLACE PROCEDURE CREATE_JOURNAL_HEADER(
    IN_DESCRIPCION      IN ASIENTO.DESCRIPCIÓN%TYPE,
    OUT_ID_ASIENTO      OUT ASIENTO.ID_ASIENTO%TYPE
)
AS
BEGIN
    INSERT INTO ASIENTO (FECHA,DESCRIPCIÓN) VALUES (SYSDATE,IN_DESCRIPCION) RETURNING ID_ASIENTO INTO OUT_ID_ASIENTO;
END;


SELECT * FROM ASIENTO;












