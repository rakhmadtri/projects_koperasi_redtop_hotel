<?php
	header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
	header('Content-Disposition: attachment; filename=koperasi_export_hutang_anggota_xls_view.xls');
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
	}
</style>
</head>
<body>
	<table>
		<tr>
			<th style="background-color: black;color: white;">NO.ANGGOTA</th>
            <th style="background-color: black;color: white;">NIK</th>
            <th style="background-color: black;color: white;">NAMA</th>
            <th style="background-color: black;color: white;">NAMA DEPARTEMEN</th>
            <th style="background-color: black;color: white;">P.KOPERASI</th>
            <th style="background-color: black;color: white;">P.BELANJA</th>
            <th style="background-color: black;color: white;">IURAN</th>
            <th style="background-color: black;color: white;">TOTAL</th>
            <th style="background-color: black;color: white;">JATUH TEMPO</th>
		</tr>
		<?php if (isset($list_hutang_anggota)): ?>
		<?php foreach ($list_hutang_anggota as $key => $value)
		{ ?>
        <tr>
          <td>'<?php echo $value['no_anggota'] ?></td>
          <td>'<?php echo $value['nik'] ?></td>
          <td><?php echo $value['nama'] ?></td>
          <td><?php echo $value['nama_departemen'] ?></td>
          <td><?php echo str_replace(".00", "", $value['pinjaman_koperasi']) ?></td>
          <td><?php echo str_replace(".00", "", $value['pinjaman_belanja']) ?></td>
          <td><?php echo str_replace(".00", "", $value['iuran']) ?></td>
          <td><?php echo str_replace(".00", "", $value['total']) ?></td>
          <td><?php echo $value['jatuh_tempo'] ?></td>
        </tr>
			<?php  } ?>
		<?php endif ?>
	</table>
</body>
</html>