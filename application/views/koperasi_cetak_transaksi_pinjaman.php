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
          <b><u>Bukti Transaksi Pinjaman</u></b>
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
        <td><?php echo date("d F Y",strtotime(isset($data_transaksi['created_timestamp'])?$data_transaksi['created_timestamp']:"")) ?></td>
      </tr>
      <tr>
        <td width="24%">No Transaksi Pinjaman</td>
        <td width="1%">:</td>
        <td width="75%"><?php echo isset($data_transaksi['id'])?$data_transaksi['id']:"" ?> </td>
      </tr>
      <tr>
      <tr>
        <td>No Anggota</td>
        <td>:</td>
        <td width="75%"><?php echo isset($data_transaksi['no_anggota'])?$data_transaksi['no_anggota']:"" ?> </td>
      </tr>
      <tr>
      <tr>
        <td>Nama Anggota</td>
        <td>:</td>
        <td width="75%"><?php echo isset($data_transaksi['nama'])?$data_transaksi['nama']:"" ?> </td>
      </tr>
      <tr>
        <td>Total</td>
        <td>:</td>
        <td><?php echo isset($data_transaksi['total_pinjaman'])?$data_transaksi['total_pinjaman']:"" ?></td>
      </tr>
      <tr>
      <tr>
        <td>Terbilang</td>
        <td>:</td>
        <td width="75%"># <?php echo konversi(isset($data_transaksi['total_pinjaman'])?$data_transaksi['total_pinjaman']:0) ?> #</td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<br>
  <table width="100%">
      <tr>
        <th width="30%" class="no-border" >Pembuat</th>
        <th width="30%">Mengetahui</th>
        <th width="40%">Peminjam</th>
      </tr>
      <tr>
        <td></td>
        <td style="height:55px"></td>
        <td></td>
      </tr>
      <tr>
        <th>Admin</th>
        <th>Manager</th>
        <th><?php echo isset($data_transaksi['nama'])?$data_transaksi['nama']:"" ?></th>
      </tr>
    </table>    
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

