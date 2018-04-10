<?php $this->load->view("header"); ?>
<section class="content">
                <?php 
                  $notifikasi = $this->session->flashdata("notifikasi");
                  if($notifikasi!=false){ ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    -Your process <?php echo $notifikasi; ?> is successful! -
                  </div>
                <?php  } ?>
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Transaksi Penarikan</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
        <div class="btn-group">
           <a href="#" class="btn btn-success" id="btn_addnew">Add New <i class="icon-plus icon-white"></i></a>
        </div>
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
    </div><!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form_noHide" action="<?php echo base_url() ?>transaksi_penarikan/insertTransaction" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">No Pengunduran Diri</label>
          <div class="col-sm-5">
             <select name="no_pengunduran" class="form-control select2" style="width: 100%;" id="no_pengunduran" required>
                <option value="">- Pilih -</option>
                <?php foreach ($data_resign as $value): ?>
                  <option value="<?php echo $value['NoPengunduranDiri'] ?>"><?php echo $value['NoPengunduranDiri'] ?></option>
                <?php endforeach ?>
             </select>
          </div>
        </div>
        <input type="hidden" name="no_anggota" value="" id="no_anggota">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-5">
            <span class="form-control uneditable-input" id="nama_anggota"></span>
          </div>
        </div>
        <div id="detail_simpanan">
        <?php if (isset($list_simpanan)): ?>
          <?php foreach ($list_simpanan as $key => $value): ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $value['nama_simpanan'] ?></label>
                <div class="col-sm-5">
                  <input name="simpanan_<?php echo $value['kode_jenis_simpanan'] ?>" type="text" value="" class="form-control" id="simpanan_<?php echo $value['kode_jenis_simpanan'] ?>" placeholder="IDR 0,00" readonly required>
                </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
        </div>
         <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Total Penarikan</label>
          <div class="col-sm-5">
              <input name="total_tarik" type="text" value="" class="form-control" id="total_tarik" placeholder="Total Penarikan" readonly required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
          <div class="col-sm-5">
            <textarea name="keterangan" class="form-control"  placeholder="Keterangan" required id="keterangan" readonly></textarea>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <button type="submit" class="btn btn-info pull-left col-sm-4" id="click">Save</button>
          <button type="reset" class="btn btn-default pull-right col-sm-4">Cancel</button>
        </div>
      </div>
      </form>
<!--         <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Remember me
              </label>
            </div>
          </div>
        </div>
      </div><! -->

  </div>
</section>
<?php $this->load->view("footer"); ?>          
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/tarik.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/currency.js"></script>