<?php $this->load->view("header_print") ?>
  <body onload="window.print();parent.location.reload();">

        <!-- title row -->

        <!-- info row -->
<!--         <?php print_r($data_pinjaman_anggota) ?> -->
<table width="100%">
  <tr>
    <th width="140" style="padding:0 20px"><img src="<?php echo base_url() ?>asset/koperasi_template/logo.png" width="100px"></th>
    <td>
    <table>
          <tr>
              <th style="font-size:16pt"><div align="left"><?php echo nama_koperasi() ?></div></th>
            </tr>   
            <tr>
              <td><div align="left">Tel. :(021) 35948806 <br>
                Tel. :0856 9736 4669 Fax. :(021) 54393386</div></td>
            </tr>
            <tr>
              <td><div align="left">Email :koperasi@redtophotel.com</div></td>
            </tr>          
        </table>
     </td>
  </tr>
  <tr>
    <td colspan="2">
      <hr style="border-top:5px solid; margin: 10px 0">
    </td>
  </tr>
  <tr style="padding-top:10px">
    <td colspan="2">
      <center style="margin-bottom:30px; font-size:14pt">
          <b><u>Purchase Order</u></b>
            <!-- <p><b>Periode :</b> <?php echo $data_detail_po[0]['order_id'] ?> </p> -->
            <p><b>Periode :</b> <?php echo date("F Y", mktime()) ?> </p>
        </center>
     </td>
  </tr>
  <tr style="padding-top:10px">
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td width="24%">No Purchase Order</td>
        <td width="1%">:</td>
        <td width="75%"><?php echo $data_detail_po[0]['order_id'] ?> </td>
      </tr>
      <tr>
        <td>Nama Supplier</td>
        <td>:</td>
        <td><?php echo $data_detail_po[0]['nama_supplier'] ?></td>
      </tr>
      <tr>
        <td>Pembuat Purchase Order</td>
        <td>:</td>
        <td><?php echo $data_detail_po[0]['nama'] ?></td>
      </tr>
      <tr>
        <td>Tanggal Purchase Order</td>
        <td>:</td>
        <td><?php echo date("d F Y",strtotime($data_detail_po[0]['pembelian_timestamp'])) ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>


        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">KODE BARANG</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">NAMA BARANG</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">HARGA</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">QTY</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">SUBTOTAL</th>
                </tr>

              </thead>
              <tbody>
               <?php if (isset($data_detail_po)): ?>
                 <?php foreach ($data_detail_po as $key => $value): ?>
                   <tr>
                      <td><?php echo $value['kode_barang'] ?></td>
                      <td><?php echo $value['nama_barang'] ?></td>
                      <td><?php echo $value['buying_price'] ?></td>
                      <td><?php echo $value['qty'] ?></td>
                      <td><?php echo $value['sub_total'] ?></td>
                   </tr>
                 <?php endforeach ?>
               <?php endif ?>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">

          <div class="col-xs-6 pull-right">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Total:</th>
                  <td>Rp. <?php echo $data_detail_po[0]['transaksi_noppn'] ?>,-</td>
                </tr>
                <tr>
                  <th>Tax (%)</th>
                  <td>Rp. <?php echo $data_detail_po[0]['ppn'] ?>,-</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>Rp. <?php echo $data_detail_po[0]['total_transaksi'] ?>,-</td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
  </body>
</html>

