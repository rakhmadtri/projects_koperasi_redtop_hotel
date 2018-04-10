<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report Simpanan</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
        <div class="btn-group pull-right">
           <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
           <ul class="dropdown-menu">
              <li><a href="#">Print</a></li>
              <li><a href="#">Save as PDF</a></li>
              <li><a href="<?php echo base_url()."report_transaksi_simpanan/xls/?from="?><?php echo (!empty($_GET['from'])?$_GET['from']:""); echo (!empty($_GET['to'])?'&to='.$_GET['to']:""); echo (!empty($_GET['nama_simpanan'])?'&nama_simpanan='.$_GET['nama_simpanan']:""); ?>">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div>
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_transaksi_simpanan" method="get">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">From</label>
          <div class="col-sm-3">
            <input type="text" name="from" class="form-control datepicker">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">To</label>
          <div class="col-sm-3">
            <input type="text" name="to" class="form-control datepicker">
          </div>
        </div>
         <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label" id="name">Jenis Simpanan</label>
               <div class="col-sm-3">
             <select name="nama_simpanan" class="form-control select2" style="width: 100%;" required>
                <option value="">- Pilih -</option>
                <?php foreach ($jenis_simpan as $value): ?>
                  <option value="<?php echo $value['nama_simpanan'] ?>"><?php echo $value['nama_simpanan'] ?></option>
                <?php endforeach ?>
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
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped datatable">
                    <thead>
                      <tr>
                        <th width="10%">Kode</th>
                        <th width="18%">Timestamp</th>
                        <th >No. Anggota</th>
                        <th> Nama</th>
                        <th> Simpanan</th>
                        <th> Jumlah</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($all_simpanan)): ?>
                      <?php foreach ($all_simpanan as $key => $value) {
                        ?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['kode_simpanan_detail'] ?></td>
                      <td><?php echo $value['tgl_simpan'] ?></td>
                      <td><?php echo $value['no_anggota'] ?></td>
                      <td><?php echo $value['nama'] ?></td>
                      <td><?php echo $value['nama_simpanan'] ?></td>
                      <td><?php echo $value['total_simpanan'] ?></td>
                      <td><a class="btn btn-mini" href="#">
                        <i class="icon-eye-open"></i> View</a></td>
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