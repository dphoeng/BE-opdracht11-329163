<body>
	<?= $data["title"]; ?>
	<a href="<?= URLROOT; ?>/countries/create">Nieuw record</a>
	<table>
		<thead>
			<th>Country</th>
			<th>Capital</th>
			<th>Continent</th>
			<th>Population</th>
			<th>Update</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?= $data["rows"] ?>
		</tbody>
	</table>
</body>

</html>