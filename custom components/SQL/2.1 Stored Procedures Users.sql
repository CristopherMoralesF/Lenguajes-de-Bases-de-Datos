USE ASSET_MANAGEMENT; 

DROP PROCEDURE IF EXISTS VALIDATE_USER; 

DELIMITER &&

CREATE PROCEDURE VALIDATE_USER(IN VAR_USER_EMAIL VARCHAR(50), IN VAR_USER_PASSWORD VARCHAR(50))
BEGIN

	SELECT
		A.USER_ID,
		A.USER_EMAIL,
		A.USER_NAME,
		B.COMPANY_NAME
	FROM USERS A
	LEFT OUTER JOIN COMPANY B ON A.COMPANY_ID = B.COMPANY_ID; 

END &&

DELIMITER ; 

CALL VALIDATE_USER('rufo369@hotmail.es','Cris270497@');

SELECT * FROM USERS;