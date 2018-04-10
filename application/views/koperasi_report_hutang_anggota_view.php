<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report Hutang Anggota</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
        <div class="btn-group pull-right">
           <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
           <ul class="dropdown-menu">
              <li><a href="#">Print</a></li>
              <li><a href="#">Save as PDF</a></li>
              <li><a href="<?php echo base_url() ?>report_hutang_anggota/xls/?bulan_proses=<?php echo isset($_GET['bulan_proses'])?$_GET['bulan_proses']:""; ?>">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div>
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_hutang_anggota" method="get">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Bulan Proses</label>
          <div class="col-sm-3">
            <input type="text" name="bulan_proses" class="form-control datepicker">
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
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped datatable">
                    <thead>
                      <tr>
                        <th width="10%">No. Anggota</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Nama Dept</th>
                        <th>P.KOPERASI</th>
                        <th>P.BELANJA</th>
                        <th>IURAN</th>
                        <th>TOTAL</th>
                        <th>Jatuh Tempo</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list_hutang_anggota)): ?>
                      <?php foreach ($list_hutang_anggota as $key => $value) {
                        ?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['no_anggota'] ?></td>
                      <td><?php echo $value['nik'] ?></td>
                      <td><?php echo $value['nama'] ?></td>
                      <td><?php echo $value['nama_departemen'] ?></td>
                      <td><?php echo $value['pinjaman_koperasi'] ?></td>
                      <td><?php echo $value['pinjaman_belanja'] ?></td>
                      <td><?php echo $value['iuran'] ?></td>
                      <td><?php echo $value['total'] ?></td>
                      <td><?php echo $value['jatuh_tempo'] ?></td>
                    </tr>
                  <?php  } ?>
              <?php endif ?>
            </tbody>
            <tfoot>                  
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>
</section>
<?php $this->load->view("footer"); ?>
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: "yyyy-mm",
    minViewMode: 'months', 
    startView: 'decade',
    startDate : new Date(new Date().getYear() + 1900,0,1)
  }).on('changeMonth', function(e) {
  $(e.currentTarget).data('datepicker').hide();
  });
</script>          