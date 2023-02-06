<?php

require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<h1>Wijzigen voertuiggegevens</h1>
	<form action="<?= URLROOT; ?>/instructeurs/edit" method="post" id="editform">
		<div>
			<label for="instructeur">Instructeur</label>
			<select name="instructeur" id="instructeur">
				<option value="" selected disabled>Kies optie</option>
				<?php foreach ($data['instructeurs'] as $instructeur) : ?>
					<option value="<?= $instructeur->Id ?>"><?= $instructeur->Tussenvoegsel ? "$instructeur->Voornaam $instructeur->Tussenvoegsel $instructeur->Achternaam" : "$instructeur->Voornaam $instructeur->Achternaam" ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			<label for="typeVoertuig">Type Voertuig:</label>
			<select name="typeVoertuig" id="voertuig">
				<option value="1" <?php if ($data['voertuig']->TypeVoertuig == "Personenauto") echo "selected" ?>>Personenauto</option>
				<option value="2" <?php if ($data['voertuig']->TypeVoertuig == "Vrachtwagen") echo "selected" ?>>Vrachtwagen</option>
				<option value="3" <?php if ($data['voertuig']->TypeVoertuig == "Bus") echo "selected" ?>>Bus</option>
				<option value="4" <?php if ($data['voertuig']->TypeVoertuig == "Bromfiets") echo "selected" ?>>Bromfiets</option>
			</select>
		</div>
		<div>
			<label for="type">Type:</label>
			<input type="text" name="type" value="<?= $data['voertuig']->Type ?>">
		</div>
		<div>
			<label for="bouwjaar">Bouwjaar:</label>
			<input type="date" name="bouwjaar" value="<?= $data['voertuig']->Bouwjaar ?>">
		</div>
		<div>
			<label for="brandstof">Brandstof:</label>
			<input type="radio" name="brandstof" value="diesel" <?php if ($data['voertuig']->Brandstof == "Diesel") echo "checked" ?>><label for="diesel">Diesel</label>
			<input type="radio" name="brandstof" value="benzine" <?php if ($data['voertuig']->Brandstof == "Benzine") echo "checked" ?>><label for="benzine">Benzine</label>
			<input type="radio" name="brandstof" value="elektrisch" <?php if ($data['voertuig']->Brandstof == "Elektrisch") echo "checked" ?>><label for="electrisch">Electrisch</label>
		</div>
		<div>
			<label for="kenteken">Kenteken</label>
			<input type="text" name="kenteken" value="<?= $data['voertuig']->Kenteken ?>">
		</div>
		<button type="submit" form="editform" value="submit">Wijzig</button>


	</form>

</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>