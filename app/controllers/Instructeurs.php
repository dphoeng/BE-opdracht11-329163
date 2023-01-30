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
				header("Refresh:3; url=" . URLROOT . "/instructeurs/index");
			}
		} else {
			header("Location: " . URLROOT . "/instructeurs/index");
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "aantal" => count($record), "naam" => $naam, "sterren" => $sterren, "datumInDienst" => $datumInDienst, "id" => $id
		];
		$this->view("instructeurs/voertuigen", $data);
	}

	public function toevoegen($id = null)
	{
		$voertuigen = $this->instructeurModel->getAvailableVoertuigen();
	}
}
