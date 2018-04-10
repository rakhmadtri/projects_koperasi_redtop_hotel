<?php
	$date=date("mY");
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=data_cicilan_$date.xls");
?>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<th>Kode Barang</th>
			<th>Category</th>
			<th>Nama Barang</th>
			<th>Deskripsi</th>
			<th>Created Time</th>
		</tr>
		<?php if (isset(var)): ?>
			<?php foreach ($all_product as $key => $value): ?>
				<tr>
					<td>
						<?php echo $value['kode_barang'] ?>
					</td>
					<td>
						<?php echo $value['category'] ?>
					</td>
					<td>
						<?php echo $value['nama_barang'] ?>
					</td>
					<td>
						<?php echo $value['deskripsi'] ?>
					</td>
					<td>
						<?php echo $value['created_timestamp'] ?>
					</td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</table>
</body>
</html>