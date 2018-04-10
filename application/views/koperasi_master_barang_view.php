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
      <h3 class="box-title">Form Master Barang</h3>
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
    <form class="form-horizontal" id="form" action="<?php echo base_url() ?>master_barang/insertProduct" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>
          <div class="col-sm-5">
            <input type="text" name="kode_barang" class="form-control primarykey" placeholder="Kode Barang" id="kode" required >
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail13" class="col-sm-2 control-label">Jenis Barang</label>
          <div class="col-sm-5">
            <select class="form-control select" name="product_type">
              <option value="product">Product</option>
              <option value="jasa">Jasa</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>
          <div class="col-sm-5">
            <input name="nama_barang" type="text" class="form-control" id="nama" placeholder="Nama" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Harga Beli</label>
          <div class="col-sm-5">
            <input name="harga_beli" type="text" class="form-control harga_beli" id="nominal" placeholder="Harga Beli" required>
        </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Keuntungan</label>
          <div class="col-sm-5">
            <input name="presentase" type="text" class="form-control keuntungan" id="nominal2" placeholder="Keuntungan IDR">
        </div>
        </div>
         <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Harga Jual</label>
          <div class="col-sm-5">
            <input name="harga_jual" type="text" class="form-control" id="harga_jual" placeholder="Harga Jual" readonly>
        </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
          <div class="col-sm-5">
            <textarea name="deskripsi" class="form-control"  placeholder="deskripsi" id="deskripsi"></textarea>
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
                        <th>KODE BARANG</th>
                        <th>NAMA BARANG</th>
                        <th>DESKRIPSI</th>
                        <th>KEUNTUNGAN</th>
                        <th>CREATED TIME</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php if (isset($all_product)): ?>
                      <?php foreach ($all_product as $value) { ?>
                      <tr>                   
                        <td><?php echo $value['kode_barang'] ?></td>
                        <td><?php echo $value['nama_barang'] ?></td>
                        <td><?php echo $value['deskripsi'] ?></td>
                        <td><?php echo $value['presentase'] ?></td>
                        <td><?php echo $value['created_timestamp'] ?></td>
                        <td width="16%">
                            <a href="#" class="btn btn-default fa fa-edit btn-default btn_edit" data-kode="<?php echo $value['kode_barang'] ?>" data-selecttype=<?php echo $value['type'] ?> data-nama="<?php echo $value['nama_barang'] ?>" 
                                data-deskripsi="<?php echo $value['deskripsi']?>" data-presentase="<?php echo $value['presentase'] ?>" data-beli="<?php echo $value['harga_beli'] ?>" data-jual="<?php echo $value['harga_jual'] ?>" >
                            <i class="icon-pencil icon-white"></i> Edit
                            </a>
                          <a href="<?php echo base_url()."master_barang/deletebarang/".$value['kode_barang'] ?>" class="btn btn-default fa fa-trash btn-default" >
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
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/currency_master_barang.js"></script> 
<script type="text/javascript" src="<?php echo base_url()."/asset/my_js/form_validation_barang.js" ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/scripts_master_barang.js"></script>