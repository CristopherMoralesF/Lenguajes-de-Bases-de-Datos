CREATE TABLE EDIFICIO (
    ID_EDIFICIO             VARCHAR(20) PRIMARY KEY, 
    DESCRIPCION_EDIFICIO    VARCHAR(100) NOT NULL
); 

INSERT INTO EDIFICIO VALUES ('CR-1','EDIFICIO PRINCIPAL'); 
INSERT INTO EDIFICIO VALUES ('CR-2','FABRICA PRINCIPAL'); 
INSERT INTO EDIFICIO VALUES ('CR-3','BODEGAS'); 

SELECT * FROM EDIFICIO;

CREATE TABLE UBICACION(
    ID_UBICACI�N            INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY,
    ID_EDIFICIO             VARCHAR(20) NOT NULL, 
    DESCRIPCION_SECCION     VARCHAR(50),
    CONSTRAINT FK_ID_EDIFICIO FOREIGN KEY (ID_EDIFICIO) REFERENCES EDIFICIO(ID_EDIFICIO)
); 

INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-1','Nossara');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-1','Ocotal');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-1','Conchal');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-1','Uva');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-2','Ensamblaje');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-2','Prueba');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-3','Bodega A');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-3','Bodega B');
INSERT INTO UBICACION (ID_EDIFICIO,DESCRIPCION_SECCION) VALUES ('CR-3','Bodega C');

SELECT * FROM UBICACION;

CREATE TABLE USUARIO_ROLE(
    ID_ROLE                 INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY, 
    NOMBRE_ROLE             VARCHAR(50),
    DESCRIPCION_PERMISOS    VARCHAR(100)
); 

INSERT INTO USUARIO_ROLE (NOMBRE_ROLE,DESCRIPCION_PERMISOS) VALUES ('ADMIN','Permiso total');
INSERT INTO USUARIO_ROLE (NOMBRE_ROLE,DESCRIPCION_PERMISOS) VALUES ('CONTADOR','Permiso solamente a editar informaci�n contable de activos existentes');
INSERT INTO USUARIO_ROLE (NOMBRE_ROLE,DESCRIPCION_PERMISOS) VALUES ('TAGGER','Encargado de recopilar informaci�n cuantitativa del activo');

SELECT * FROM USUARIO_ROLE; 

CREATE TABLE USUARIO (
    ID_USUARIO      INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY, 
    NOMBRE          VARCHAR(50) NOT NULL, 
    CORREO          VARCHAR(50) NOT NULL, 
    USER_PASSWORD    VARCHAR(50) NOT NULL, 
    ID_ROLE         INT NOT NULL, 
    CONSTRAINT FK_ID_ROLE FOREIGN KEY (ID_ROLE) REFERENCES USUARIO_ROLE(ID_ROLE)
); 

INSERT INTO USUARIO (NOMBRE, CORREO, USER_PASSWORD, ID_ROLE) VALUES ('Cristopher Morales','cmorale@asset_management.com','Cris123@',1);
INSERT INTO USUARIO (NOMBRE, CORREO, USER_PASSWORD, ID_ROLE) VALUES ('Kimberly Morales','kmorale@asset_management.com','kim123@',2);
INSERT INTO USUARIO (NOMBRE, CORREO, USER_PASSWORD, ID_ROLE) VALUES ('Stephany Morales','smorale@asset_management.com','Fany123@',2);

SELECT * FROM USUARIO;



SELECT 
    U.NOMBRE, 
    U.CORREO, 
    U.CONTRASE�A, 
    U.ID_ROLE,
    (SELECT UR.NOMBRE_ROLE FROM USUARIO_ROLE UR WHERE UR.ID_ROLE = U.ID_ROLE) AS "NOMBRE ROLE"
FROM 
    USUARIO U;
    
CREATE TABLE CLASE (
    ID_CLASE            INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY,
    DESCRIPCION_CLASE   VARCHAR2(50)
);

INSERT INTO CLASE (DESCRIPCION_CLASE) VALUES ('Vehiculos'); 
INSERT INTO CLASE (DESCRIPCION_CLASE) VALUES ('Edificios'); 
INSERT INTO CLASE (DESCRIPCION_CLASE) VALUES ('Maquinaria y Equipo'); 
INSERT INTO CLASE (DESCRIPCION_CLASE) VALUES ('Computadoras'); 

CREATE TABLE CATEGORIA_CUENTA(
    ID_CATEGORIA            INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY, 
    DESCRIPCION_CATEGORIA   VARCHAR2(50)
);

INSERT INTO CATEGORIA_CUENTA (DESCRIPCION_CATEGORIA) VALUES ('Activos');
INSERT INTO CATEGORIA_CUENTA (DESCRIPCION_CATEGORIA) VALUES ('Pasivos');
INSERT INTO CATEGORIA_CUENTA (DESCRIPCION_CATEGORIA) VALUES ('Capital');
INSERT INTO CATEGORIA_CUENTA (DESCRIPCION_CATEGORIA) VALUES ('Ingresos');
INSERT INTO CATEGORIA_CUENTA (DESCRIPCION_CATEGORIA) VALUES ('Gastos');

CREATE TABLE CUENTA_CONTABLE(
    ID_CUENTA               VARCHAR2(15) NOT NULL PRIMARY KEY,
    DESCRIPCION_CUENTA      VARCHAR(50) NOT NULL, 
    ID_CATEGORIA            INT NOT NULL, 
    TOTAL_DEBITOS           FLOAT DEFAULT 0,
    TOTAL_CREDITOS          FLOAT DEFAULT 0, 
    BALANCE                 FLOAT DEFAULT 0,
    NATURALEZA              VARCHAR(1) NOT NULL, 
    CONSTRAINT FK_ID_CATEGORIA FOREIGN KEY (ID_CATEGORIA) REFERENCES CATEGORIA_CUENTA(ID_CATEGORIA)
)

INSERT INTO CUENTA_CONTABLE VALUES ('1-1-1-101392','Efectivo',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('2-2-1-221105','Hipoteca por pagar LP',2,0,0,0,'C');
INSERT INTO CUENTA_CONTABLE VALUES ('3-1-1-100001','Capital Socios',3,0,0,0,'C');

SELECT * FROM CUENTA_CONTABLE;

INSERT INTO CUENTA_CONTABLE VALUES ('1-2-2-167401','Activo Fijo - Vehiculos',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('1-2-2-167402','Activo Fijo - Edificio',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('1-2-2-167403','Activo Fijo - Maq y Equipo',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('1-2-2-167404','Activo Fijo - Computadoras',1,0,0,0,'D');

INSERT INTO CUENTA_CONTABLE VALUES ('1-2-3-167401','Dep Acumulada - Vehiculos',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('1-2-3-167402','Dep Acumulada - Edificio',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('1-2-3-167403','Dep Acumulada - Maq y Equipo',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('1-2-3-167404','Dep Acumulada - Computadoras',1,0,0,0,'D');


INSERT INTO CUENTA_CONTABLE VALUES ('5-2-2-167401','Gasto Depreciaci�n - Vehiculos',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('5-2-2-167402','Gasto Depreciaci�n - Edificio',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('5-2-2-167403','Gasto Depreciaci�n - Maq y Equipo',1,0,0,0,'D');
INSERT INTO CUENTA_CONTABLE VALUES ('5-2-2-167404','Gasto Depreciaci�n - Computadoras',1,0,0,0,'D');

SELECT * FROM CUENTA_CONTABLE;

CREATE TABLE ESTADO(
    ID_ESTADO           INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY, 
    DESCRIPCION_ESTADO  VARCHAR(50) NOT NULL
); 

INSERT INTO ESTADO (DESCRIPCION_ESTADO) VALUES ('Activo en Bodega');
INSERT INTO ESTADO (DESCRIPCION_ESTADO) VALUES ('Activo en Construcci�n');
INSERT INTO ESTADO (DESCRIPCION_ESTADO) VALUES ('Activo en Uso');
INSERT INTO ESTADO (DESCRIPCION_ESTADO) VALUES ('Activo Deteriorado');
INSERT INTO ESTADO (DESCRIPCION_ESTADO) VALUES ('Activo Donado');

SELECT * FROM ESTADO;

CREATE TABLE ACTIVO (
    ID_ACTIVO               INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY, 
    ID_CLASE                INT NOT NULL, 
    ID_UBICACION            INT NOT NULL, 
    ID_OWNER                INT NOT NULL, 
    ID_ESTADO               INT NOT NULL, 
    DESCRIPCION_ACTIVO      VARCHAR(50),
    VALOR_ADQUISICION       NUMBER(10,2),
    FECHA_ADQUISICION       DATE,
    CONSTRAINT FK_ID_CLASE FOREIGN KEY (ID_CLASE) REFERENCES CLASE(ID_CLASE), 
    CONSTRAINT FK_ID_UBICACION FOREIGN KEY (ID_UBICACION) REFERENCES UBICACION(ID_UBICACI�N),
    CONSTRAINT FK_ID_OWNER FOREIGN KEY (ID_OWNER) REFERENCES USUARIO(ID_USUARIO),
    CONSTRAINT FK_ID_ESTADO FOREIGN KEY (ID_ESTADO) REFERENCES ESTADO(ID_ESTADO)
);


INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,1,2,5,'Vehiculo de Carga',2500000,'26-11-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,4,1,4,'Vehiculo de Carga',2500000,'12-08-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,3,2,2,'Vehiculo de Transporte',8500000,'19-07-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,4,3,4,'Vehiculo de Carga',2500000,'05-03-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,6,2,2,'Vehiculo de Transporte',8500000,'13-04-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,8,3,1,'Vehiculo de Transporte',8500000,'10-12-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,6,3,4,'Vehiculo de Carga',2500000,'23-10-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,3,3,3,'Camioneta Carga Pesada',15000000,'04-09-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,9,3,1,'Vehiculo de Carga',2500000,'03-12-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (1,2,3,5,'Camioneta Carga Pesada',15000000,'16-06-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (2,7,3,1,'Edificio CR1',80000000,'06-03-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (2,9,3,1,'Edificio CR2',12000000,'25-03-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (2,3,2,4,'Edificio CR3',50000000,'06-03-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,6,3,5,'Conector de Puertos',1927828,'21-02-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,2,2,5,'Estacion de Trabajo',2495562,'08-07-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,7,2,1,'Unidad de Disco Duro',2539884,'19-07-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,3,3,5,'Servidor',341002,'13-01-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,9,2,1,'Computadora de Escritorio',465271,'19-01-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,6,1,2,'Equipo de Respaldo',1045209,'02-08-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,8,1,1,'Fotocopiadora',1262467,'23-05-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,1,1,3,'Equipo Almacen',1998602,'26-05-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,6,1,4,'Equipo Informatico',1155408,'09-09-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (3,3,3,5,'Osciloscopio',703717,'11-01-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,6,3,3,'DELL i5570-5235SVL',450000,'19-08-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,3,2,5,'DELL INSPIRON 13',550000,'29-12-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,3,2,3,'DEL i5570-7117SVL',750000,'20-09-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,3,2,2,'ASUS ROG STRIX',800000,'04-06-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,8,1,1,'HP 15-DA0015LA',125000,'10-10-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,2,2,2,'DELL i5570-5235SVL',450000,'19-08-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,6,3,5,'DELL INSPIRON 13',550000,'23-04-2021');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,2,3,3,'DEL i5570-7117SVL',750000,'03-07-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,2,1,4,'ASUS ROG STRIX',800000,'10-06-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,7,3,1,'HP 15-DA0015LA',125000,'11-02-2020');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,2,1,4,'LENOVO THINKPAD',950000,'10-06-2022');
INSERT INTO ACTIVO (ID_CLASE,ID_UBICACION,ID_OWNER,ID_ESTADO,DESCRIPCION_ACTIVO,VALOR_ADQUISICION,FECHA_ADQUISICION) VALUES (4,7,3,1,'LENOVO LEGION',780000,'11-02-2020');

SELECT * FROM CLASE; 
SELECT * FROM UBICACION;
SELECT * FROM USUARIO;

SELECT * FROM ACTIVO;

DROP TABLE ASIENTO_LINEA;
DROP TABLE ASIENTO;

CREATE TABLE ASIENTO (
    ID_ASIENTO      INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY,
    ID_CLASE        INT,
    FECHA           DATE NOT NULL,
    DESCRIPCI�N     VARCHAR(50) NOT NULL,
    CONSTRAINT FK_ID_ACTIVO FOREIGN KEY (ID_CLASE) REFERENCES CLASE(ID_CLASE)
);

CREATE TABLE ASIENTO_LINEA (
    ID_ASIENTO_LINEA    INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY,
    ID_ASIENTO          INT NOT NULL,
    ID_CUENTA_CONTABLE  VARCHAR2(15) NOT NULL,
    DESCRIPCION_LINEA   VARCHAR(255) NOT NULL,
    DEBITO              NUMBER(20,2) NOT NULL,
    CREDITO             NUMBER(20,2) NOT NULL,
    CONSTRAINT FK_ID_ASIENTO FOREIGN KEY (ID_ASIENTO) REFERENCES ASIENTO,
    CONSTRAINT FK_ID_CUENTA_LINEA FOREIGN KEY (ID_CUENTA_CONTABLE) REFERENCES CUENTA_CONTABLE
);

----------------------------- CREACI�N DEL ASIENTO DE CAPITAL
INSERT INTO ASIENTO (FECHA,DESCRIPCI�N) VALUES ('01/01/2022','Adquisici�n de Capital de Trabajo');

INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (1,'1-1-1-101392','Aporte en efectivo socios',100000000,0);
INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (1,'3-1-1-100001','Aporte en efectivo socios',0,100000000);



----------------------------- CREACI�N DEL ASIENTO DE ADQUISICI�N
INSERT INTO ASIENTO (ID_CLASE,FECHA,DESCRIPCI�N) VALUES (4,'01/02/2022','Adquisici�n Inicial de Activos');

INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (2,'1-2-2-167404','Compra computadoras',7080000,0);
INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (2,'1-2-2-167403','Compra maquinaria y equipo',13934950,0);
INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (2,'1-2-2-167401','Compra Vehiculos',68000000,0);
INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (2,'1-2-2-167402','Compra Edificios',142000000,0);
INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (2,'1-1-1-101392','Compra Inicial de Activos',0,89014950);
INSERT INTO ASIENTO_LINEA (ID_ASIENTO, ID_CUENTA_CONTABLE, DESCRIPCION_LINEA, DEBITO, CREDITO) VALUES (2,'2-2-1-221105','Hipoteca - Compra Inicial Terrenos',0,142000000);


CREATE TABLE TIPO_VALIDACION (
    ID_TIPO_VALIDACION  INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY,
    ID_CLASE            INT NOT NULL,
    DESCRIPCION_VALIDACION  VARCHAR(60) NOT NULL,
    CONSTRAINT FK_ID_CLASE_VALIDACION FOREIGN KEY (ID_CLASE) REFERENCES CLASE (ID_CLASE)
);

SELECT * FROM TIPO_VALIDACION;
SELECT * FROM CLASE;


INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (1,'Placa Vehiculo');
INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (1,'Modelo Vehiculo');
INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (1,'Marcha Vehiculo');
INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (1,'Descripcion Ingles');
INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (1,'A�o Vehiculo');

INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (2,'Numero Documento');

INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (3,'Placa');
INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (3,'Factura');

INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (4,'Placa');
INSERT INTO TIPO_VALIDACION(ID_CLASE,DESCRIPCION_VALIDACION) VALUES (4,'Factura');

-- En esta tabla se guardan los valores que deben ser incluidos por cada validaci�n para cada uno de los activos.
CREATE TABLE VALIDACION (
    ID_VALIDACION           INT GENERATED BY DEFAULT ON NULL AS IDENTITY PRIMARY KEY, 
    ID_TIPO_VALIDACION      INT NOT NULL,
    ID_ACTIVO               INT NOT NULL, 
    VALOR                   VARCHAR(255),
    CONSTRAINT FK_ID_TIPO_VALIDACION FOREIGN KEY (ID_TIPO_VALIDACION) REFERENCES TIPO_VALIDACION(ID_TIPO_VALIDACION),
    CONSTRAINT FK_ID_ACTIVO_VALIDACION FOREIGN KEY (ID_ACTIVO) REFERENCES ACTIVO(ID_ACTIVO)
);

INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (1,4,'CMF-024');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (2,4,'Ertiga');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (3,4,'Suzuki');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (4,4,'Car Suzuki Ertiga');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (5,4,'2022');

INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (1,5,'SMF-010');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (2,5,'Versa');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (3,5,'Nissan');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (4,5,'Car Nissan Versa');
INSERT INTO VALIDACION (ID_TIPO_VALIDACION,ID_ACTIVO,VALOR) VALUES (5,5,'2019');




