DROP PROCEDURE IF EXISTS spSetVoertuigInActiefByInstructeurId;

DELIMITER //

	CREATE PROCEDURE spSetVoertuigInActiefByInstructeurId(
        instructeur		INT(11)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
			UPDATE VoertuigInstructeur SET InActief = 0 WHERE InstructeurId = instructeur;
    COMMIT;
END;