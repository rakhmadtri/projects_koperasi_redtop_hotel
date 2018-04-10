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
          <b><u>Bukti Transaksi Simpanan</u></b>
            <!-- <p><b>Periode :</b> <?php echo $data_detail_po[0]['order_id'] ?> </p> -->
            <p><b>Periode :</b> <?php echo date("F Y", mktime()) ?> </p>
        </center>
     </td>
  </tr>
  <tr style="padding-top:10px">
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td>Tanggal Created</td>
        <td>:</td>
        <td><?php echo date("d F Y",strtotime(isset($header_simpanan['created_timestamp'])?$header_simpanan['created_timestamp']:"")) ?></td>
      </tr>
      <tr>
        <td width="24%">No Transaksi Simpanan</td>
        <td width="1%">:</td>
        <td width="75%"><?php echo isset($header_simpanan['kode_simpanan'])?$header_simpanan['kode_simpanan']:"" ?> </td>
      </tr>
      <tr>
        <td>No Anggota</td>
        <td>:</td>
        <td width="75%"><?php echo isset($header_simpanan['no_anggota'])?$header_simpanan['no_anggota']:"" ?> </td>
      </tr>
      <tr>
      <tr>
        <td>NIK</td>
        <td>:</td>
        <td width="75%"><?php echo isset($header_simpanan['nik'])?$header_simpanan['nik']:"" ?> </td>
      </tr>
      <tr>
      <tr>
        <td>Nama Anggota</td>
        <td>:</td>
        <td width="75%"><?php echo isset($header_simpanan['nama'])?$header_simpanan['nama']:"" ?> </td>
      </tr>
      <tr>
        <td>Total</td>
        <td>:</td>
        <td><?php echo isset($header_simpanan['total_simpanan'])?$header_simpanan['total_simpanan']:"" ?></td>
      </tr>
      <tr>
      <tr>
        <td>Terbilang</td>
        <td>:</td>
        <td width="75%"># <?php echo konversi(isset($header_simpanan['total_simpanan'])?$header_simpanan['total_simpanan']:0) ?> #</td>
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
                  <th valign="top" style="border-bottom:none; padding-bottom:0">KODE SIMPANAN</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">NAMA JENIS SIMPANAN</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">SUBTOTAL</th>
                </tr>

              </thead>
              <tbody>
               <?php if (isset($detail_simpanan)): ?>
                 <?php foreach ($detail_simpanan as $key => $value): ?>
                   <tr>
                      <td><?php echo $value['kode_jenis_simpanan'] ?></td>
                      <td><?php echo $value['nama_simpanan'] ?></td>
                      <td><?php echo $value['jumlah_simpanan'] ?></td>
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

              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
  </body>
</html>

