<?php
	header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
	header('Content-Disposition: attachment; filename=koperasi_report_top_brand.xls');
	// print_r($all_stok);
	// die();
?>
<html>
<head>
	<title></title>
<style type="text/css">
	th{
		background-color: black;
		color: white;
		font-size: 12pt;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<th style="background-color: black;color: white;">Kode Barang</th>
            <th style="background-color: black;color: white;">Nama Barang</th>
            <th style="background-color: black;color: white;">Harga Beli</th>
            <th style="background-color: black;color: white;">Harga Jual</th>
            <th style="background-color: black;color: white;">Qty</th>
            <th style="background-color: black;color: white;">Total Keuntungan</th>
		</tr>
		 <?php if (isset($all_brand)): ?>
          <?php foreach ($all_brand as $key => $value) {?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['kode_barang'] ?></td>
                      <td><?php echo $value['nama_barang'] ?></td>
                      <td><?php echo str_replace('.00', '', $value['buying_price']) ?></td>
                      <td><?php echo str_replace('.00', '', $value['selling_price']) ?></td>
                      <td><?php echo $value['qty_jual'] ?></td>
                      <td><?php echo str_replace('.00', '', $value['keuntungan']) ?></td>
                    </tr>
          <?php  } ?>
      	<?php endif ?>
	</table>
</body>
</html>