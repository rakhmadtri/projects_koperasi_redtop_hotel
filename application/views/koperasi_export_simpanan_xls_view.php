<?php
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=data_simpanan.xls');
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
			<th style="background-color: black;color: white;">KODE</th>
            <th style="background-color: black;color: white;">TIMESTAMP</th>
			<th style="background-color: black;color: white;">NO ANGGOTA</th>
			<th style="background-color: black;color: white;">NAMA</th>
			<th style="background-color: black;color: white;">JENIS SIMPANAN</th>
			<th style="background-color: black;color: white;">JUMLAH</th>
		</tr>
		<?php if (isset($all_simpanan)): ?>
		<?php foreach ($all_simpanan as $key => $value)
		{ ?>
        <tr>
			<td><?php echo $value['kode_simpanan_detail'] ?></td>
			<td><?php echo $value['tgl_simpan'] ?></td>
			<td><?php echo $value['no_anggota'] ?></td>
			<td><?php echo $value['nama'] ?></td>
			<td><?php echo $value['nama_simpanan'] ?></td>
		    <td><?php echo str_replace(".00", "", $value['jumlah_simpanan']) ?></td>
        </tr>
			<?php  } ?>
		<?php endif ?>
	</table>
</body>
</html>