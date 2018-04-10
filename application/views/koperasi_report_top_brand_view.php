<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report Top Brand</h3>
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
              <li><a href="<?php echo base_url()."report_top_brand/xls/export_to_xls?from="?><?php echo (!empty($_GET['from'])?$_GET['from']:""); echo (!empty($_GET['to'])?'&to='.$_GET['to']:""); ?>">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_top_brand" method="get">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">From</label>
          <div class="col-sm-3">
            <input type="text" name="from" class="form-control datepicker" value="<?php echo isset($_GET['from'])?$_GET['from']:"" ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label" id="name">To</label>
          <div class="col-sm-3">
            <input type="text" name="to" class="form-control datepicker" value="<?php echo isset($_GET['to'])?$_GET['to']:"" ?>">
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
                        <th width="20%">KODE BARANG</th>
                        <th width="20%">NAMA BARANG</th>
                        <th >HARGA BELI</th>
                        <th >HARGA JUAL</th>
                        <th >QTY JUAL</th>
                        <th >TOTAL KEUNTUNGAN</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($all_brand)): ?>
                      <?php foreach ($all_brand as $key => $value) {
                    ?>
                     <tr class="odd gradeX">
                      <td><?php echo $value['kode_barang'] ?></td>
                      <td><?php echo $value['nama_barang'] ?></td>
                      <td><?php echo $value['buying_price'] ?></td>
                      <td><?php echo $value['selling_price'] ?></td>
                      <td><?php echo $value['qty_jual'] ?></td>
                      <td><?php echo $value['keuntungan'] ?></td>
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