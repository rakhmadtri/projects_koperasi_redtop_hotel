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
            <th style="background-color: black;color: white;">Customer</th>
            <th style="background-color: black;color: white;">Cash</th>
            <th style="background-color: black;color: white;">Kredit</th>
            <th style="background-color: black;color: white;">Total Transaksi</th>
		</tr>
		 <?php if (isset($all_penjualan)): ?>
		 <?php
		 		$cash=0;
		 		$kredit=0;
		 		$grand_total=0; 
		  ?>
                      <?php foreach ($all_penjualan as $key => $value) {
                        ?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['order_id'] ?></td>
                      <td><?php echo $value['order_timestamp'] ?></td>
                      <td><?php if($value['nama_anggota']!= null){ echo $value['nama_anggota'];}else{ echo "New Customer";} ?></td>
                      <td><?php echo str_replace(".00", "",$value['cash']) ?></td>
					  <td><?php echo str_replace(".00", "",$value['kredit']) ?></td>	
                      <td><?php echo str_replace(".00", "",$value['total_after_ppn']) ?></td>
                    </tr>
                    <?php                     
                    		$cash+=$value['cash'];
                    		$kredit+=$value['kredit'];
                    		$grand_total+=$value['total_after_ppn'];
                     ?>
                  <?php  } ?>
              <?php endif ?>
	</table>
	<br>
	<table>
		<tr>
			<th colspan="3">Grand Total</th>
			<td><?php echo $cash ?></td>
			<td><?php echo $kredit ?></td>
			<td><?php echo $grand_total ?></td>
		</tr>
	</table>
</body>
</html>