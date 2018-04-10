<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>asset/create_invoice/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url() ?>asset/create_invoice/js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
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
		
		<div id="customer">
			<label class="cust-label">Kepada Yth:</label>
				<div style="clear:both"></div>
            <label class="cust-title">
            	<?php echo (isset($result[0]['nama_customer'])?$result[0]['nama_customer']:""); ?>
			</label>
			<div style="clear:both"></div>
			<label class="up-label">
            <?php echo "UP : ". (isset($result[0]['up_customer'])?$result[0]['up_customer']:""); ?>
			</label>
			<div style="clear:both"></div>
			<label class="up-label">
            <?php echo "No Telpon : ". (isset($result[0]['no_telfon'])?$result[0]['no_telfon']:""); ?>
			</label>
			<div style="clear:both"></div>
			 <label class="cust-title">
            	<?php echo (isset($result[0]['kokab_nama'])?$result[0]['kokab_nama']:""); ?>
			</label>
			
		
            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea><?php echo (isset($result[0]['no_invoice'])?$result[0]['no_invoice']:"");?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea id="date"><?php echo (isset($result[0]['order_timestamp'])?$result[0]['order_timestamp']:"");?></textarea></td>
                </tr>
<!--                 <tr>
                    <td class="meta-head">Total Pembayaran</td>
                    <td><div class="due"><?php echo "Rp ".(isset($result[0]['total_customer_price'])?$result[0]['total_customer_price']:"");?></div></td>
                </tr> -->

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
     	  <?php foreach ($result as $key => $value): ?>
			  <tr class="item-row">
			      <td class="item-name"><div class="delete-wpr">
			      	<?php 
			      		echo (isset($value['nama_barang'])?$value['nama_barang']:"");
			      		echo " ";
			      		echo (isset($value['license'])?$value['license']:"");
			      ?>
			      <textarea></textarea><a class="delete" href="<?php echo base_url() ?>asset/create_invoice/javascript:;" title="Remove row">X</a></div></td>

			  
			      <td class="description"><textarea><?php echo (isset($value['deskripsi'])?$value['deskripsi']:"");?></textarea></td>
			      <td><span class="price">
    			  <?php 
					if($value['category']!="A-PRODUCT"){ ?>
			      		<?php echo "Rp ".(isset($value['selling_price'])?$value['selling_price']:"");?>
				  <?php } ?>
			      </span></td>
			      <td><span class="price">
			      <?php if($value['category']!="A-PRODUCT"){ ?><?php echo (isset($value['qty'])?$value['qty']:"");?><?php } ?>
			      </span></td>
			      <td>
			      	<span class="price">
			      		<?php 
			      			if($value["category"]=="A-PRODUCT")
			      			{
			      				echo "";
			      			}
			      			else
			      			{
			      				echo "Rp ".(isset($value['sub_total'])?$value['sub_total']:"");
			      			}
			      			
			      		?>
			      	</span>
			      </td>
			  </tr>
		  	<?php endforeach ?>
  		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>		  
		  <!-- <tr>
		      <td colspan="2" class="blank" style="border-top: solid 1px">Terbilang :</br>
		      	<?php echo Terbilang(isset($result[0]['total_customer_price'])?$result[0]['total_customer_price']:""); ?>
		      </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">Rp. <?php echo (isset($value['total_customer_price'])?$value['total_customer_price']:"");?></div></td>
		  </tr> -->
		  <tr>
		      <td colspan="2" class="blank" style="border-top:1px solid">No Rekening : 5785046193 </td>
		      <td colspan="2" class="total-line">Total Harga: </td>
		      <td class="total-value"><div id="total">Rp. <?php echo (isset($value['total_customer_price'])?$value['total_customer_price']:"");?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> A/N : Edy Wijaya</td>
		      <td colspan="2" class="total-line">Pph : </td>

		      <td class="total-value"><textarea id="paid"><?php echo isset($value['pph'])?$value['pph']:"" ?> %</textarea></td>
		  </tr>
  		  <tr>
		      <td colspan="2" class="blank"> BANK : BCA / KCP Niaga Grisenda</td>
		      <td colspan="2" class="total-line">Total Harga Setelah PPH: </td>
		      <td class="total-value"><div id="total">Rp. <?php echo (isset($value['total_customer_pph'])?$value['total_customer_pph']+$value['total_customer_price'].".00":"");?></div></td>
		  </tr>
		</table>		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
	
</body>

</html>