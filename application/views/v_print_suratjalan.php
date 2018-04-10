<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Surat Jalan</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/example.js'></script>

</head>

<body>
	<div id="page-wrap">

		<textarea id="header"></textarea>
		
		<div id="identity">
            <div id="logo-left">
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
<!--              <?php print_r($detail_suratjalan) ?>  -->
            <table id="meta">
                    <td class="meta-head" colspan="2">
						<label>KEPADA YTH : </label></br>
					    <label><?php echo $detail_suratjalan[0]['nama_cabang'] ?></label><br>
					    <label>UP : </label><?php echo $detail_suratjalan[0]['up_customer'] ?><br>
					    <label><?php echo $detail_suratjalan[0]['kokab_nama'] ?><br>
					</td>
                </tr>
            </table>
		</div>

		<div style="clear:both"></div>
<!-- 		<?php echo $detail_suratjalan[0]['no_suratjalan'] ?> -->
		<br><br>
		
		<label id="customer-title">Surat Jalan No : <?php echo str_pad($detail_suratjalan[0]['id_surat_jalan'],3,0,STR_PAD_LEFT) ?> </label>
		<div style="clear:both"></div>
		<label class="no-surat-jalan">Kami kirimkan barang-barang tersebut dibawah ini dengan kendaraan .................NO................</label>
		<div style="clear:both"></div>
		<br>
		<div class="line"></div>
		<div style="clear:both"></div>
		<div class="surat-jalan-teks">SURAT JALAN</div>
		<table id="items">
		  <tr>
	  		<th width="20%">Banyaknya</th>
	  		<th>Nama Barang</th>
		  </tr>
     	  <?php foreach ($detail_suratjalan as $key => $value): ?>
			  <tr class="item-row">
			      <td class="item-name" style="text-align:center"><?php echo (isset($value['qty'])?$value['qty']:"");?></td>
			      <td class="item-description"><?php echo (isset($value['nama_barang'])?$value['nama_barang']:"");?></td>
			  </tr>
		  	<?php endforeach ?>
  		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>		  
		</table>
		<br>
		<br>
		<br>
	    <style type="text/css">
	    	table.no-border th, table.no-border td{
	    		border: none!important;
	    	}

	    </style>
		<table class="no-border" width="100%">
			<tr>
				<th width="30%" class="no-border" >Tanda Terima</th>
				<th width="30%">Nama Pengirim</th>
				<th width="40%">Hormat Kami</th>
			</tr>
			<tr>
				<td></td>
				<td style="height:40px"></td>
				<td></td>
			</tr>
			<tr>
				<th><?php echo $detail_suratjalan[0]['nama_cabang'] ?></th>
				<th><?php echo (isset($value['nama'])?$value['nama']:"");?></th>
				<th>PT.Jayabaru</th>
			</tr>
		</table>		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
	
</body>

</html>