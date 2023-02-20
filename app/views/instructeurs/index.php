<?php

require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<h1>Instructeurs in dienst</h1>
	<h2>Aantal instructeurs: <?= $data['aantal']; ?></h2>
	<p><?= $data['notification']; ?></p>
	<table>
		<thead>
			<th>Voornaam</th>
			<th>Tussenvoegsel</th>
			<th>Achternaam</th>
			<th>Mobiel</th>
			<th>Datum in dienst</th>
			<th>Aantal sterren</th>
			<th>Voertuigen</th>
			<th>Ziekte/Verlof</th>
		</thead>
		<tbody>
			<?= $data["rows"]; ?>
		</tbody>
	</table>
</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>