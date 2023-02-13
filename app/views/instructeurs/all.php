<?php

require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<div>
		<h1>Door instructeur gebruikte voertuigen</h1>
		<p><?= $data['deleted'] ?></p>
	</div>

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
				<th>Instructeur naam</th>
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