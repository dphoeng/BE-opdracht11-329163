<?php

class Lessen extends Controller
{
	private $lesModel;

	public function __construct()
	{
		$this->lesModel = $this->model('Les');
	}

	public function index($id = null)
	{
		$rows = '';
		$instructeur = '';

		if ($id) {
			// haalt de gegevens uit de database via the model
			$record = $this->lesModel->getLesByInstructeur($id);
			if ($record) {
				foreach ($record as $value) {
					$d = new DateTimeImmutable($value->Datum, new DateTimeZone('Europe/Amsterdam'));
					$rows .= "<tr>
									<td>{$d->format('d-m-Y')}</td>
									<td>{$d->format('H:i:s')}</td>
									<td>$value->Leerling</td>
									<td><a href='" . URLROOT . "/lessen/lesinfo/$value->Id'><img src='" . URLROOT . "/img/question.png' alt='question'></a></td>
									<td><a href='" . URLROOT . "/lessen/onderwerpen/$value->Id'><img src='" . URLROOT . "/img/book.png' alt='book'></a></td>
							</tr>";
					$instructeur = $value->Instructeur;
				}
			}
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "instructeur" => $instructeur
		];
		$this->view("lessen/index", $data);
	}

	public function onderwerpen($id = null)
	{
		// retrieve out of onderwerpen table NOT les table
		$record = $this->lesModel->getOnderwerpByLesId($id);

		$rows = '';
		$datum = '';
		$tijd = '';

		if ($record) {
			$d = new DateTimeImmutable($record[0]->Datum, new DateTimeZone('Europe/Amsterdam'));

			foreach ($record as $value) {
				$rows .= "<tr>
							<td>$value->Onderwerp</td>
					</tr>";
				$d = new DateTimeImmutable($value->Datum, new DateTimeZone('Europe/Amsterdam'));
				$datum = $d->format('d-m-Y');
				$tijd = $d->format('H:i:s');
			}
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"rows" => $rows, "datum" => $datum, "tijd" => $tijd, "id" => $id
		];


		$this->view("lessen/onderwerpen", $data);
	}

	public function lesInfo($id = null)
	{
		$record = $this->lesModel->getLesInfoById($id);
		$rows = '';
		$leerNaam = '';
		$instNaam = '';

		if ($record) {
			foreach ($record as $value) {
				$rows .= "<tr>
							<td>$value->Datum</td>
							<td>$value->Opmerking</td>
						</tr>";
			}
			$leerNaam = $record[0]->LeerlingNaam;
			$instNaam = $record[0]->InstructeurNaam;
		}

		$data = ["rows" => $rows, "instructeurNaam" => $instNaam, "leerlingNaam" => $leerNaam, "id" => $id];

		$this->view("lessen/lesinfo", $data);
	}

	public function createOnderwerp($id = null)
	{
		$data = ["id" => $id, "topicError" => ''];

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			try {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$data = ["id" => $id, "topicError" => '', "topic" => $_POST['onderwerp']];

				$data = $this->validateAddTopicForm($data);

				if (empty($data['topicError'])) {
					$result = $this->lesModel->createOnderwerp($_POST, $id);
					$instructeur = $this->lesModel->getInstructeurByLesId($id)->InstructeurId;
					if ($result)
						echo "Het nieuwe onderwerp is succesvol toegevoegd";
					else
						echo "Het nieuwe onderwerp is niet succesvol toegevoegd";
					header("Refresh:3; url=" . URLROOT . "/lessen/$instructeur");
				} else {
					header("Refresh:3; url=" . URLROOT . "/lessen/createOnderwerp/" . $id);
				}
			} catch (PDOException $e) {
				echo "Het creëeren is niet gelukt";
				echo $e;
				// header("Refresh:3; url=" . URLROOT . "/lessen/onderwerpen/" . $id);
			}
		}
		$this->view("lessen/createOnderwerp", $data);
	}

	public function createOpmerking($id = null)
	{
		$data = ["id" => $id, "topicError" => ''];

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			try {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$data = ["id" => $id, "topicError" => '', "topic" => $_POST['opmerking']];

				$data = $this->validateAddTopicForm($data);

				if (empty($data['topicError'])) {
					$result = $this->lesModel->createOpmerking($_POST, $id);
					$instructeur = $this->lesModel->getInstructeurByLesId($id)->InstructeurId;
					if ($result)
						echo "De nieuwe opmerking is succesvol toegevoegd";
					else
						echo "De nieuwe opmerking is niet succesvol toegevoegd";
					header("Refresh:3; url=" . URLROOT . "/lessen/$instructeur");
				} else {
					header("Refresh:3; url=" . URLROOT . "/lessen/createOpmerking/" . $id);
				}
			} catch (PDOException $e) {
				echo "Het creëeren is niet gelukt";
				echo $e;
				// header("Refresh:3; url=" . URLROOT . "/lessen/onderwerpen/" . $id);
			}
		}
		$this->view("lessen/createOpmerking", $data);
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
