DROP PROCEDURE IF EXISTS spCreateVoertuigInstructeur;

DELIMITER //

	CREATE PROCEDURE spCreateVoertuigInstructeur(
        voertuigId		INT(11),
        instructeurId	INT(11)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
        	INSERT INTO VoertuigInstructeur (VoertuigId, InstructeurId, DatumToekenning, DatumAangemaakt, DatumGewijzigd) VALUES (voertuigId, instructeurId, SYSDATE(), SYSDATE(), SYSDATE());
    COMMIT;
END;