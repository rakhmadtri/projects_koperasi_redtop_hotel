<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>SPK</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">Surat Perintah Kerja</textarea>
		
		<div id="identity">
            <textarea id="address">Jl. Rusun Kamal Mutiara Taman Palem Blok C19-50
Kel. Cengkareng Timur Kec. Cengkareng, Jakarta Barat
Tel. :(021) 35948806
Tel. :0856 9736 4669</textarea>
            <div id="logo">
              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>
              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" style="padding-right:30px"  height="90" src="<?php echo base_url() ?>asset/create_invoice/images/logo.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		Terima Service Timbangan, Genset, Printer, TV LCD, Chiler dll
		<hr>
		<table class="tableTd">
			<tr>
				<td>No. SPK</td>
				<td>:</td>
				<td><textarea id="customer-title">SPK/<?php echo date("Ymd") ?>
			</textarea></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Tanggal</td>
<!-- 			<?php print_r($detail_spk) ?> -->
				<td>:</td>
				<td><textarea id="customer-title"><?php echo (isset($detail_spk[0]['nama_customer'])?$detail_spk[0]['nama_customer']:""); ?>
			</textarea></td>
			</tr>
		</table>
		<div class="box">
		<table class="tableTd">
			<tr>
				<td>Kepada Yth</td>
				<td>:</td>
				<td><textarea id="customer-title"><?php echo (isset($detail_spk[0]['nama_cabang'])?$detail_spk[0]['nama_cabang']:""); ?>
			</textarea></td>
			</tr>
			<tr>
				<td>Nama Toko</td>
				<td>:</td>
				<td><textarea id="customer-title"><?php echo (isset($detail_spk[0]['nama_customer'])?$detail_spk[0]['nama_customer']:""); ?>
			</textarea></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><textarea id="customer-title"><?php echo (isset($detail_spk[0]['kokab_nama'])?$detail_spk[0]['kokab_nama']:""); ?>
			</textarea></td>
			</tr>
			<tr>
				<td>Telpon/Fax</td>
				<td>:</td>
				<td><textarea id="customer-title"><?php echo (isset($detail_spk[0]['no_telfon'])?$detail_spk[0]['no_telfon']:""); ?>
			</textarea></td>
			</tr>
		</table>
        </div>    
		</br>
		<center>Keterangan :</center>
		</br>
		

		</br></br>
		<table class="tableTd">
			<tr>
				<td>Hormat kami,</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>Mengerahui,</td>
			</tr>
			<tr>
				<td>Dibuat oleh</td>
			</tr>
		</table>	
	</div>
</body>
</html>