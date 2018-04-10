<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Generated Invoice</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                    <!-- BEGIN FORM-->
                  <form action="<?php echo base_url() ?>master_user/insertUser" id="form_sample_1" class="form-horizontal" method="post">
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
                                <label class="control-label">Nama<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" data-required="1" class="span6 m-wrap"  />
                                <input type="hidden" name="kode" data-required="1" class="span6 m-wrap" />
                              </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="email" type="text" class="span6 m-wrap" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="password" type="password" required class="span6 m-wrap" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Confirm Password<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="confirm_password" type="password" class="span6 m-wrap" required/>
                                </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Status<span class="required">*</span></label>
                              <div class="controls">
                                <input type="checkbox" name="status" value="1" > *<u>Active</u>
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
<!--                   <div class="btn-group">
                     <a href="#" class="btn btn-success" id="btn_addnew">Add New <i class="icon-plus icon-white"></i></a>
                  </div> -->
                  <div class="btn-group pull-right">
                     <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Print</a></li>
                        <li><a href="#">Save as PDF</a></li>
                        <li><a href="<?php echo base_url() ?>master_user/TRUE">Export to Excel</a></li>
                     </ul>
                  </div>
             </div>                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
              <thead>
                  <tr>
                    <th width="15%">No INVOICE</th>
                    <th width="15%">ORDER ID</th>
                    <th width="18%">GRAND TOTAL</th>
                    <th width="5%">ACTION</th>

                  </tr>
              </thead>
              <tbody>
               <?php if (isset($all_invoice)): ?>
                <?php foreach ($all_invoice as $key => $value) {
                   ?>
                     <tr class="odd gradeX">
                      <td><?php echo $value['no_invoice'] ?></td>
                      <td><?php echo $value['order_id'] ?></td>
                      <td class="center"><?php echo $value['payment_amount'] ?></td>
                      <td valign="center">
                          <?php 
                            if($value['payment_flag']==0){ ?>
                              <a style="width:70px" href="invoice/<?php echo $value['order_id']?>/1" class="btn btnPrintInvoice">
                                <i class="icon-print"></i>Invoice
                              </a>
                          <?php  }
                            else if ($value['payment_flag']==1) { ?>
                              <a style="width:70px" href="invoice/<?php echo $value['order_id']?>/2" class="btn btnPrintInvoice" >
                                <i class="icon-print"></i>Kwitansi
                              </a>
                          <?php  } 
                            else{ ?><b>&check; COMPLETED</b><?php  } ?>
                      </td>
                    </tr>
                  <?php  } ?>
              <?php endif ?>
              </tbody>
          </table>
</div>
<?php $this->load->view("footer"); ?>                
<script type="text/javascript" src="<?php echo base_url('asset/bootstrap/bootstrap/js/jquery.printPage.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".btnPrintInvoice").printPage();
    })
</script>