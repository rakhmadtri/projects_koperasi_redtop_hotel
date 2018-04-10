<?php /*$this->load->view("header_print")*/ ?>

        <!-- title row -->

        <!-- info row -->
<style type="text/css">
  @media screen, print {
    html, body {
      width: 20cm;
      height: 16.5cm;
      display: block;
      font-family: "Lucida Console"; 
    }

    th, td{
      font-size: 12pt;
    }

    @page
     {
      size: 10cm 16.5cm;
      margin: 0cm 0cm 0cm 0cm;
      size: landscape;
    }

  }
</style>
<br>
<br>
<br>
<br>
<br>
<br>
<body onload="window.print();parent.location.reload();">
<table width="100%">
  <tr>
    <!-- <th width="140" style="padding:0 20px"><img src="<?php echo base_url() ?>asset/koperasi_template/logo.png" width="100px"></th>
    <td> -->
    <td>
    <table width="100%">
          <tr>
              <th colspan="5"><div align="left"></div></th>
            </tr>   
            <tr>
              <td width="18%"><div align="left"><!-- Telp. --></div></td>
              <td width="32%"><div align="left"><!-- : (021) 35948806 --></div></td>
              
              <td width="4%" ><!-- No Nota --></td>
              <td width="8%"><!-- : --></td>
              <td width="38%"> </td>
            </tr>
            <tr>
                <td><div align="left"><!-- Telp. --></div></td>
                <td><div align="left"><!-- : 0856 9736 4669 --></td>
               
                <td ><!-- Customer --> </td>

                <td colspan="2"><?php if($data_penjualan[0]['nama'] == null){ echo "New Customer"; }else{echo $data_penjualan[0]['nama'];} ?></td>
            </tr>
             <tr>
              <td><div align="left"><!-- Fax. --> </div></td>
              <td style="padding-left:10px"><?php echo $data_penjualan[0]['order_id'] ?></td>

              <td><div align="left"><!-- Tgl. --> </div></td>
              <td colspan="2"><?php echo date("d F Y",strtotime($data_penjualan[0]['tgl_nota'])) ?></td> 
            </tr> 
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr> 
             <tr>
              <td colspan="8"><hr /></td>
            </tr> 
        <?php if (isset($data_penjualan)): ?>
                 <?php foreach ($data_penjualan as $key => $value): ?>
                   <tr>
                      <td style="padding-left:20px"><?php echo $value['qty'] ?></td>
                      <!-- <td><?php echo $value['kode_barang'] ?></td> -->
                      <td><?php echo $value['nama_barang'] ?></td>
                      <td colspan="2"><?php echo $value['selling_price'] ?></td>
                      <td style="padding-left:25px"><?php echo $value['sub_total'] ?></td>
                   </tr>
                 <?php endforeach ?>  
               <?php endif ?>
                <tr>
              <td colspan="8"><hr /></td>
            </tr> 
                  <tr>
                   <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><div align="left">Total</div></th>
                  <td> Rp. <?php echo $data_penjualan[0]['total_before_ppn'] ?>,-</td>
                </tr>
                 <tr>
                  <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><div align="left">Tax (%)</div></th>
                  <td> <?php echo $data_penjualan[0]['ppn'] ?></td>
                </tr> 
                <tr>
                <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><div align="left">Total</div></th>
                  <td> Rp. <?php echo $data_penjualan[0]['total_after_ppn'] ?>,-</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><div align="left">Cash</div></th>
                  <td> Rp. <?php echo $data_penjualan[0]['cash'] ?>,-</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><div align="left">Kredit</div></th>
                  <td> Rp. <?php echo $data_penjualan[0]['kredit'] ?>,-</td>
                </tr>     
        </table>
     </td>
  </tr>
   
 
</table>
              
         

  </body>
</html>

