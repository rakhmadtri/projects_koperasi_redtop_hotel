<?php
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=data_customer.xls');
?>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<th>Kode Customer</th>
			<th>Nama Customer</th>
			<th>Email</th>
			<th>No telfon</th>
			<th>Alamat</th>
		</tr>
		<?php foreach ($all_customer as $key => $value): ?>
			<tr>
				<td>
					<?php echo $value['kode_customer'] ?>
				</td>
				<td>
					<?php echo $value['nama_customer'] ?>
				</td>
				<td>
					<?php echo $value['email'] ?>
				</td>
				<td>
					<?php echo $value['no_telfon'] ?>
				</td>
				<td>
					<?php echo $value['alamat'] ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>