<?php
	header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
	header('Content-Disposition: attachment; filename=koperasi_report_transaksi_penjualan.xls');
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
			<th style="background-color: black;color: white;">Order ID</th>
            <th style="background-color: black;color: white;">Timestamp</th>
            <th style="background-color: black;color: white;">Supplier</th>
            <th style="background-color: black;color: white;">Total Items</th>
            <th style="background-color: black;color: white;">Total Transaksi</th>
            <th style="background-color: black;color: white;">Status</th>
		</tr>
		 <?php if (isset($all_pembelian)): ?>
		 <?php
		 		$grand_total=0; 
		  ?>
                      <?php foreach ($all_pembelian as $key => $value) {
                        ?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['order_id'] ?></td>
                      <td><?php echo $value['order_timestamp'] ?></td>
                      <td><?php echo $value['nama_supplier'] ?></td>
                      <td></td>
                      <td><?php echo str_replace(".00", "",$value['total_transaksi']) ?></td>
                      <td><?php echo $value['status'] ?></td>
                    </tr>
                    <?php                     
                    		$grand_total+=$value['total_transaksi'];
                     ?>
                  <?php  } ?>
              <?php endif ?>
	</table>
	<br>
	<table>
		<tr>
			<th colspan="4">Grand Total</th>

			<td><?php echo $grand_total ?></td>
		</tr>
	</table>
</body>
</html>