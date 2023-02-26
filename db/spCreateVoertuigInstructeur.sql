DROP PROCEDURE IF EXISTS spCreateVoertuigInstructeur;

DELIMITER //

	CREATE PROCEDURE spCreateVoertuigInstructeur(
        voertuig		INT(11),
        instructeur		INT(11)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
			UPDATE VoertuigInstructeur SET IsActief = 0 WHERE VoertuigId = voertuig;
        	INSERT INTO VoertuigInstructeur (VoertuigId, InstructeurId, DatumToekenning, DatumAangemaakt, DatumGewijzigd) VALUES (voertuig, instructeur, SYSDATE(), SYSDATE(), SYSDATE());
    COMMIT;
END;