<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report Pembelian</h3>
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
              <li><a href="<?php echo base_url() ?>report_transaksi_pembelian/xls/?from=<?php echo isset($_GET['from'])?$_GET['from']:""; ?>&to=<?php echo isset($_GET['to'])?$_GET['to']:""; ?>">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_transaksi_pembelian" method="get">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">From</label>
          <div class="col-sm-3">
            <input type="text" name="from" class="form-control datepicker">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">To</label>
          <div class="col-sm-3">
            <input type="text" name="to" class="form-control datepicker">
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <button type="submit" class="btn btn-info pull-left col-sm-4" id="click">Submit</button>
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
                        <th width="10%">Order ID</th>
                        <th width="18%">Timestamp</th>
                        <th >Supplier</th>
                        <th> Total Items</th>
                        <th> Total Transaksi</th>
                        <th >Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($all_pembelian)): ?>
                      <?php foreach ($all_pembelian as $key => $value) {
                        ?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['order_id'] ?></td>
                      <td><?php echo $value['order_timestamp'] ?></td>
                      <td><?php echo $value['nama_supplier'] ?></td>
                      <td></td>
                      <td><?php echo $value['total_transaksi'] ?></td>
                      <td><?php echo $value['status'] ?></td>
                      <td><a class="btn btn-mini" href="<?php echo base_url()."transaksi_pembelian/viewTransaksiPembelian/".$value['order_id']  ?> ">
                        <i class="icon-eye-open"></i> View</a></td>
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