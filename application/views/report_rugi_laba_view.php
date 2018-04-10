<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                     <!-- validation -->
<!--                      <?php echo $this->db->last_query() ?> -->
                    <div class="row-fluid">
<!--                     <?php echo $this->db->last_query(); ?> -->
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Laporan Rugi Laba</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url() ?>report/RugiLaba" method="get" class="form-horizontal">
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
                                <label class="control-label">From<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="from" data-required="1" class="input-xlarge datepicker" value="<?php echo (isset($_GET['from'])?$_GET['from']:date("m/d/Y")) ?>" />
                              </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">To<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="to" data-required="1" class="input-xlarge datepicker" value="<?php echo (isset($_GET['to'])?$_GET['to']:date("m/d/Y")) ?>" />
                              </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" onclick="">Submit</button>
                            </div>
                        </fieldset>
                    </form>
                    <!-- END FORM-->
        <div class="block-content collapse in">
            <div class="span12">
               <div class="table-toolbar">
                  <div class="btn-group pull-right">
                     <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Print</a></li>
                        <li><a href="#">Save as PDF</a></li>
                        <li><a href="#">Export to Excel</a></li>
                     </ul>
                  </div>
             </div>                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
              <thead>
                  <tr>
                      <th width="20%">KODE BARANG</th>
                      <th width="20%">NAMA BARANG</th>
                      <th >Total Penjualan</th>
                      <th >Total Pembelian</th>
                      <th >KEUNTUNGAN BY PRODUCT</th>
                  </tr>
              </thead>
              <tbody>
               <?php if (isset($all_rugilaba)): ?>
                <?php foreach ($all_rugilaba as $key => $value) {
                   ?>
                     <tr class="odd gradeX">
                      <td><?php echo $value['kode_barang'] ?></td>
                      <td><?php echo $value['nama_barang'] ?></td>
                      <td><?php echo $value['total_jual'] ?></td>
                      <td><?php echo $value['total_beli'] ?></td>
                      <td><?php echo $value['keuntungan'] ?></td>
                    </tr>
                  <?php  } ?>
              <?php endif ?>
              </tbody>
          </table>
</div>
<?php $this->load->view("footer"); ?>                
