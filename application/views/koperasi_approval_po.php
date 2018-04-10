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
      <h3 class="box-title">Form Approval PO</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
        <div class="btn-group">
           <!-- <a href="#" class="btn btn-success" id="btn_addnew">Add New <i class="icon-plus icon-white"></i></a> -->
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
    </div>
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped datatable">
                    <thead>
                      <tr>
                        <th>NO PO</th>
                        <th>USER CREATED</th>
                        <th>NAMA SUPPLIER</th>
                        <th>TOTAL TRANSAKSI</th>
                        <th>PO CREATED TIME</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php if (isset($data_po)): ?>
                      <?php foreach ($data_po as $value) { ?>
                      <tr>                   
                        <td><?php echo $value['order_id'] ?></td>
                        <td><?php echo $value['nama'] ?></td>
                        <td><?php echo $value['nama_supplier'] ?></td>
                        <td><?php echo $value['total_transaksi'] ?></td>
                        <td><?php echo $value['order_timestamp'] ?></td>
                        <td width="16%">
                          <a href="<?php echo base_url()."transaksi_pembelian/".$value['order_id'] ?>" class="btn btn-default btn-default fa fa-shopping-cart" >
                            <i class="icon-pencil icon-white"></i> Decision
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
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/scripts_master_general.js"></script>