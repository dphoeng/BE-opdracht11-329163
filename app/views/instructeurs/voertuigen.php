<?php

require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<h1>Door instructeur gebruikte voertuigen</h1>
	<h2>Naam: <?= $data['naam']; ?></h2>
	<h2>Datum in dienst: <?= $data['datumInDienst']; ?></h2>
	<h2>Aantal sterren: <?= $data['sterren']; ?></h2>
	<a href="<?= URLROOT . "/instructeurs/toevoegen/" . $data['id'] ?>"><button>Toevoegen Voertuig</button></a>
	<?php if ($data['rows'] != '') {
		echo "
			<table>
			<thead>
				<th>Type Voertuig</th>
				<th>Type</th>
				<th>Kenteken</th>
				<th>Bouwjaar</th>
				<th>Brandstof</th>
				<th>Rijbewijscategorie</th>
				<th>Wijzigen</th>
				<th>Verwijderen</th>
			</thead>
			<tbody>
				{$data['rows']}
			</tbody>
		</table>";
	} else {
		echo "<h3>{$data['error']}</h3>";
	} ?>

</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>