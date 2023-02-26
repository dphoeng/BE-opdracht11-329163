DROP PROCEDURE IF EXISTS spReassignVoertuig;

DELIMITER //

	CREATE PROCEDURE spReassignVoertuig(
        voertuig		INT(11)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
	        DELETE FROM VoertuigInstructeur WHERE VoertuigId = voertuig AND IsActief = 1;
			UPDATE VoertuigInstructeur SET IsActief = 1 WHERE VoertuigId = voertuig;
    COMMIT;
END;