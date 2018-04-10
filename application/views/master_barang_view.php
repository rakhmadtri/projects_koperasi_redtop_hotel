<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Master Barang</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url() ?>master_barang/insertProduct" id="form_sample_1" class="form-horizontal" method="post">
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
                                <label class="control-label">Kode Barang<span class="required">*</span></label>
                                  <div class="controls">
<!--                                     <span class="input-xlarge uneditable-input">[ AUTO GENERATED ]</span> -->
                                    <input type="text" name="kode_barang" data-required="1" class="span6 m-wrap"  />
                                  </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Barang<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" data-required="1" class="span6 m-wrap"  />
                                <input type="hidden" name="kode" data-required="1" class="span6 m-wrap" />
                              </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Category<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="category" class="span6 m-wrap" id="combolicense" >
                                      <option value="A-PRODUCT" id="category">Product</option>
                                      <option value="SPARE_PART" id="category">Spare Part</option>
                                      <option value="JASA" id="category">Jasa</option>
                                      <option value="TRANSPORT">Transport</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" id="license">
                                <label class="control-label">License <span class="required">*</span></label>
                                <div class="controls">
                                <input type="text" name="license" data-required="1" class="span6 m-wrap" />
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Deskripsi<span class="required">*</span></label>
                              <div class="controls">
                                <textarea class="span6 m-wrap" name="deskripsi"></textarea>
                              </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="status" type="checkbox" value="1"/> *<u>Active</u>
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
                        <li><a href="<?php echo base_url() ?>master_barang/TRUE">Export to Excel</a></li>
                     </ul>
                  </div>
             </div>    
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                <thead>
                    <tr>
                          <th width="10%">KODE</th>
                          <th width="15%">CATEGORY</th>
                          <th width="23%">NAMA</th>
                          <th width="25%">DESKRIPSI</th>
                          <th>STATUS</th>
                          <th width="20%">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                 <?php if (isset($all_product)): ?>
                  <?php foreach ($all_product as $key => $value) {
                     ?>
                       <tr class="odd gradeX">
                        <td><?php echo $value['kode_barang'] ?></td>
                        <td><?php echo $value['category'] ?></td>
                        <td><?php echo $value['nama_barang'] ?></td>
                        <td><?php echo $value['deskripsi'] ?></td>
                        <td class="center"><?php echo $value['status'] ?></td>
                        <td class="center">
                            <a href="#" class="btn btn-primary btn_edit" data-kode="<?php echo $value['kode_barang']?>"  data-license="<?php echo $value['license'] ?>"  data-nama="<?php echo $value['nama_barang']?>" data-category="<?php echo $value['category']?>" data-deskripsi="<?php echo $value['deskripsi']?>" data-status="<?php echo $value['status']?>" data-status-checked="<?php echo $value['status']==1?"checked":"";  ?>">
                              <i class="icon-pencil icon-white"></i> Edit
                            </a>
                            <a href="<?php echo base_url()."master_barang/deleteBarang/".$value['kode_barang'] ?>" class="btn btn-danger">
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
<script src="<?php echo base_url() ?>asset/bootstrap/assets/scripts_master_barang.js"></script>
<script type="text/javascript">
  $(function(){
    $("#combolicense").change(function(){
      if ($(this).val()=="A-PRODUCT") {
        $("#license").fadeIn();
      } 
      else{
        $("#license").fadeOut();
      };
    });
  });
</script>