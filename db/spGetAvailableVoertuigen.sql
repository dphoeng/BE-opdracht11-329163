DROP PROCEDURE IF EXISTS spGetAvailableVoertuigen;

DELIMITER //

	CREATE PROCEDURE spGetAvailableVoertuigen()
    BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;
    
    	START TRANSACTION;
        	SELECT voe.Id AS Id, typ.TypeVoertuig, voe.Type, voe.Kenteken, voe.Bouwjaar, voe.Brandstof, typ.RijbewijsCategorie FROM Voertuig voe LEFT JOIN VoertuigInstructeur vin ON vin.VoertuigId = voe.Id INNER JOIN TypeVoertuig typ ON voe.TypeVoertuigId = typ.Id WHERE vin.Id IS NULL;
            
       	COMMIT;
	END //
DELIMITER ;