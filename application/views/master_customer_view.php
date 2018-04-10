<?php $this->load->view("header");?>
<div class="span9" id="content">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Master Customer</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                    <!-- BEGIN FORM-->
                      <!-- perhatikan setiap id pada form ,karna efek nya berbeda2-->
                        <form action="<?php echo base_url() ?>master_customer/insertCustomer" id="form_sample_1" class="form-horizontal" method="post">
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <div class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                Your process is successful!
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Toko<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" data-required="1" class="span6 m-wrap" value="<?php echo (isset($edit_customer)?$edit_customer[0]['nama_customer']:"") ?>" />
                                <input type="hidden" name="kode" data-required="1" class="span6 m-wrap" value="<?php echo (isset($edit_customer)?$edit_customer[0]['kode_customer']:"") ?>" />
                              </div>
                            </div>
                            <div class="control-group"> 
                              <label class="control-label" id="master" for="master">Induk Perusahaan</label>
                              <div class="controls">
                                <select name="master" id="master" class="input-xlarge chzn-select">
                                  <?php foreach ($master_cabang as $key => $value): ?>
                                    <option value="<?php echo $value['kode_cabang'] ?>" id="perusahaan"><?php echo $value['nama_cabang'] ?></option>
                                  <?php endforeach ?>
                                </select>                      
                              </div>
                            </div>
                            <div class="control-group"> 
                              <label class="control-label" id="master" for="master">Kota </label>
                              <div class="controls">
                                <select name="master_kota" id="master_kota" class="input-xlarge chzn-select">
                                  <?php foreach ($master_kota as $key => $value): ?>
                                    <option value="<?php echo $value['kota_id'] ?>" id="category"><?php echo $value['kokab_nama'] ?></option>
                                  <?php endforeach ?>
                                </select>                      
                              </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="email" type="text" class="span6 m-wrap" value="<?php echo (isset($edit_customer)?$edit_customer[0]['email']:"") ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Telfon<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="number" type="text" class="span6 m-wrap" value="<?php echo (isset($edit_customer)?$edit_customer[0]['no_telfon']:"") ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Alamat<span class="required">*</span></label>
                              <div class="controls">
                                <textarea class="span6 m-wrap" name="alamat"><?php echo (isset($edit_customer)?$edit_customer[0]['alamat']:"") ?></textarea>
                              </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" onclick="">Save</button>
                                <button type="reset" name="reset" class="btn">Cancel</button>
                            </div>
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
                        <li><a href="<?php echo base_url() ?>master_customer/TRUE">Export to Excel</a></li>
                     </ul>
                  </div>
             </div>                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
              <thead>
                  <tr>
                      <th width="15%">NAMA</th>
                      <th width="15%">EMAIL</th>
                      <th>TELFON</th>
                      <th width="30%">ALAMAT</th>
                      <th width="20%">ACTION</th>
                  </tr>
              </thead>
              <tbody>
<!--               <?php echo print_r($all_customer) ?> -->
               <?php if (isset($all_customer)): ?>
                <?php foreach ($all_customer as $key => $value) {
                   ?>
                     <tr class="odd gradeX">
                      <td><?php echo $value['nama_customer'] ?></td>
                      <td><?php echo $value['email'] ?></td>
                      <td><?php echo $value['no_telfon'] ?></td>
                      <td class="center"><?php echo $value['alamat']; ?></td>
                      <td class="center">
                          <a href="#" class="btn btn-primary btn_edit" data-kode="<?php echo $value['kode_customer']?>" data-nama="<?php echo $value['nama_customer']; ?>" data-email="<?php echo $value['email']; ?>" data-no-telfon="<?php echo $value['no_telfon']; ?>" data-alamat="<?php echo $value['alamat']?>" >
                            <i class="icon-pencil icon-white"></i> Edit
                          </a>
                          <a href="<?php echo base_url()."master_customer/deleteCustomer/".$value['kode_customer'] ?>" class="btn btn-danger">
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