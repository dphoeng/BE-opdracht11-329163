DROP PROCEDURE IF EXISTS spSetInstructeurInActief;

DELIMITER //

	CREATE PROCEDURE spSetInstructeurInactief(
        instructeur		INT(11),
		actief			BIT(1)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
			UPDATE Instructeur SET IsActief = actief WHERE Id = instructeur;
    COMMIT;
END;