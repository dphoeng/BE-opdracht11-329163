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
		$this->db->query("SELECT * FROM `Instructeur`");
		return $this->db->resultSet();
	}
}
