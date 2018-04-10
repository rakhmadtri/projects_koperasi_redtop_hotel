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
      <h3 class="box-title">Form Pembayaran Cicilan</h3>
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
    <form class="form-horizontal" id="form_noHide" action="<?php echo base_url() ?>transaksi_submit_cicilan/submit_cicilan" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">NIK</label>
          <div class="col-sm-5">
              <!-- <?php print_r($data_anggota) ?> -->
              <select name="no_anggota" class="form-control select2" style="width: 100%;" id="nik">
                <option value="">- Pilih -</option>
                <?php foreach ($data_anggota as $value): ?>
                  <option value="<?php echo $value['no_anggota'] ?>"><?php echo $value['nik']." - ".$value['nama'] ?></option>
                <?php endforeach ?>
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">No Pinjaman</label>
          <div class="col-sm-5">
<!--             <select name="no_anggota" class="form-control select2" style="width: 100%;">
                <?php foreach ($data_anggota as $value): ?>
                  <option value="<?php echo $value['no_anggota'] ?>"><?php echo $value['nik']." - ".$value['nama'] ?></option>
                <?php endforeach ?>
              </select> -->
                <!-- <span class="form-control uneditable-input" id="no_pinjaman"></span> -->
                <!-- <input type="text" class="form-control uneditable-input" id="no_pinjaman" name="no_pinjaman" readonly> -->
              <select name="no_pinjaman" class="form-control select2" style="width: 100%;" id="no_pinjaman">
                <option value="">- Pilih -</option>
              </select>
              <input name="order_id" value="" id="order_id" type="hidden">
              <input type="hidden" value="" id="dari_transaksi" name="keterangan">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Angsuran KE - </label>
          <div class="col-sm-2">
              <!-- <span class="form-control uneditable-input" id="angsuran_ke"></span> -->
              <input type="text" class="form-control uneditable-input" id="angsuran_ke" name="angsuran_ke" readonly required>

          </div>
          <div class="col-sm-1">
              <label>- OF -</label>
          </div>
          <div class="col-sm-2">
              <!-- <span class="form-control uneditable-input" id="lama_pinjaman"></span> -->
             <input type="text" class="form-control uneditable-input" id="lama_pinjaman" name="lama_pinjaman" readonly required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
          <div class="col-sm-5">
           <input name="tgl_jatuh_tempo" type="text" class="form-control" required id="jatuh_tempo" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Pembayaran</label>
          <div class="col-sm-5">
           <input name="tgl_pembayaran" type="text" class="form-control datepicker" id="inputEmail3" value="<?php echo date('Y-m-d') ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Pinjaman</label>
          <div class="col-sm-5">
              <input type="text" name="jumlah_pinjaman" class="form-control" placeholder="Jumlah Pinjaman IDR" id="jumlah_pinjaman" disabled>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Sisa Pinjaman</label>
          <div class="col-sm-5">
            <input type="text" name="sisa_angsuran" class="form-control" placeholder="Sisa Angsuran IDR" id="sisa_pinjaman" disabled>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Pembayaran Angsuran</label>
          <div class="col-sm-5">
            <input type="text" name="nominal_angsuran" class="form-control" placeholder="Nominal Pembayaran Angsuran IDR" disabled id="nominal_angsuran">
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
<script type="text/javascript" src="<?php echo base_url()."/asset/my_js/form_validation_anggota.js" ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/scripts_master_general.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/submit_cicilan.js"></script>