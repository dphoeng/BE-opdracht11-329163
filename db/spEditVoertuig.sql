DROP PROCEDURE IF EXISTS spEditVoertuig;

DELIMITER //

	CREATE PROCEDURE spEditVoertuig(
        voertuig		INT(11),
        instructeur		INT(11),
        kenteken		VARCHAR(10),
        brandstof		VARCHAR(20),
        bouwjaar		DATE,
        typeVoertuigId	INT(11),
        type			VARCHAR(15)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
        	UPDATE Voertuig SET Kenteken = kenteken, Brandstof = brandstof, Bouwjaar = bouwjaar, TypeVoertuigId = typeVoertuigId, Type = type, DatumGewijzigd = SYSDATE() WHERE Id = voertuig;
            
            
			IF NOT EXISTS (SELECT * FROM VoertuigInstructeur WHERE VoertuigId = voertuig AND InstructeurId = instructeur) THEN
	            UPDATE VoertuigInstructeur SET IsActief = 0 WHERE VoertuigId = voertuig AND IsActief = 1;
	            CALL spCreateVoertuigInstructeur(voertuig, instructeur);
			END IF;
    COMMIT;
END;