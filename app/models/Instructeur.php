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

	public function getVoertuigenById($id)
	{
		$this->db->query("SELECT * FROM `Voertuig` voe INNER JOIN `TypeVoertuig` typ ON typ.Id = voe.TypeVoertuigId WHERE voe.Id = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->single();
	}
}
