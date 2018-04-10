<?php
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=data_barang.xls');
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
			<th style="background-color: black;color: white;"> KODE BARANG</th>
            <th style="background-color: black;color: white;">NAMA BARANG</th>
            <th style="background-color: black;color: white;">DESKRIPSI</th>
            <th style="background-color: black;color: white;">KEUNTUNGAN</th>
            <th style="background-color: black;color: white;">CREATED TIME</th>
		</tr>
		<?php if (isset($all_product)): ?>
		<?php foreach ($all_product as $key => $value)
		{ ?>
        <tr>
          <td>'<?php echo $value['kode_barang'] ?></td>
          <td><?php echo $value['nama_barang'] ?></td>
          <td><?php echo $value['deskripsi'] ?></td>
          <td><?php echo str_replace(".00", "", $value['presentase']) ?></td>
          <td><?php echo $value['created_timestamp'] ?></td>
        </tr>
			<?php  } ?>
		<?php endif ?>
	</table>
</body>
</html>