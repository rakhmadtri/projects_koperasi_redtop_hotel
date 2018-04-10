<?php
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=data_shu-$periode.xls");
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
			<th style="background-color: black;color: white;">NIK</th>
			<th style="background-color: black;color: white;">NAMA ANGGOTA</th>
			<th style="background-color: black;color: white;">SALDO</th>
			<th style="background-color: black;color: white;">SIMPAN</th>
			<th style="background-color: black;color: white;">EKONOMI</th>
			<th style="background-color: black;color: white;"> SHU</th>

		</tr>
        <tr>
        <?php if (isset($list_shu)): ?>
          <?php foreach ($list_shu as $key => $value) { 

            ?>
               <tr class="odd gradeX">
                <td><?php echo $value['nik'] ?></td>
                <td><?php echo $value['nama'] ?></td>
                <td><?php echo number_format($value['t_union.total_simpanan'],2) ?></td>
                <td><?php echo number_format($value['shu_simpanan'],2) ?></td>
                <td><?php echo number_format($value['shu_ekonomi'],2) ?></td>
                <td><?php echo number_format($value['grand_total_shu'],2) ?></td>
              </tr>
            <?php  } ?>
        <?php endif ?>                  
        </tr>
        <tr class="odd gradeX" style="background: #f9fb87;border: none;">
          <td colspan="2">GrandTotal</td>
          <?php if (isset($subtotal)): ?>
            <?php foreach ($subtotal as $key => $value): ?>
              <td><?php echo currency_format($value) ?></td>
            <?php endforeach ?>
          <?php endif ?>
        </tr>                 
	</table>
</body>
</html>