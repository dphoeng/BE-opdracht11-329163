<?php

require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<h1>Overzicht Lessen [<?= $data["instructeur"]; ?>]</h1>
	<table>
		<thead>
			<th>Datum</th>
			<th>Tijd</th>
			<th>Leerling</th>
			<th>Lesinfo</th>
			<th>Onderwerpen</th>
		</thead>
		<tbody>
			<?= $data["rows"]; ?>
		</tbody>
	</table>
</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>