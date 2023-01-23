<?php

require(APPROOT . '/views/includes/header.php');

$data = $data ?? [];

?>

<body>
	<h1>Onderwerp Toevoegen</h1>
	<hr>
	<form action="<?= URLROOT; ?>/lessen/createOnderwerp/<?= $data["id"] ?>" method="post" class="onderwerp-form">
		<label for="onderwerp">Onderwerp</label>
		<input type="text" name="onderwerp" id="onderwerp" maxlength="255">
		<div class="topicError"><?= $data['topicError']; ?></div>
		<input type="submit" name="submit" id="submit" value="submit">
	</form>
</body>

<?php

require(APPROOT . '/views/includes/footer.php');

?>