<?php $this->load->view("header"); ?>
<style type="text/css">
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  margin: 0; 
  }
</style>
<section class="content">
<iframe name="iframepinjaman" style="display:none"></iframe>
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
      <h3 class="box-title">Form Transaksi Pinjaman</h3>
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
    <form class="form-horizontal" id="form_noHide" action="<?php echo base_url() ?>transaksi_pinjaman/insertTransaction" method="post" target="iframepinjaman">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">No Pinjaman</label>
          <div class="col-sm-5">
            <input type="text" name="no_pinjaman" class="form-control" placeholder="[AUTO GENERATED]" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">No Anggota</label>
          <div class="col-sm-5">
             <select name="no_anggota" class="form-control select2" style="width: 100%;" id="no_anggota" required>
                <option value="">- Pilih -</option>
                <?php foreach ($data_anggota as $value): ?>
                  <option value="<?php echo $value['no_anggota'] ?>"><?php echo $value['nik']." - ".$value['nama'] ?></option>
                <?php endforeach ?>
             </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-5">
            <span class="form-control uneditable-input" id="nama_anggota"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Pinjaman</label>
          <div class="col-sm-5">
           <!--  <input name="jumlah_pinjaman" type="text" class="form-control nominal3" id="jumlah_pinjaman" placeholder="Nominal Pinjaman" autocomplete="off" required> -->
            <input type="hidden" name="total_pinjaman_before" id="total_pinjaman_before" value="0">
             <select name="jumlah_pinjaman" class="form-control select2" style="width: 100%;" id="jumlah_pinjaman" required>
                <option value="">- Pilih -</option>
                <?php foreach ($data_nominal as $value): ?>
                  <option value="<?php echo $value['jumlah_pinjaman'] ?>"><?php echo $value['jumlah_pinjaman'] ?></option>
                <?php endforeach ?>
             </select>
            <div class="error-container">
              <span id="response" class="error">table-striped</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Bunga</label>
          <div class="col-sm-5">
            <input type="text" name="bunga" id="bunga" class="form-control" placeholder="Bunga Dalam satuan IDR" required readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Lama Angsuran</label>
          <div class="col-sm-5">
              <input name="lama_cicilan" type="number" class="form-control" id="lama_cicilan" placeholder="Lama Angsuran" min=1 max=6 required autocomplete="off">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Angsuran</label>
          <div class="col-sm-5">
            <input name="angsuran" type="text" class="form-control" id="angsuran" placeholder="Angsuran Per-Bulan IDR" readonly required>
        </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Keperluan</label>
          <div class="col-sm-5">
            <textarea name="keperluan" class="form-control"  placeholder="Keperluan" required></textarea>
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
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/script_pinjaman.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/currency.js"></script>