<?php
require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<h1>Les info [<?= $data["instructeurNaam"]; ?>][<?= $data["leerlingNaam"]; ?>]</h1>
	<hr>
	<table>
		<thead>
			<th>Datum</th>
			<th>Opmerking</th>
		</thead>
		<tbody>
			<?= $data["rows"]; ?>
		</tbody>
	</table>
	<a href="<?= URLROOT ?>/lessen/createOpmerking/<?= $data["id"] ?>"><button>Opmerking Toevoegen</button></a>
</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>