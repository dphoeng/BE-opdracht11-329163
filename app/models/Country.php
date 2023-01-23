<?php


class Country
{
	private $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function getCountries()
	{
		$this->db->query('SELECT * FROM Countries');
		return $this->db->resultSet();
	}

	public function getSingleCountry($id)
	{
		$this->db->query("SELECT * FROM Countries WHERE id = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->single();
	}

	public function updateCountry($post)
	{
		$this->db->query("UPDATE countries set Name = :name, CapitalCity = :capital, Continent = :continent, Population = :population WHERE id = :id");
		$this->db->bind(":id", $post["id"], PDO::PARAM_INT);
		$this->db->bind(":name", $post["name"], PDO::PARAM_STR);
		$this->db->bind(":capital", $post["capital"], PDO::PARAM_STR);
		$this->db->bind(":continent", $post["continent"], PDO::PARAM_STR);
		$this->db->bind(":population", $post["population"], PDO::PARAM_INT);
		return $this->db->execute();
	}

	public function deleteCountry($id)
	{
		$this->db->query("DELETE FROM `countries` WHERE id = :id");
		$this->db->bind(":id", $id, PDO::PARAM_INT);
		return $this->db->execute();
	}

	public function createCountry($post)
	{
		$this->db->query("INSERT INTO countries (id, Name, CapitalCity, Continent, Population) VALUES (:id, :name, :capital, :continent, :population)");
		$this->db->bind(":id", NULL, PDO::PARAM_INT);
		$this->db->bind(":name", $post["name"], PDO::PARAM_STR);
		$this->db->bind(":capital", $post["capital"], PDO::PARAM_STR);
		$this->db->bind(":continent", $post["continent"], PDO::PARAM_STR);
		$this->db->bind(":population", $post["population"], PDO::PARAM_INT);
		return $this->db->execute();
	}
}
