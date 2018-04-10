<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report Pinjaman</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
        <div class="btn-group pull-right">
           <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
           <ul class="dropdown-menu">
              <li><a href="#">Print</a></li>
              <li><a href="#">Save as PDF</a></li>
              <li><a href="<?php echo base_url() ?>master_barang/TRUE">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div>
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_transaksi_pembayaran" method="get">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">From</label>
          <div class="col-sm-3">
            <input type="text" name="from" class="form-control datepicker" value="<?php echo isset($_GET['from'])?$_GET['from']:"" ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">To</label>
          <div class="col-sm-3">
            <input type="text" name="to" class="form-control datepicker" value="<?php echo isset($_GET['to'])?$_GET['to']:"" ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">Group By</label>
          <div class="col-sm-3">
            <select name="group_by" class="form-control select2" style="width: 100%;" id="nik">
              <option value="">- Pilih -</option>
              <option value="id_pembayaran" <?php echo (isset($_GET['group_by']) AND $_GET['group_by']=='id_pembayaran')?'selected':'' ?> >ID Pembayaran</option>
              <option value="cicilan.no_anggota" <?php echo (isset($_GET['group_by']) AND $_GET['group_by']=='cicilan.no_anggota')?'selected':'' ?> >Anggota</option>
            </select>
          </div>
        </div>
      </div>


      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <button type="submit" class="btn btn-info pull-left col-sm-4" id="click">Submit</button>
        </div>
      </div>
      </form>
      <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data</h3>
                </div>
                <?php if (!empty($_GET['group_by']) && $_GET['group_by']=='id_pembayaran'): ?>
                        <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped datatable">
                            <thead>
                              <tr>
                                <th width="13%">ID Pembayaran</th>
                                <th>Nominal </th>
                                <th>Timestamp</th>
                                <!-- <th width="18%"> Nama</th> -->
                                <!-- <th> Jumlah Pinjaman</th>
                                <th> Nominal Bunga</th>
                                <th> Lama Cicilan</th>
                                <th> Keterangan</th> -->
                              </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($all_pembayaran)): ?>
                              <?php foreach ($all_pembayaran as $key => $value) {
                                ?>
                            <tr class="odd gradeX">
                              <td><?php echo $value['id'] ?></td>
                              <td><?php echo $value['total_nominal']." - ".$value['cicilan_perbulan'] ?></td>
                              <td><?php echo date('Y/m/d',strtotime($value['timestamp'])) ?></td>
                              <!-- <td><?php echo $value['nama'] ?></td>
                              <td><?php echo $value['jumlah_pinjaman'] ?></td>
                              <td><?php echo $value['bunga'] ?></td>
                              <td><?php echo $value['lama_cicilan'] ?></td>
                              <td><?php echo strtoupper(str_replace('_', '', $value['keterangan'])) ?></td> -->
                            </tr>
                          <?php  } ?>
                      <?php endif ?>
                    </tbody>
                    <tfoot>                  
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->                  
                <?php else: ?>
                                <div class="box-body">
                                  <table id="example1" class="table table-bordered table-striped datatable">
                                    <thead>
                                      <tr>
                                        <th width="13%">ID Pembayaran</th>
                                        <th>No - Nama Anggota</th>
                                        <th>Nominal </th>
                                        <th>Timestamp</th>
                                        <!-- <th width="18%"> Nama</th> -->
                                        <!-- <th> Jumlah Pinjaman</th>
                                        <th> Nominal Bunga</th>
                                        <th> Lama Cicilan</th>
                                        <th> Keterangan</th> -->
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($all_pembayaran)): ?>
                                      <?php foreach ($all_pembayaran as $key => $value) {
                                        ?>
                                    <tr class="odd gradeX">
                                      <td><?php echo $value['id'] ?></td>
                                      <td><?php echo $value['no_anggota']." - ".$value['nama'] ?></td>
                                      <td><?php echo $value['total_nominal']." - ".$value['cicilan_perbulan'] ?></td>
                                      <td><?php echo date('Y/m/d',strtotime($value['timestamp'])) ?></td>
                                      <!-- <td><?php echo $value['nama'] ?></td>
                                      <td><?php echo $value['jumlah_pinjaman'] ?></td>
                                      <td><?php echo $value['bunga'] ?></td>
                                      <td><?php echo $value['lama_cicilan'] ?></td>
                                      <td><?php echo strtoupper(str_replace('_', '', $value['keterangan'])) ?></td> -->
                                    </tr>
                                  <?php  } ?>
                              <?php endif ?>
                            </tbody>
                            <tfoot>                  
                            </tfoot>
                          </table>
                        </div><!-- /.box-body -->
                <?php endif ?>
      </div><!-- /.box -->
  </div>
</section>
<?php $this->load->view("footer"); ?>          
// <script type="text/javascript">
//   $(document).ready(function() {
//     $('#example1').DataTable().destroy();
//       $('#example1').DataTable( {
//           "order": [[ 0, "desc" ]]
//       } );
//   } );
// </script>