<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Master PT</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url() ?>master_pt/insertCabang" id="form_sample_1" class="form-horizontal" method="post">
                        <fieldset>
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <div class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                Your process is successful!
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama PT<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" data-required="1" class="span6 m-wrap"  />
                                    <?php 
                                      $error=$this->session->flashdata("key");
                                    echo $error ?>
                                <input type="hidden" name="kode" data-required="1" class="span6 m-wrap" value="<?php echo (isset($edit_cabang)?$edit_cabang[0]['kode_cabang']:"") ?>" />
                              </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Deskripsi<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="deskripsi" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" onclick="">Save</button>
                                <button type="reset" name="reset" class="btn">Cancel</button>
                            </div>
                        </fieldset>
                    </form>
                    <!-- END FORM-->
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
                        <li><a href="<?php echo base_url() ?>master_cabang/TRUE">Export to Excel</a></li>
                     </ul>
                  </div>
             </div>                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
              <thead>
                  <tr>
                      <th width="15%">NAMA</th>
                      <th width="15%">DESKRIPSI</th>
                
                      <th width="20%">ACTION</th>
                  </tr>
              </thead>
              <tbody>
               <?php if (isset($all_cabang)): ?>
                <?php foreach ($all_cabang as $key => $value) {
                   ?>
                     <tr class="odd gradeX">
                      <td><?php echo $value['nama_cabang'] ?></td>
                      <td><?php echo $value['deskripsi'] ?></td>
                      <td class="center">
                      <a href="#" class="btn btn-primary btn_edit" data-kode="<?php echo $value['kode_cabang']?>"data-nama="<?php echo $value['nama_cabang']?>" data-deskripsi="<?php echo $value['deskripsi']?>">
                            <i class="icon-pencil icon-white"></i> Edit
                          </a>
                          <a href="<?php echo base_url()."master_pt/deleteCabang/".$value['kode_cabang'] ?>" class="btn btn-danger">
                            <i class="icon-remove icon-white"></i> Delete
                          </a>
                      </td>
                    </tr>
                  <?php  } ?>
              <?php endif ?>
              </tbody>
          </table>
</div>
<?php $this->load->view("footer"); ?>