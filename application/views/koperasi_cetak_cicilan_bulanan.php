<?php $this->load->view("header_print") ?>
  <body onload="window.print();parent.location.reload();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
               <img src="<?php echo base_url() ?>asset/koperasi_template/logo.jpg" width="30px"> Redtop Hotel
              <small class="pull-right">Date: <?php echo date("Y/m/d") ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
<!--         <?php print_r($data_pinjaman_anggota) ?> -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong>Admin, Inc.</strong><br>
              795 Folsom Ave, Suite 600<br>
              San Francisco, CA 94107<br>
              Phone: (804) 123-5432<br>
              Email: info@almasaeedstudio.com
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            To
            <address>
              <strong>John Doe</strong><br>
              795 Folsom Ave, Suite 600<br>
              San Francisco, CA 94107<br>
              Phone: (555) 539-1037<br>
              Email: john.doe@example.com
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice #007612</b><br>
            <br>
            <b>Order ID:</b> 4F3S8J<br>
            <b>Payment Due:</b> 2/22/2014<br>
            <b>Account:</b> 968-34567
          </div><!-- /.col -->
        </div><!-- /.row -->

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

  </body>
</html>
<script>
// // 6 Second params ke 2 dlm satuan Milisecond
// var intervalID = window.setInterval(myCallback,6000);

// function myCallback() {
//           setTimeout(function(){location.href="<?php echo base_url($_SERVER['HTTP_REFERER']) ?>"});
// }
</script>
<script type="text/javascript">
  (function() {

    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
        console.log('Functionality to run after printing');
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

}());
</script>
