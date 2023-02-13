DROP PROCEDURE IF EXISTS spRemoveVoertuig;

DELIMITER //

	CREATE PROCEDURE spRemoveVoertuig(
        voertuig		INT(11)
    )
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    	START TRANSACTION;
			DELETE FROM VoertuigInstructeur WHERE VoertuigId = voertuig;
			DELETE FROM Voertuig WHERE VoertuigId = voertuig;
    COMMIT;
END;