<?php
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=koperasi_export_stok_xls_view.xls');
	// print_r($all_stok);
	// die();
?>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<th>KODE BARANG</th>
			<th>NAMA BARANG</th>
			<th>HARGA</th>
			<th>STOK</th>
			<th>STOK OPNAME</th>
			<th>KETERANGAN</th>
		</tr>
		<?php foreach ($all_stok as $key => $value): ?>
			<tr>
				<td>
					'<?php echo $value['kode_barang'] ?>
				</td>
				<td>
					<?php echo $value['nama_barang'] ?>
				</td>
				<td>
					<?php echo $value['harga_jual'] ?>
				</td>
				<td>
					<?php echo $value['qty'] ?>
				</td>
				<td></td>
				<td></td>
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>