<?php /*$this->load->view("header_print")*/ ?>

        <!-- title row -->

        <!-- info row -->
<style type="text/css">
  @media screen, print {
    html, body {
      width: 107.95mm;
      height: 139.7mm;
      display: block;
      font-family: "Calibri";
    }

    th, td{
      font-size: 9pt;
    }

    @page
     {
      size: 107.95mm 139.7mm;
      margin: 0mm 0mm 0mm 0mm;
    }

  }
</style>
<body onload="window.print();parent.location.reload();">
<table width="100%">
  <tr>
    <!-- <th width="140" style="padding:0 20px"><img src="<?php echo base_url() ?>asset/koperasi_template/logo.png" width="100px"></th>
    <td> -->
    <td>
    <table width="100%">
          <tr>
              <th colspan="5"><div align="left"><?php echo nama_koperasi() ?></div></th>
            </tr>   
            <tr>
              <td><div align="left">Telp.</div></td>
              <td><div align="left">: (021) 35948806</div></td>
              
              <td >No Nota</td>
              <td>:</td>
              <td><?php echo $data_penjualan[0]['order_id'] ?> </td>
            </tr>
            <tr>
                <td><div align="left">Telp.</div></td>
                <td><div align="left">: 0856 9736 4669</td>
               
                <td >Customer </td>
                <td>:</td>
                <td><?php if($data_penjualan[0]['nama'] == null){ echo "New Customer"; }else{echo $data_penjualan[0]['nama'];} ?></td>
            </tr>
             <tr>
              <td><div align="left">Fax. </div></td>
              <td>: (021) 54393386</td>

              <td><div align="left">Tgl. </div></td>
              <td>:</td> 
              <td><?php echo date("d F Y",strtotime($data_penjualan[0]['tgl_nota'])) ?></td>
            </tr> 
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr> 
             <tr>
              <td colspan="8"><hr /></td>
            </tr> 
            <tr>
      <th><div align="left">KODE</div></th>
      <th><div align="left">NAMA BARANG</div></th>
      <th valign="top"><div align="left">HARGA</div></th>
      <th valign="top"><div align="left">QTY</div></th>
      <th valign="top"><div align="left">SUBTOTAL</div></th>
  </tr>
   <?php if (isset($data_penjualan)): ?>
                 <?php foreach ($data_penjualan as $key => $value): ?>
                   <tr>
                      <td><?php echo $value['kode_barang'] ?></td>
                      <td><?php echo $value['nama_barang'] ?></td>
                      <td><?php echo $value['selling_price'] ?></td>
                      <td><?php echo $value['qty'] ?></td>
                      <td><?php echo $value['sub_total'] ?></td>
                   </tr>
                 <?php endforeach ?>  
               <?php endif ?>
                <tr>
              <td colspan="8"><hr /></td>
            </tr> 
                  <tr>
                   <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  <th><div align="left">Total</div></th>
                  <td>: Rp. <?php echo $data_penjualan[0]['total_before_ppn'] ?>,-</td>
                </tr>
                 <tr>
                  <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  <th><div align="left">Tax (%)</div></th>
                  <td>: <?php echo $data_penjualan[0]['ppn'] ?></td>
                </tr> 
                <tr>
                <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  <th><div align="left">Total</div></th>
                  <td>: Rp. <?php echo $data_penjualan[0]['total_after_ppn'] ?>,-</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th><div align="left">Cash</div></th>
                  <td>: Rp. <?php echo $data_penjualan[0]['cash'] ?>,-</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  <th><div align="left">Kredit</div></th>
                  <td>: Rp. <?php echo $data_penjualan[0]['kredit'] ?>,-</td>
                </tr>     
        </table>
     </td>
  </tr>
   
 
</table>
              
         
    </div><!-- ./wrapper -->
  </body>
</html>

