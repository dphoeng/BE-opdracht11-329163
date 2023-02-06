DROP PROCEDURE IF EXISTS spEditVoertuig;

DELIMITER //

	CREATE PROCEDURE spEditVoertuig(
        voertuigId		INT(11),
        instructeurId	INT(11),
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
        	UPDATE Voertuig SET Kenteken = kenteken, Brandstof = brandstof, Bouwjaar = bouwjaar, TypeVoertuigId = typeVoertuigId, Type = type, DatumGewijzigd = SYSDATE() WHERE Id = voertuigId;
            
            DELETE FROM VoertuigInstructeur WHERE VoertuigId = voertuigId;
            
            CALL spCreateVoertuigInstructeur(voertuigId, instructeurId);
    COMMIT;
END;