<?php

require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<h1>Wijzigen voertuiggegevens</h1>
	<form action="">
		<div>
			<label for="instructeur">Instructeur</label>
			<select name="instructeur" id="instructeur">
				<?php foreach ($data as $instructeur) : ?>
					<option value="<?= $instructeur->Id ?>"><?= $instructeur->Tussenvoegsel ? "$instructeur->Voornaam $instructeur->Tussenvoegsel $instructeur->Achternaam" : "$instructeur->Voornaam $instructeur->Achternaam" ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			<label for="typeVoertuig">Type Voertuig:</label>
			<select name="voertuig" id="voertuig">
				<option value="1" <?php if ($data['voertuig']->TypeVoertuig == "Personenauto") echo "selected" ?>>Personenauto</option>
				<option value="2" <?php if ($data['voertuig']->TypeVoertuig == "Vrachtwagen") echo "selected" ?>>Vrachtwagen</option>
				<option value="3" <?php if ($data['voertuig']->TypeVoertuig == "Bus") echo "selected" ?>>Bus</option>
				<option value="4" <?php if ($data['voertuig']->TypeVoertuig == "Bromfiets") echo "selected" ?>>Bromfiets</option>
			</select>
		</div>
		<div>
			<label for="type">Type:</label>
			<input type="text" value="<?= $data['voertuig']->Type ?>">
		</div>

	</form>

</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>