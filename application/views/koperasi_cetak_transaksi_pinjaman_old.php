<?php $this->load->view("header_print") ?>
  <!-- <body onload="window.print();"> -->
  <body onload="window.print();parent.location.reload();">
        <!-- title row -->

        <!-- info row -->
<!--         <?php print_r($data_pinjaman_anggota) ?> -->

           
<table width="100%">
  <tr>
    <th rowspan="3"  width="176"><img src="<?php echo base_url() ?>asset/koperasi_template/logo.jpg" width="100px"></th>
    <th width="396"><?php echo nama_koperasi() ?></th>
    <th width="172">No Transaksi</th>
    <th width="15">:</th>
    <th width="216"></th>
  </tr>
  <tr>
    <td>Tel. :(021) 35948806 <br>Tel. :0856 9736 4669Fax. :(021) 54393386</td>
    <td width="172">Tanggal</td>
    <td>:</td>
    <td width="216">8 January 2016</td>
  </tr>
  <tr style="margin-bottom:100px">
    <td>Email :koperasi@redtophotel.com</td>
    <td>No Reff</td>
    <td>:</td>
    <td width="216">PJ0001</td>
  </tr>
  <tr>
  	<td colspan="5">
	  	<hr style="border-top:10px solid; margin: 10px 0">
    </td>
  </tr>
  <tr style="padding-top:10px">
    <td colspan="5"><center style="margin-top:30px"><b>Bukti Transaksi Pinjaman</b></center></td>
  </tr>
</table>


        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>NO PINJAMAN</th>
                  <th>NO ANGGOTA</th>
                  <th>TOTAL JUMLAH PINJAMAN</th>
                  <th>LAMA CICILAN</th>
                  <th>CICILAN KE</th>
                  <th>KEPERLUAN</th>
                  <th>ANGSURAN</th>
                </tr>
              </thead>
              <tbody>
               
                <?php foreach ($data_pinjaman_anggota as $key => $value): ?>
                    <tr>
                      <td><?php echo $value['pinjaman_id'] ?></td>
                      <td><?php echo $value['no_anggota'] ?></td>
                      <td><?php echo $value['jumlah_pinjaman'] ?></td>
                      <td><?php echo $value['lama_cicilan'] ?></td>
                      <td><?php echo $value['angsuran_ke'] ?></td>
                      <td><?php echo $value['keterangan'] ?></td>
                      <td><?php echo $value['cicilan_perbulan'] ?></td>
                    </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">

          <div class="col-xs-6 pull-right">
            <p class="lead">Periode <b><?php echo date("F Y", strtotime($data_pinjaman_anggota[0]['jatuh_tempo'])) ?> </b></p>
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>$250.30</td>
                </tr>
                <tr>
                  <th>Tax (9.3%)</th>
                  <td>$10.34</td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td>$5.80</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>$265.24</td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="<?php echo base_url()."asset/koperasi_template/"?>dist/js/app.min.js"></script>
  </body>
</html>

