DROP PROCEDURE IF EXISTS spDeleteInstructeur;

DELIMITER //

	CREATE PROCEDURE spDeleteInstructeur(
        instructeur		INT(11)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
			DELETE FROM VoertuigInstructeur WHERE InstructeurId = instructeur;
			DELETE FROM Instructeur WHERE Id = instructeur;
    COMMIT;
END;