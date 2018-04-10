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
        <td width="24%">No Penarikan</td>
        <td width="1%">:</td>
        <td width="75%"><?php echo $data_penarikan[0]['NoPengunduranDiri'] ?> </td>
      </tr>
      <tr>
        <td>No Anggota</td>
        <td>:</td>
        <td><?php echo $data_penarikan[0]['no_anggota'] ?></td>
      </tr>
      <tr>
        <td>Nama Anggota</td>
        <td>:</td>
        <td><?php echo $data_penarikan[0]['nama'] ?></td>
      </tr>
      <tr>
        <td>Tanggal Penarikan</td>
        <td>:</td>
        <td><?php echo date("d F Y",strtotime($data_penarikan[0]['tglTarik'])) ?></td>
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
                  <th valign="top" style="border-bottom:none; padding-bottom:0">No</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">Simpanan Pokok</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">Simpanan Wajib</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">Simpanan Sukarela</th>
                  <th valign="top" style="border-bottom:none; padding-bottom:0">Jumlah</th>
                </tr>

              </thead>
              <tbody>
                   <tr>
                      <td><?php echo $data_penarikan[0]['no'] ?></td>
                      <td><?php echo $data_penarikan[0]['simpanan_pokok'] ?></td>
                      <td><?php echo $data_penarikan[0]['simpanan_wajib'] ?></td>
                      <td><?php echo $data_penarikan[0]['simpanan_sukarela'] ?></td>
                      <td><?php echo $data_penarikan[0]['jumlah'] ?></td>
                   </tr>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
  </body>
</html>

