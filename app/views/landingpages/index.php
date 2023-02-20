<?php

require(APPROOT . '/views/includes/header.php');

$data = $data ?? [];

?>

<?= $data['sumText']; ?>

<?php

require(APPROOT . '/views/includes/footer.php');

?>