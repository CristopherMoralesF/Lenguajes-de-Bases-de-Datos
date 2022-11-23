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

-- Create view to calculate the accounting equation based on the amounts posted in the journals and the GL used. 
CREATE OR REPLACE VIEW ECUACION_CONTABLE AS
    SELECT 
        CAT.DESCRIPCION_CATEGORIA AS CATEGORIA,
        SUM(AL.DEBITO - AL.CREDITO) AS TOTAL_BALANCE
    FROM ASIENTO_LINEA AL
    INNER JOIN CUENTA_CONTABLE CC ON CC.ID_CUENTA = AL.ID_CUENTA_CONTABLE
    INNER JOIN CATEGORIA_CUENTA CAT ON CAT.ID_CATEGORIA = CC.ID_CATEGORIA
    GROUP BY CAT.DESCRIPCION_CATEGORIA;
    
SELECT * FROM ECUACION_CONTABLE;