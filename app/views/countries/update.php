<?php

?>
<form action="<?= URLROOT; ?>/countries/update" method="post">
	<table>
		<tbody>
			<tr>
				<td>
					<input type="text" name="name" id="name" value="<?= $data["row"]->Name; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="capital" id="capital" value="<?= $data["row"]->CapitalCity; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="continent" id="continent" value="<?= $data["row"]->Continent; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<input type="number" name="population" id="population" value="<?= $data["row"]->Population; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="id" id="id" value="<?= $data["row"]->id; ?>">
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