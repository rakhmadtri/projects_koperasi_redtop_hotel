<?php
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=data_user.xls');
?>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<th>Account ID</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Keterangan</th>
			<th>Reg Date</th>
			<th>Last Login</th>
		</tr>
		<?php foreach ($all_user as $key => $value): ?>
			<tr>
				<td>
					<?php echo $value['account_id'] ?>
				</td>
				<td>
					<?php echo $value['nama'] ?>
				</td>
				<td>
					<?php echo $value['email'] ?>
				</td>
				<td>
					<?php echo $value['keterangan'] ?>
				</td>
				<td>
					<?php echo $value['regdate'] ?>
				</td>
				<td>
					<?php echo $value['lastlogin'] ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>