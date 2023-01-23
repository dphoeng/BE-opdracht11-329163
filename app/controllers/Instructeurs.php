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
}
