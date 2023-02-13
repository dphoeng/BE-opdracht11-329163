DROP PROCEDURE IF EXISTS spRemoveInstructeurVoertuig;

DELIMITER //

	CREATE PROCEDURE spRemoveInstructeurVoertuig(
        voertuig		INT(11),
        instructeur		INT(11),
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
			DELETE FROM VoertuigInstructeur WHERE VoertuigId = voertuig AND InstructeurId = instructeur;
    COMMIT;
END;