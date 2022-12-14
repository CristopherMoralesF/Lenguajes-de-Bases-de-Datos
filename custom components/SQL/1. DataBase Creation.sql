CREATE SCHEMA IF NOT EXISTS ASSET_MANAGEMENT;

USE ASSET_MANAGEMENT;

DROP TABLE IF EXISTS USERS; 
DROP TABLE IF EXISTS COMPANY; 
DROP TABLE IF EXISTS ASSET_TYPE; 
DROP TABLE IF EXISTS ASSET_LIST; 

CREATE TABLE COMPANY (
	COMPANY_ID		INT PRIMARY KEY NOT NULL, 
    COMPANY_NAME	VARCHAR(50) NOT NULL
); 

INSERT INTO COMPANY VALUES (1,'ASSET MANAGEMENT');

CREATE TABLE USERS(
	USER_ID			INT PRIMARY KEY NOT NULL,
    COMPANY_ID		INT NOT NULL,
    USER_NAME		VARCHAR(50) NOT NULL, 
    USER_LASTNAMES	VARCHAR(50) NOT NULL, 
	USER_EMAIL		VARCHAR(50) NOT NULL,
    USER_PASSWORD	VARCHAR(50) NOT NULL,
    CONSTRAINT PK_COMPANY_USERS FOREIGN KEY (COMPANY_ID) REFERENCES COMPANY(COMPANY_ID)
); 

INSERT INTO USERS VALUES (116740146,1,'Cristopher','Morales Fernandez','rufo369@hotmail.es','Cris270497@'); 

CREATE TABLE ASSET_TYPE (
	ASSET_TYPE_ID 			INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    ASSET_TYPE_DESCRIPTION 	VARCHAR(50) NOT NULL, 
    PLAQUE_REQUIRED			BOOLEAN DEFAULT FALSE, 
    SERIAL_REQUIRED			BOOLEAN DEFAULT FALSE,
    LOCATION_REQUIRED		BOOLEAN DEFAULT FALSE, 
    BRAND_REQUIRED			BOOLEAN DEFAULT FALSE
);

INSERT INTO ASSET_TYPE (ASSET_TYPE_DESCRIPTION) VALUES ('Equipment');
INSERT INTO ASSET_TYPE (ASSET_TYPE_DESCRIPTION) VALUES ('Vehicules');

SELECT * FROM ASSET_TYPE; 