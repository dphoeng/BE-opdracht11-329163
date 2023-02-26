<?php


class Instructeur
{
	private $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function getInstructeurs()
	{
		$this->db->query("SELECT * FROM `Instructeur` ORDER BY `AantalSterren` DESC");
		return $this->db->resultSet();
	}

	public function getVoertuigenByInstructeurId($id)
	{
		$this->db->query("SELECT voe.Kenteken, voe.Type, voe.Bouwjaar, voe.Brandstof, vin.VoertuigId, vin.InstructeurId, typ.TypeVoertuig, typ.RijbewijsCategorie, vin.IsActief FROM `Voertuig` voe INNER JOIN `VoertuigInstructeur` vin ON vin.VoertuigId = voe.Id INNER JOIN `TypeVoertuig` typ ON typ.Id = voe.TypeVoertuigId WHERE vin.InstructeurId = :id ORDER BY typ.RijbewijsCategorie");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->resultSet();
	}

	public function getInstructeurById($id)
	{
		$this->db->query("SELECT * FROM `Instructeur` WHERE `Id` = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->single();
	}

	public function getAvailableVoertuigen()
	{
		$this->db->query("CALL spGetAvailableVoertuigen()");
		return $this->db->resultSet();
	}

	public function createVoertuigInstructeur($voertuigId, $instructeurId)
	{
		$this->db->query("CALL spCreateVoertuigInstructeur($voertuigId, $instructeurId)");
		$this->db->execute();
	}

	public function getVoertuigById($id)
	{
		$this->db->query("SELECT * FROM `Voertuig` voe INNER JOIN `TypeVoertuig` typ ON typ.Id = voe.TypeVoertuigId LEFT JOIN `VoertuigInstructeur` vin ON vin.VoertuigId = voe.Id WHERE voe.Id = :id AND (vin.IsActief = 1 OR vin.IsActief IS NULL)");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->single();
	}

	public function editVoertuig($post, $id)
	{
		var_dump($post);
		var_dump($id);
		// $this->db->query("UPDATE `Voertuig` SET `Kenteken` = :kenteken, `Brandstof` = :brandstof, `Bouwjaar` = :bouwjaar, `TypeVoertuigId` = :typeVoertuigId, `Type` = :type WHERE `Id` = :id");
		// $this->db->query("CALL spEditVoertuig(:voertuigId, :instructeurId, :kenteken, :brandstof, :bouwjaar, :typeVoertuigId, :type");
		// $this->db->bind(":voertuigId", $id, PDO::PARAM_INT);
		// $this->db->bind(":instructeurId", $post['instructeur'], PDO::PARAM_INT);
		// $this->db->bind(":kenteken", $post['kenteken'], PDO::PARAM_STR);
		// $this->db->bind(":brandstof", $post['brandstof'], PDO::PARAM_STR);
		// $this->db->bind(":bouwjaar", $post['bouwjaar'], PDO::PARAM_STR);
		// $this->db->bind(":typeVoertuigId", $post['typeVoertuig'], PDO::PARAM_INT);
		// $this->db->bind(":type", $post['type'], PDO::PARAM_STR);
		$this->db->query("CALL spEditVoertuig($id, {$post['instructeur']}, '{$post['kenteken']}', '{$post['brandstof']}', '{$post['bouwjaar']}', {$post['typeVoertuig']}, '{$post['type']}')");
		return $this->db->execute();
	}

	public function getAllVoertuigen()
	{
		$this->db->query("SELECT TypeVoertuig, Type, Kenteken, Bouwjaar, Brandstof, RijbewijsCategorie, Voornaam, voe.Id, ins.IsActief FROM `Voertuig` voe LEFT JOIN `VoertuigInstructeur` vin ON voe.Id = vin.VoertuigId LEFT JOIN `TypeVoertuig` typ ON voe.TypeVoertuigId = typ.Id LEFT JOIN `Instructeur` ins ON ins.Id = vin.InstructeurId ORDER BY voe.Bouwjaar DESC, ins.Voornaam ASC");
		return $this->db->resultSet();
	}

	public function removeInstructeurVoertuig($instructeurId, $voertuigId)
	{
		$this->db->query("CALL spRemoveInstructeurVoertuig(:voertuigId, :instructeurId);");
		$this->db->bind(":voertuigId", $voertuigId, PDO::PARAM_INT);
		$this->db->bind(":instructeurId", $instructeurId, PDO::PARAM_INT);
		return $this->db->execute();
	}

	public function removeVoertuig($voertuigId)
	{
		$this->db->query("CALL spRemoveVoertuig(:voertuigId);");
		$this->db->bind(":voertuigId", $voertuigId, PDO::PARAM_INT);
		return $this->db->execute();
	}

	public function setInstructeurInactief($id, $active)
	{
		$this->db->query("CALL spSetInstructeurInactief(:instructeurId, :active);");
		$this->db->bind(":instructeurId", $id, PDO::PARAM_INT);
		$this->db->bind(":active", $active, PDO::PARAM_INT);
		return $this->db->execute();
	}
}
