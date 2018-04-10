<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<style type="text/css">
	#page-wrap { width: 800px; margin: 0;margin:  auto; margin-top: 50px }
</style>
</head>

<body>

	<div id="page-wrap">
		<table width="801" style="border:1px solid" height="271">
		  <tr>
		    <td width="130" rowspan="7" style="border-right:1px solid"><img src="<?php echo base_url(); ?>asset/logo-kwitansi.png" width="115" height="271" /></td>
		    <td width="200" style="border-bottom:1px solid">No Invoice. &nbsp<?php echo $detail_kwitansi[0]['no_invoice'] ?></td>
		    <td colspan="2" ></td>
		  </tr>
		  <tr>
		    <td>Telah Terima Dari </td>
		    <td colspan="2" style="border-bottom:1px solid"><?php echo $detail_kwitansi[0]['nama_cabang'] ?></td>
		  </tr>
		  <tr>
		    <td>Uang Sejumlah </td>
		    <td colspan="2" style="border-bottom:1px solid">Rp.<?php echo Terbilang($detail_kwitansi[0]['payment_amount'])?></td>
		  </tr>
		  <tr>
		    <td>Untuk Pembayaran </td>
		    <td colspan="2" style="border-bottom:1px solid">
		    	<?php foreach ($detail_kwitansi as $key => $value) {
		    		echo " - ".$value['nama_barang'];
		    	} ?>

		    </td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td colspan="2" style="border-bottom:1px solid">&nbsp;</td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td width="257">&nbsp;</td>
		    <td width="194"><u>Jakarta , <?php echo date("d M Y") ?></u></td>
		  </tr>
		  <tr>
		    <td height="51">&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		  </tr>
		</table>
	</div>
	
</body>

</html>