<?php

?>
<form action="<?= URLROOT; ?>/countries/create" method="post">
	<h1><?= $data['title'] ?></h1>
	<table>
		<tbody>
			<tr>
				<td>
					<label for="name">Country</label>
					<input type="text" name="name" id="name">
				</td>
			</tr>
			<tr>
				<td>
					<label for="capital">Capital</label>
					<input type="text" name="capital" id="capital">
				</td>
			</tr>
			<tr>
				<td>
					<label for="continent">Continent</label>
					<input type="text" name="continent" id="continent">
				</td>
			</tr>
			<tr>
				<td>
					<label for="population">Population</label>
					<input type="number" name="population" id="population">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="submit" id="submit" value="submit">
				</td>
			</tr>
		</tbody>
	</table>
</form>