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
    FROM ASIENTO A;

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

CREATE OR REPLACE PROCEDURE RESUMEN_ASIENTO_LINEAS(
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
    RESUMEN_ASIENTO_LINEAS(1,OUT_KPI_RESUME);
    DBMS_SQL.RETURN_RESULT(OUT_KPI_RESUME);
END;    



