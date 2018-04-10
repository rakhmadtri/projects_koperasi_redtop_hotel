<?php
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=data_anggota.xls');
?>
<html>
<head>
	<title></title>
<style type="text/css">
	th{
		background-color: black;
		color: white;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<th style="background-color: black;color: white;">NO ANGGOTA</th>
			<th style="background-color: black;color: white;">NIK</th>
            <th style="background-color: black;color: white;">NAMA ANGGOTA</th>
			<th style="background-color: black;color: white;">DEPARTEMEN</th>
			<th style="background-color: black;color: white;">JABATAN</th>
			<th style="background-color: black;color: white;">ALAMAT</th>
			<th style="background-color: black;color: white;">NO TELPON</th>
            <th style="background-color: black;color: white;">NO REKENING</th>
            <th style="background-color: black;color: white;">CREATED TIME</th>
		</tr>
		<?php if (isset($all_anggota)): ?>
		<?php foreach ($all_anggota as $key => $value)
		{ ?>
        <tr>
			<td><?php echo $value['no_anggota'] ?></td>
			<td>'<?php echo $value['nik'] ?></td>
			<td><?php echo $value['nama'] ?></td>
			<td><?php echo $value['nama_departemen'] ?></td>
			<td><?php echo $value['nama_jabatan'] ?></td>
			<td><?php echo $value['alamat'] ?></td>
			<td>'<?php echo $value['no_telpon'] ?></td>
			<td>'<?php echo $value['no_rekening'] ?></td>
			<td><?php echo $value['created_time'] ?></td>
        </tr>
			<?php  } ?>
		<?php endif ?>
	</table>
</body>
</html>