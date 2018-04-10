<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Penawaran</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">Penawaran</textarea>
		
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
		<b>Kepada Yth,</b>
		<div style="clear:both"></div>
		<div class="cust-label2">
            <?php echo (isset($detail_penawaran[0]['nama_cabang'])?$detail_penawaran[0]['nama_cabang']:""); ?>		
		</div>
		<div style="clear:both"></div>
		<label class="up-label">Up : <?php echo (isset($detail_penawaran[0]['up_customer'])?$detail_penawaran[0]['up_customer']:""); ?></label>
		
		<div style="clear:both"></div>
		<label class="up-label">Hal : Penawaran <?php echo (isset($data_penawaran[0]['nama_barang'])?$data_penawaran[0]['nama_barang']:""); ?>
		</label>	
		<div style="clear:both"></div>
		<br>
		Dengan hormat, </br>
		Bersama dengan surat penawaran kami dari Jaya Baru bermaksud ingin mengajukan penawaran harga spare part </br>
		Chiler Pendingin dengan spesifikasi sbb : 
		</br>
		</br>
		<div class="box-table-penawaran">
			<table class="table-penawaran">
			  	<tr>
			  		<td>Merk</td>
			  		<td>&nbsp;</td>
					<td>&nbsp;</td>
			  		<td>:</td>
			  		<td><?php echo (isset($data_penawaran[0]['deskripsi'])?$data_penawaran[0]['deskripsi']:""); ?></td>
			  	</tr>
			  	<tr>
			  		<td>S/N</td>
			  		<td>&nbsp;</td>
					<td>&nbsp;</td>
			  		<td>:</td>
			  		<td><?php echo (isset($data_penawaran[0]['license'])?$data_penawaran[0]['license']:""); ?></td>
			  	</tr>
			  	<tr>
			  		<td colspan="5">Pembelian spare part</td>
			  	</tr>
			  	<?php foreach ($data_sparepart as $key => $value): ?>
				<tr>
					<td><?php echo $value['nama_barang'] ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>:</td>
					<td><?php echo "Rp. ".$value['selling_price'].",-" ?></td>			
				</tr>	
					  <?php endforeach ?>
					  <tr>
					<td colspan="5"><div class="line2"></div></td>			
				</tr> 
				<tr>
					<td><b>Total</b></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><b>:</b></td>
					<td><b><?php echo "Rp. ".$value['sub_total'].",-" ?></b></td>
				</tr>
				<tr>
					<td><b>PPH</b></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><b>:</b></td>
					<td><b><?php echo $value['pph']."%" ?></b></td>
				</tr>
				<tr>
					<td><b>Total Setelah PPH</b></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><b>:</b></td>
					<td><b><?php echo "Rp. ".(isset($detail_penawaran[0]['payment_amount'])?$detail_penawaran[0]['payment_amount']:""); ?></b></td>
				</tr>
			  </table>
			</div>					
  	
		
		</br></br>
		<table class="tableTd">
			<tr>
				<td>Harga</td>
				<td>:</td>
				<td colspan="2">Nett</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Pembayaran</td>
				<td>:</td>
				<td colspan="2">Transfer. 14 hari setelah faktur diserahkan</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td colspan="2">:</td>
				<td>Setelah SPK/PO diterima</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Garansi Service</td>
				<td colspan="2">:</td>
				<td>2 bulan diluar spare part / suku cadang ( jasa saja )</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4">Dikenakan biaya pengecekan dan transport bila unit tidak jadi diperbaiki</td>
			</tr>
			<tr>
				<td colspan="4">Harga spare part sewaktu - waktu bisa berubah.</td>
			</tr>
		</table>
		</br></br></br></br>
		<table class="tableTd">
			<tr>
				<td>Demikianlah penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</td>
			</tr>
		</table>
		</br>
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
				<td>Mengetahui</td>
			</tr>
			</table>
			<table class="tableTd"><br><br><br>
			<tr>
				<td style="padding-left:20px"><u>ELSA WIJAYA<u></td>
				<?php for($i=1;$i<=9;$i++){ ?>
					<td>&nbsp;</td>
				<?php } ?>
				<td><u>Juan Yustana</u></td>
			</tr>
		</table>	
	</div>
</body>
</html>