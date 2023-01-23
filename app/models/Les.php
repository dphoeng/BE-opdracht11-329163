<?php


class Les
{
	private $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function getLesInfoById($id)
	{
		$this->db->query("SELECT ins.Naam AS InstructeurNaam, lee.Naam AS LeerlingNaam, opm.Opmerking AS Opmerking, les.Datum AS Datum FROM `Les` as les INNER JOIN `Opmerking` AS opm ON Les.Id = opm.LesId INNER JOIN `Leerling` as lee ON lee.Id = les.LeerlingId INNER JOIN `Instructeur` AS ins ON ins.Id = les.InstructeurId  WHERE les.Id = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->resultSet();
	}

	public function getLesByInstructeur($id)
	{
		$this->db->query("SELECT Les.Id, Les.Datum, lrl.Naam AS 'Leerling', ins.Naam AS 'Instructeur' FROM `Les` INNER JOIN `Leerling` lrl ON lrl.Id = Les.LeerlingId INNER JOIN `Instructeur` ins ON ins.Id = Les.InstructeurId WHERE InstructeurId = $id;");
		return $this->db->resultSet();
	}

	public function getInstructeurByLesId($id)
	{
		$this->db->query("SELECT InstructeurId FROM Les WHERE Id = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->single();
	}

	public function getLesById($id)
	{
		$this->db->query("SELECT * FROM `Les` WHERE Id = $id;");
		return $this->db->resultSet();
	}

	public function getSingleLes($id)
	{
		$this->db->query("SELECT * FROM Les WHERE id = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->single();
	}

	public function getOnderwerpByLesId($id)
	{
		$this->db->query("SELECT Les.Datum, ond.Onderwerp FROM Onderwerp ond JOIN Les ON Les.Id = ond.LesId WHERE `LesId` = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->resultSet();
	}

	public function createOnderwerp($post, $id)
	{
		$this->db->query("INSERT INTO `Onderwerp` (Id, LesId, Onderwerp) VALUES (:Id, :LesId, :Onderwerp)");
		$this->db->bind(":Id", NULL, PDO::PARAM_INT);
		$this->db->bind(":LesId", $id, PDO::PARAM_INT);
		$this->db->bind(":Onderwerp", $post["onderwerp"], PDO::PARAM_STR);
		return $this->db->execute();
	}

	public function createOpmerking($post, $id)
	{
		$this->db->query("INSERT INTO `Opmerking` (Id, LesId, Opmerking) VALUES (:Id, :LesId, :Opmerking)");
		$this->db->bind(":Id", NULL, PDO::PARAM_INT);
		$this->db->bind(":LesId", $id, PDO::PARAM_INT);
		$this->db->bind(":Opmerking", $post["opmerking"], PDO::PARAM_STR);
		return $this->db->execute();
	}
}
