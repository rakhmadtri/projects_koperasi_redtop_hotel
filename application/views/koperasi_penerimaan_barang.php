<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Penerimaan Barang</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
        <div class="row">
          <form class="form-horizontal" method="post" action="<?php echo base_url()."penerimaan_barang/move_stok" ?>" id="form">
          <div class="col-md-12" style="margin-bottom:50px">
            <div class="col-md-6">  
              <div class="control-group">
                <label class="control-label" for="nobpb">No Transaksi Penerimaan Barang</label>
                <div class="controls">
                  <input type="hidden" name="nobpb" id="nobpb">
                  <span class="form-control uneditable-input">[ AUTO GENERATED ]</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="nopenjualan">No PO</label>
                <div class="controls">
                  <select name="nopo" class="form-control select2" style="width: 100%;" id="nopo">
                    <option value="new">- SELECT PO -</option>
                        <?php foreach ($data_po as $value): ?>
                          <option value="<?php echo $value['order_id'] ?>"><?php echo $value['order_id'] ?></option>
                      <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Tanggal Create PO</label>
                <div class="controls">
                  <span class="form-control uneditable-input" id="tanggal-penjualan"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" >Supplier</label>
                <div class="controls">
                  <span class="form-control uneditable-input" id="pelanggan-penjualan"></span>
                   
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="tanggalkirim">Tanggal Penerimaan</label>
                <div class="controls">
                  <input type="text" name="tanggalkirim" id="tanggalkirim" class="form-control datepicker">
                  <i class="icon-calendar"></i>
                </div>
              </div>
          </div>
              <hr>
              <table class="table table-striped table-bordered padd-bottom" id="detail">
                  <thead>
                      <tr>
                          <th class="span2">Kode Barang</th>
                          <th class="span2">Nama Barang</th>
                          <th class="span2">Harga</th>
                          <th class="span2">Qty</th>
                          <th class="span2">Subtotal</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr class="empty-detail">
                          <td>{data}</td>
                          <td>{data}</td>
                          <td>{data}</td>
                          <td>{data}</td>
                          <td>{data}</td>
                      </tr>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th colspan="4">
                              <div class="text-right">
                                  PPN
                              </div>
                          </th>
                          <td id="ppn">0</td>
                      </tr>
                      <tr>
                          <th colspan="4">
                              <div class="text-right">
                                  Grandtotal
                              </div>
                          </th>
                          <td id="grandtotal">0</td>
                      </tr>
                  </tfoot>
              </table>
              <hr>
              <div class="block-content text-right">
                <button type="submit" name="approve" class="btn">Save</button>
                <button type="reset" name="reject" class="btn">Cancel</button>
              </div>
          </form>
          </div>
      </div>
    </div>
</section>
<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="<?php echo base_url('asset/bootstrap/bootstrap/js/jquery.printPage.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".btnPrint2").printPage();
    })
</script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/select_approve.js"></script>           