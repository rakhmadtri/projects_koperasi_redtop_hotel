<?php $this->load->view("header_print") ?>
  <!-- <body onload="window.print();"> -->
  <body onload="window.print();parent.location.reload();">
        <!-- title row -->

        <!-- info row -->
<?php 
// echo "<pre>";
// print_r($list_pinjaman);
// echo "</pre>";
 ?>


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
        	<b>Bukti Transaksi Pinjaman</b>
            <p><b>Periode :</b> <?php echo date("F Y", strtotime($list_pinjaman[0]['jatuh_tempo'])) ?> </p>
        </center>
     </td>
  </tr>
  <tr style="padding-top:10px">
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td width="15%">Jumlah Transaksi</td>
        <td width="1%">:</td>
        <td width="84%"><?php echo count($list_pinjaman)-1;?></td>
      </tr>
      <tr>
        <td>Tanggal Cetak</td>
        <td>:</td>
        <td><?php echo date("d F Y") ?></td>
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
                  <th valign="top" style="border-bottom:none; padding-bottom:0">NO PINJAMAN</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">JENIS PINJAMAN</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">DETAIL ANGGOTA</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">LAMA CICILAN</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">CICILAN KE</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">JUMLAH PINJAMAN</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">ANGSURAN</th>
                </tr>
<!--                 <tr>
                  <th valign="top" style="border-top:none; padding-top:0"><span style="border:none">PINJAMAN</span></th>
                  <th valign="top" style="border-top:none; padding-top:0"><span style="border:none">ANGGOTA</span></th>
                  <th valign="top" style="border-top:none; padding-top:0"><span style="border:none">JUMLAH PINJAMAN</span></th>
                  <th valign="top" style="border-top:none; padding-top:0"><span style="border:none">CICILAN</span></th>
                  <th valign="top" style="border-top:none; padding-top:0"><span style="border:none">KE</span></th>
                  <th valign="top" style="border-top:none; padding-top:0">&nbsp;</th>
                  <th valign="top" style="border-top:none; padding-top:0">&nbsp;</th>
                </tr> -->
              </thead>
              <tbody>
                  <?php unset($list_pinjaman['header']);
                    $sum_angsuran = 0;
                  ?>
                  <?php foreach ($list_pinjaman as $key => $value): ?>
                    <tr>
                      <td><?php echo $value['order_id'] ?></td>
                      <td><?php echo strtoupper(str_replace("_", " ", $value['keterangan'])) ?></td>
                      <td><?php echo $value['detail_anggota'] ?></td>
                      <td><?php echo $value['lama_cicilan'] ?></td>
                      <td><?php echo $value['cicilan_ke'] ?></td>
                      <td><?php echo $value['total_pinjaman'] ?></td>
                      <td><?php echo $value['cicilan_perbulan'] ?></td>
                      <?php $sum_angsuran += $value['cicilan_perbulan']; ?>
                    </tr>
                  <?php endforeach ?>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">

          <div class="col-xs-6 pull-right">
            <div class="table-responsive">
              <table class="table">
                <!-- <tr>
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
                </tr> -->
                <tr>
                  <th>Total : </th>
                  <td><?php echo currency_format($sum_angsuran) ?></td>
                </tr>
                <tr>
                  <th>Terbilang : </th>
                  <td><?php echo konversi($sum_angsuran) ?></td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
  </body>
</html>

