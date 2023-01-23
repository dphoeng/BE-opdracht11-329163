<?php
require(APPROOT . '/views/includes/header.php');
$data = $data ?? [];

?>

<body>
	<h1>Onderwerpen Les [<?= $data["datum"]; ?>][<?= $data["tijd"]; ?>]</h1>
	<hr>
	<table>
		<thead>
			<th>Onderwerp</th>
		</thead>
		<tbody>
			<?= $data["rows"]; ?>
		</tbody>
	</table>
	<a href="<?= URLROOT ?>/lessen/createOnderwerp/<?= $data["id"] ?>"><button>Onderwerp Toevoegen</button></a>
</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>