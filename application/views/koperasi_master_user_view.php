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
      <h3 class="box-title">Form Master User</h3>
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
    <form class="form-horizontal" id="form" action="<?php echo base_url() ?>master_User/insertUser" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Account ID</label>
          <div class="col-sm-5">
            <input type="text" name="kode_User" class="form-control" placeholder="[AUTO GENERATED]" id="kode"  readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama User</label>
          <div class="col-sm-5">
            <input name="name" type="text" class="form-control" id="nama" placeholder="Nama">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email User</label>
            <div class="col-sm-5">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email" id="email">
              </div>
            </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Foto Profile</label>
            <div class="col-sm-5">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="file" class="form-control" placeholder="Email" id="foto_profile" name="userfile" accept="image/*">
              </div>
            </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Hak Akses</label>
            <div class="col-sm-5">
              <select name="keterangan" class="form-control select2">
               <option value="root">SUPER USER</option>
               <option value="admin">ADMIN</option>
              </select>
            </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-5">
              <input type="password" style="display:none">
              <input type="password" name="password" class="form-control">
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
                        <th>ACCOUNT ID</th>
                        <th>NAMA USER</th>
                        <th>EMAIL</th>
                        <th>HAK AKSES</th>
                        <th>CREATED TIME</th>
                        <th>LAST LOGIN</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php if (isset($all_user)): ?>
                      <?php foreach ($all_user as $value) { ?>
                      <tr>                   
                        <td><?php echo $value['account_id'] ?></td>
                        <td><?php echo $value['nama'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td><?php echo $value['keterangan'] ?></td>
                        <td><?php echo $value['regdate'] ?></td>
                        <td><?php echo $value['lastlogin'] ?></td>
                        <td width="16%">
                          <a href="#" class="btn btn-default fa fa-edit btn-default btn_edit" data-kode="<?php echo $value['account_id'] ?>" data-nama="<?php echo $value['nama']?>" 
                                data-selected="<?php echo $value['keterangan'] ?>" data-email="<?php echo $value['email'] ?>" >
                            <i class="icon-pencil icon-white"></i> Edit
                          </a>
                          <a href="<?php echo base_url()."master_user/deleteUser/".$value['account_id'] ?>" class="btn btn-default fa fa-trash btn-default" >
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
<style>
  .image-modal {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    display: block;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.5);
    display: none;
  }
  .image-modal .modal-body{
    overflow: auto;
    max-height: 530px;
  }
</style>
<div class="image-modal modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Foto Profile</h4>
      </div>
      <div class="modal-body">
        <img src="" id="profile_img" style="width: 100%">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php $this->load->view("footer"); ?>          
<script type="text/javascript" src="<?php echo base_url()."/asset/my_js/form_validation_anggota.js" ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/scripts_master_user.js"></script>