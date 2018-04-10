<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Laporan Transaksi Penjualan</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url() ?>report/TransaksiPenjualan" method="get" class="form-horizontal">
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
                            <div class="control-group">
                                <label class="control-label">Status Pembayaran<span class="required">*</span></label>
                                <div class="controls">
                                  <select name="statusPembayaran">
                                        <option value=""  id="category">- All -</option>
                                        <option value="2" id="category">Lunas</option>
                                        <option value="1" id="category">Invoice</option>
                                        <option value="0">Pending</option>
                                  </select>
                                </div>
                            </div>
                            <div class="control-group"> 
                              <label class="control-label" id="master" for="master">Kota </label>
                              <div class="controls">
                                <select name="master_kota" id="master_kota" class="input chzn-select">
                                  <option value="" id="category">- Berdasarkan Provinsi -</option>
                                  <?php foreach ($master_kota as $key => $value): ?>
                                    <option value="<?php echo $value['kota_id'] ?>" id="category"><?php echo $value['kokab_nama'] ?></option>
                                  <?php endforeach ?>
                                </select>                      
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
                      <th width="10%">Order ID</th>
                      <th width="18%">Order Timestamp</th>
                      <th >Kota</th>
                      <th >Nama PT </th>
                      <th >Customer</th>
                      <th >Total</th>
                      <th >Status</th>
                      <th >Action</th>
                  </tr>
              </thead>
              <tbody>
               <?php if (isset($all_penjualan)): ?>
               
                <?php foreach ($all_penjualan as $key => $value) {
                   ?>
                     <tr class="odd gradeX">
                      <td><?php echo $value['order_id'] ?></td>
                      <td><?php echo $value['order_timestamp'] ?></td>
                      <td><?php echo $value['kokab_nama'] ?></td>
                      <td><?php echo $value['nama_cabang'] ?></td>
                      <td><?php echo $value['nama_customer'] ?></td>
                      <td><?php echo $value['total_customer_price'] ?></td>
                      <td>
                          <?php 
                              echo $value['payment_flag']==2?"<b>Lunas</b>":"</b>Pending</b>";
                           ?>

                      </td>
                      <td>
                        <?php if ($value['payment_flag']!=2) { ?>
                           <a class="btn btn-mini" href="<?php echo base_url()."transaksi_penjualan?trxid=".$value['order_id']  ?> ">
                              <i class="icon-refresh" ></i> Edit</a>
                        <?php } ?>
                        <a class="btn btn-mini" href="<?php echo base_url()."transaksi_penjualan/viewTransaksiPenjualan/".$value['order_id']  ?> ">
                          <i class="icon-eye-open"></i> View</a>
                      </td>
                    </tr>
                  <?php  } ?>
              <?php endif ?>
              </tbody>
          </table>
</div>
<?php $this->load->view("footer"); ?>                
