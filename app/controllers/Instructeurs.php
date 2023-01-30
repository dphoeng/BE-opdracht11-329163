<?php

class Instructeurs extends Controller
{
	private $instructeurModel;

	public function __construct()
	{
		$this->instructeurModel = $this->model('Instructeur');
	}

	public function index()
	{
		$rows = '';

		// haalt de gegevens uit de database via the model
		$record = $this->instructeurModel->getInstructeurs();
		if ($record) {
			foreach ($record as $value) {
				$sterren = "";
				for ($i = 0; $i < $value->AantalSterren; $i++) {
					$sterren .= "★";
				}
				$rows .= "<tr>
									<td>$value->Voornaam</td>
									<td>$value->Tussenvoegsel</td>
									<td>$value->Achternaam</td>
									<td>$value->Mobiel</td>
									<td>$value->DatumInDienst</td>
									<td>$sterren</td>
									<td><a href='" . URLROOT . "/instructeurs/voertuigen/$value->Id'><img src='" . URLROOT . "/img/book.png' alt='book'></a></td>
							</tr>";
			}
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "aantal" => count($record),
		];
		$this->view("instructeurs/index", $data);
	}

	public function voertuigen($id = null)
	{
		$rows = '';
		$sterren = "";
		$naam = "";
		$datumInDienst = "";
		$error = "";

		$instructeur = $this->instructeurModel->getInstructeurById($id);

		if ($instructeur) {
			for ($i = 0; $i < $instructeur->AantalSterren; $i++) {
				$sterren .= "★";
			}
			$naam = $instructeur->Tussenvoegsel ? "$instructeur->Voornaam $instructeur->Tussenvoegsel $instructeur->Achternaam" : "$instructeur->Voornaam $instructeur->Achternaam";
			$datumInDienst = $instructeur->DatumInDienst;

			// haalt de gegevens uit de database via the model
			$record = $this->instructeurModel->getVoertuigenByInstructeurId($id);
			if ($record) {
				foreach ($record as $value) {

					$rows .= "<tr>
										<td>$value->TypeVoertuig</td>
										<td>$value->Type</td>
										<td>$value->Kenteken</td>
										<td>$value->Bouwjaar</td>
										<td>$value->Brandstof</td>
										<td>$value->RijbewijsCategorie</td>
								</tr>";
				}
			} else {
				$error = "Er zijn op dit moment nog geen voertuigen toegewezen aan deze instructeur";
				header("Refresh:3; url=" . URLROOT . "/instructeurs/index");
			}
		} else {
			header("Location: " . URLROOT . "/instructeurs/index");
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "aantal" => count($record), "naam" => $naam, "sterren" => $sterren, "datumInDienst" => $datumInDienst, "id" => $id, "error" => $error
		];
		$this->view("instructeurs/voertuigen", $data);
	}

	public function toevoegen($id = null)
	{
		$instructeur = $this->instructeurModel->getInstructeurById($id);

		$rows = '';
		$sterren = "";
		$naam = "";
		$datumInDienst = "";
		$error = "";

		if ($instructeur) {
			for ($i = 0; $i < $instructeur->AantalSterren; $i++) {
				$sterren .= "★";
			}
			$naam = $instructeur->Tussenvoegsel ? "$instructeur->Voornaam $instructeur->Tussenvoegsel $instructeur->Achternaam" : "$instructeur->Voornaam $instructeur->Achternaam";
			$datumInDienst = $instructeur->DatumInDienst;

			$voertuigen = $this->instructeurModel->getAvailableVoertuigen();
			if ($voertuigen) {
				foreach ($voertuigen as $value) {

					$rows .= "<tr>
										<td>$value->TypeVoertuig</td>
										<td>$value->Type</td>
										<td>$value->Kenteken</td>
										<td>$value->Bouwjaar</td>
										<td>$value->Brandstof</td>
										<td>$value->RijbewijsCategorie</td>
										<td><a href='" . URLROOT . "/instructeurs/add/$id/$value->Id" . "'><img src='" . URLROOT . "/img/cross.png" . "'></a></td>
								</tr>";
				}
			} else {
				$error = "Er zijn geen voertuigen meer over om toe te voegen";
				header("Refresh:3; url=" . URLROOT . "/instructeurs/voertuigen/$id");
			}
		} else {
			header("Location: " . URLROOT . "/instructeurs/index");
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "naam" => $naam, "sterren" => $sterren, "datumInDienst" => $datumInDienst, "id" => $id, "error" => $error
		];
		$this->view("instructeurs/toevoegen", $data);
	}

	public function add($instructeurId = null, $voertuigId = null)
	{
		if ($instructeurId == null || $voertuigId == null) {
			header("Location: " . URLROOT . "/instructeurs/index");
		}
	}
}
