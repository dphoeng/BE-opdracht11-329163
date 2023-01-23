<?php

require(APPROOT . '/views/includes/header.php');

$data = $data ?? [];

?>

<body>
	<h1>Opmerking Toevoegen</h1>
	<hr>
	<form action="<?= URLROOT; ?>/lessen/createOpmerking/<?= $data["id"] ?>" method="post" class="onderwerp-form">
		<label for="opmerking">Opmerking</label>
		<input type="text" name="opmerking" id="opmerking" maxlength="255">
		<div class="topicError"><?= $data['topicError']; ?></div>
		<input type="submit" name="submit" id="submit" value="submit">
	</form>
</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>