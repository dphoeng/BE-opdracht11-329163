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
		$this->db->query("SELECT * FROM `Voertuig` voe INNER JOIN `VoertuigInstructeur` vin ON vin.VoertuigId = voe.Id INNER JOIN `TypeVoertuig` typ ON typ.Id = voe.TypeVoertuigId WHERE vin.InstructeurId = :id ORDER BY typ.RijbewijsCategorie");
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
		$this->db->query("SELECT * FROM `Voertuig` voe INNER JOIN `TypeVoertuig` typ ON typ.Id = voe.TypeVoertuigId LEFT JOIN `VoertuigInstructeur` vin ON vin.VoertuigId = voe.Id WHERE voe.Id = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->single();
	}

	public function editVoertuig($post, $id)
	{
		var_dump($post);
		// $this->db->query("UPDATE `Voertuig` SET `Kenteken` = :kenteken, `Brandstof` = :brandstof, `Bouwjaar` = :bouwjaar, `TypeVoertuigId` = :typeVoertuigId, `Type` = :type WHERE `Id` = :id");
		$this->db->query("CALL spEditVoertuig(:voertuigId, :instructeurId, :kenteken, :brandstof, :bouwjaar, :typeVoertuigId, :type");
		$this->db->bind(":voertuigId", $id, PDO::PARAM_INT);
		$this->db->bind(":instructeurId", $post['instructeur'], PDO::PARAM_INT);
		$this->db->bind(":kenteken", $post['kenteken'], PDO::PARAM_STR);
		$this->db->bind(":brandstof", $post['brandstof'], PDO::PARAM_STR);
		$this->db->bind(":bouwjaar", $post['bouwjaar'], PDO::PARAM_STR);
		$this->db->bind(":typeVoertuigId", $post['typeVoertuig'], PDO::PARAM_INT);
		$this->db->bind(":type", $post['type'], PDO::PARAM_STR);
		return $this->db->execute();
	}
}
