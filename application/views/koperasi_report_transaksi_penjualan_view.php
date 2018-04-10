<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report Penjualan</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
        <div class="btn-group pull-right">
           <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
           <ul class="dropdown-menu">
              <li><a href="#">Print</a></li>
              <li><a href="<?php echo base_url() ?>report_transaksi_penjualan/pdf/?from=<?php echo isset($_GET['from'])?$_GET['from']:""; ?>&to=<?php echo isset($_GET['to'])?$_GET['to']:""; ?>">Save as PDF</a></li>
              <li><a href="<?php echo base_url() ?>report_transaksi_penjualan/xls/?from=<?php echo isset($_GET['from'])?$_GET['from']:""; ?>&to=<?php echo isset($_GET['to'])?$_GET['to']:""; ?>">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_transaksi_penjualan" method="get">
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
                  <h3 class="box-title">Data</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped datatable">
                    <thead>
                      <tr>
                        <th width="10%">Order ID</th>
                        <th width="18%">Timestamp</th>
                        <th >Customer</th>
                        <th> Cash</th>
                        <th> Kredit</th>
                        <th> Total Transaksi</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($all_penjualan)): ?>
                      <?php foreach ($all_penjualan as $key => $value) {
                        ?>
                    <tr class="odd gradeX">
                      <td><?php echo $value['order_id'] ?></td>
                      <td><?php echo $value['order_timestamp'] ?></td>
                      <td><?php if($value['nama_anggota']!= null){ echo $value['nama_anggota'];}else{ echo "New Customer";} ?></td>
                      <td><?php echo $value['cash'] ?></td>
                       <td><?php echo $value['kredit'] ?></td>
                      <td><?php echo $value['total_after_ppn'] ?></td>
                      <td>
                        <!-- <a class="btn btn-mini view-detail" href="<?php echo base_url()."transaksi_penjualan/viewTransaksiPenjualan/".$value['order_id']  ?> "> -->
                        <button class="btn btn-default fa fa-gg-circle view-detail" value="<?php echo $value['order_id'] ?>">
                          Detail
                        </button>
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

<div class="modal fade" id="myModal">
<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title"><span value="samuel erwardi" id="title_shu"></span></h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-3">Order ID</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="order_id"></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Tanggal</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="tanggal_transaksi">Testes</div>
          </div>
          <div class="row">
            <div class="col-sm-3">Pelanggan</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="pelanggan">Testes</div>
          </div>
          <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Sub Total</th>
              </tr>
            </thead>
            <tbody id="mutasi_anggota">
              
            </tbody>
            <tfoot>
              <!-- <tr>
                <td colspan="4">
                  <div class="text-right">Total</div>
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <div class="text-right">PPN</div>
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <div class="text-right">Grand Total</div>
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <div class="text-right">Grand Total</div>
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <div class="text-right">Grand Total</div>
                </td>
              </tr> -->
             
            </tfoot>
          </table>
          <div class="form-group">
            <div class="clearfix"></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Total</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="total"></div>
          </div>
          <div class="row">
            <div class="col-sm-3">PPN</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="ppn"></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Grand Total</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="grand_total"></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Cash</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="cash"></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Kredit</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="kredit"></div>
          </div>
    </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="<?php echo base_url()."asset/my_js/report_penjualan.js" ?>"></script>         
      