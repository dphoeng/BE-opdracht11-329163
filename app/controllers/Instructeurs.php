<?php

class Instructeurs extends Controller
{
	private $instructeurModel;

	public function __construct()
	{
		$this->instructeurModel = $this->model('Instructeur');
	}

	public function index($id = null)
	{
		$rows = '';
		$notification = '';

		if ($id) {
			if ($this->instructeurModel->setInstructeurInactief($id)) {
				$instructeur = $this->instructeurModel->getInstructeurById($id);
				$notification = $instructeur->Tussenvoegsel ? "Instructeur $instructeur->Voornaam $instructeur->Tussenvoegsel $instructeur->Achternaam is ziek/met verlof gemeld" : "Instructeur $instructeur->Voornaam $instructeur->Achternaam is ziek/met verlof gemeld";
				header("Refresh:3;url=" . URLROOT . "/instructeurs/");
			}
		}

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
									<td><a href='" . URLROOT . "/instructeurs/index/$value->Id'><img src='" . URLROOT . "/img/book.png' alt='book'></a></td>
							</tr>";
			}
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "aantal" => count($record), "notification" => $notification
		];
		$this->view("instructeurs/index", $data);
	}

	public function voertuigen($id = null, $delete = null)
	{
		$rows = "";
		$sterren = "";
		$naam = "";
		$datumInDienst = "";
		$error = "";
		$deleted = "";

		$instructeur = $this->instructeurModel->getInstructeurById($id);

		if ($delete) {
			$this->instructeurModel->removeInstructeurVoertuig($id, $delete);
			$deleted = "Het door u geselecteerde voertuig is verwijderd";
			header("Refresh:3; url=" . URLROOT . "/instructeurs/voertuigen/$id");
		}

		if ($instructeur) {
			for ($i = 0; $i < $instructeur->AantalSterren; $i++) {
				$sterren .= "★";
			}
			$naam = $instructeur->Tussenvoegsel ? "$instructeur->Voornaam $instructeur->Tussenvoegsel $instructeur->Achternaam" : "$instructeur->Voornaam $instructeur->Achternaam";
			$datumInDienst = $instructeur->DatumInDienst;
			$record = $this->instructeurModel->getVoertuigenByInstructeurId($id);

			// haalt de gegevens uit de database via the model
			if ($instructeur->IsActief == 0) {
				$error = "Instructeur ziek of met verlof";
			} else {
				if ($record) {
					foreach ($record as $value) {

						$rows .= "<tr>
											<td>$value->TypeVoertuig</td>
											<td>$value->Type</td>
											<td>$value->Kenteken</td>
											<td>$value->Bouwjaar</td>
											<td>$value->Brandstof</td>
											<td>$value->RijbewijsCategorie</td>
											<td><a href='" . URLROOT . "/instructeurs/edit/$id/$value->VoertuigId" . "'><img src='" . URLROOT . "/img/cross.png" . "'></a></td>
											<td><a href='" . URLROOT . "/instructeurs/voertuigen/$id/$value->VoertuigId" . "'><img src='" . URLROOT . "/img/cross.png" . "'></a></td>
									</tr>";
					}
				} else {
					$error = "Er zijn op dit moment nog geen voertuigen toegewezen aan deze instructeur";
					// header("Refresh:3; url=" . URLROOT . "/instructeurs/index");
				}
			}
		} else {
			header("Location: " . URLROOT . "/instructeurs/index");
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "aantal" => count($record), "naam" => $naam, "sterren" => $sterren, "datumInDienst" => $datumInDienst, "id" => $id, "error" => $error, "deleted" => $deleted
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
										<td><a href='" . URLROOT . "/instructeurs/edit/$id/$value->Id" . "'><img src='" . URLROOT . "/img/cross.png" . "'></a></td>
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
		$this->instructeurModel->createVoertuigInstructeur($voertuigId, $instructeurId);
		header("Location: " . URLROOT . "/instructeurs/voertuigen/$instructeurId");
	}

	public function edit($instructeurId = null, $id = null)
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			try {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$result = $this->instructeurModel->editVoertuig($_POST, $id);
				header("Location: " . URLROOT . "/instructeurs/voertuigen/$instructeurId");
			} catch (PDOException $e) {
				echo "Het creëeren is niet gelukt";
				echo $e;
				// header("Refresh:3; url=" . URLROOT . "/lessen/onderwerpen/" . $id);
			}
		}
		$instructeurs = $this->instructeurModel->getInstructeurs();
		$voertuig = $this->instructeurModel->getVoertuigById($id);
		$data = ["instructeurs" => $instructeurs, "voertuig" => $voertuig, "instructeurId" => $instructeurId, "id" => $id];

		$this->view("instructeurs/edit", $data);
	}

	public function all($delete = null)
	{
		$rows = $data = $error = $deleted = "";

		if ($delete) {
			$this->instructeurModel->removeVoertuig($delete);
			$deleted = "Het door u geselecteerde voertuig is verwijderd";
			header("Refresh:3; url=" . URLROOT . "/instructeurs/all");
		}

		$voertuigen = $this->instructeurModel->getAllVoertuigen();
		if ($voertuigen) {
			foreach ($voertuigen as $value) {
				if ($value->IsActief == 1)
					$voornaam = $value->Voornaam;
				else
					$voornaam = "";
				$rows .= "<tr>
							<td>$value->TypeVoertuig</td>
							<td>$value->Type</td>
							<td>$value->Kenteken</td>
							<td>$value->Bouwjaar</td>
							<td>$value->Brandstof</td>
							<td>$value->RijbewijsCategorie</td>
							<td>$voornaam</td>
							<td><a href='" . URLROOT . "/instructeurs/all/$value->Id" . "'><img src='" . URLROOT . "/img/cross.png" . "'></a></td>
						</tr>";
			}
		} else {
			$error = "Er zijn geen voertuigen beschikbaar op dit moment";
			header("Refresh:3; url=" . URLROOT . "/instructeurs");
		}
		$data = ["rows" => $rows, "error" => $error, "deleted" => $deleted];
		$this->view("instructeurs/all", $data);
	}

	private function validateAddTopicForm($data)
	{
		if (strlen($data['topic']) > 255) {
			$data['topicError'] = "De nieuwe opmerking bevat meer dan 255 karakters";
		} else if (strlen($data['topic'] < 1))
			$data['topicError'] = "De nieuwe opmerking moet text bevatten";
		return ($data);
	}
}
