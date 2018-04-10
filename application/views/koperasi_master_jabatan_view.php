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
      <h3 class="box-title">Form Master Jabatan</h3>
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
    <form class="form-horizontal" id="form" action="<?php echo base_url() ?>master_jabatan/insertJabatan" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kode Jabatan</label>
          <div class="col-sm-5">
            <input type="text" name="kode_jabatan" class="form-control" placeholder="[AUTO GENERATED]" id="kode"  readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Jabatan</label>
          <div class="col-sm-5">
            <input name="nama_jabatan" type="text" class="form-control" id="nama" placeholder="Nama">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
          <div class="col-sm-5">
            <textarea name="keterangan" class="form-control"  placeholder="Keterangan" id="keterangan"></textarea>
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
      <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped datatable">
                    <thead>
                      <tr>
                        <th>KODE JABATAN</th>
                        <th>NAMA JABATAN</th>
                        <th>KETERANGAN</th>
                        <th>CREATED TIME</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php if (isset($all_jabatan)): ?>
                      <?php foreach ($all_jabatan as $value) { ?>
                      <tr>                   
                        <td><?php echo $value['kode_jabatan'] ?></td>
                        <td><?php echo $value['nama_jabatan'] ?></td>
                        <td><?php echo $value['keterangan'] ?></td>
                        <td><?php echo $value['created_time'] ?></td>
                        <td width="16%">
                           <a href="#" class="btn btn-default fa fa-edit btn-default btn_edit" data-kode="<?php echo $value['kode_jabatan'] ?>" data-nama="<?php echo $value['nama_jabatan'] ?>" 
                                data-keterangan="<?php echo $value['keterangan']?>" >
                            <i class="icon-pencil icon-white"></i> Edit
                          </a>
                          <a href="<?php echo base_url()."master_jabatan/deleteJabatan/".$value['kode_jabatan'] ?>" class="btn btn-default fa fa-trash btn-default" >
                            <i class="icon-pencil icon-white"></i> Delete
                          </a>
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
<?php $this->load->view("footer"); ?>          
<script type="text/javascript" src="<?php echo base_url()."/asset/my_js/form_validation_anggota.js" ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/scripts_master_departemen.js"></script>