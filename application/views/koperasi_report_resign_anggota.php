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
<!--          <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label" id="name">Jenis Simpanan</label>
               <div class="col-sm-3">
             <select name="nama_simpanan" class="form-control select2" style="width: 100%;" required>
                <option value="">- Pilih -</option>
                <?php foreach ($jenis_simpan as $value): ?>
                  <option value="<?php echo $value['nama_simpanan'] ?>"><?php echo $value['nama_simpanan'] ?></option>
                <?php endforeach ?>
             </select>
             </div>
          </div> -->
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
                        <th width="20%">No Pengunduran Diri</th>
                        <th width="14%">No. Anggota</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Nama Departemen</th>
                        <th>Jabatan</th>
                        <th>Nominal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list_resign)): ?>
                      <?php foreach ($list_resign as $key => $value) {
                        ?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['NoPengunduranDiri'] ?></td>
                      <td><?php echo $value['no_anggota'] ?></td>
                      <td><?php echo $value['nik'] ?></td>
                      <td><?php echo $value['nama'] ?></td>
                      <td><?php echo $value['nama_departemen'] ?></td>
                      <td><?php echo $value['nama_jabatan'] ?></td>
                      <td><?php echo $value['jumlah_penarikan'] ?></td>
<!--                       <td><?php echo $value['jumlah_simpanan'] ?></td> -->
                      <td>
                        <button href="#myModal" id="openBtn" data-toggle="modal" data-id="<?php echo $value['no_anggota']; ?>" class="btn btn-default fa fa-gg-circle btn-default">
                          <i class="icon-pencil icon-white"></i> View Detail
                        </button>
                      </td>
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
<div class="image-modal modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Mutasi</h4>

      </div>
      <div class="modal-body">
        <!-- <img src="" id="profile_img" style="width: 100%"> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
<div class="modal fade" id="myModal">
<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title"><span value="samuel erwardi" id="title_shu"></span></h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-3">No Anggota</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="no_anggota">Testes</div>
          </div>
          <div class="row">
            <div class="col-sm-3">Nama Anggota</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="nama_anggota">Testes</div>
          </div>
          <div class="row">
            <div class="col-sm-3">TOTAL PENARIKAN</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="saldo_total">0,00</div>
          </div>
          <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th>KODE JENIS SIMPANAN</th>
                <th>NAMA JENIS SIMPANAN</th>
                <th class="text-right">NOMINAL</th>
              </tr>
            </thead>
            <tbody id="mutasi_anggota">
              
            </tbody>
          </table>
          <div class="form-group">
            <hr>
              <tr>
                <th class="text-right">GRAND TOTAL</th>
                <th>:</th>
                <th class="text-right"><span id="grandTotal"></span></th>
              </tr>
            <hr>
            <div class="clearfix"></div>
          </div>
    </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->   
<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/script_report_resign_anggota.js"></script>            