<?php 
$this->load->view("header");?>
<iframe name="iframecetakpo" style="display:none"></iframe>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Pemesanan Barang</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="row">
        <form class="form-horizontal" method="post" action="transaksi_pembelian/insertTransaction" id="form" target="iframecetakpo">
            <input type="hidden" value="<?php echo (isset($_GET['trxid'])?$_GET['trxid']:""); ?>" name="trxid">
            <div class="col-md-12" style="margin-bottom:50px">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">No PO</label>
                        <div class="col-md-6">
                            <input type="text" name="nopenjualan" id="tanggalpenjuaalan" class="form-control " disabled value="AUTO GENERATED">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Tanggal Created PO</label>
                          <div class="col-md-6">
                            <input type="text" name="tanggalpenjualan" id="tanggalpenjualan" class="form-control datepicker" disabled value="<?php echo date('Y/m/d'); ?>">
                          </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Supplier</label>
                          <div class="col-md-6">
                            <input type="hidden" name="kodesupplier" id="kodesupplier">
                            <input type="text" name="namasupplier" id="namasupplier" class="form-control " required>
                          </div>
                    </div>
                </div>  
            </div>
            <hr>
            <div class="col-md-12">
                <div class="col-md-2">
                    <label for="kodebarang">Kode Barang</label>
                    <input type="text" id="kodebarang" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="namabarang">Nama Barang</label>
                    <span id="namabarang" class="form-control uneditable-input"></span>
                </div>
                <div class="col-md-2">
                    <label for="harga">Harga</label>
                     <span id="harga" class="form-control uneditable-input"></span>
                     <input type="hidden" id="category" class="form-control" autocomplete="off">
                      <!-- <input type="text" id="harga" class="form-control" autocomplete="off"> -->
                </div>

                <div class="col-md-2">
                    <label for="qty">Qty</label>
                    <input type="text" id="qty" name="qty" class="form-control" autocomplete="off">
                    <div class="error-container">
                        <span id="response" class="error">test</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="subtotal">Subtotal</label>
                    <span id="subtotal" class="form-control uneditable-input">0</span>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <a href="#" class="btn btn-success form-control" id="tambah"><i class="icon-plus icon-white"></i>Tambah</a>
                </div>
            </div>
            <div class="col-md-12">
                    <table class="table table-striped table-bordered padd-bottom" id="detail">
                <thead>
                    <tr>
                        <th class="col-md-2">Kode Barang</th>
                        <th class="col-md-2">Nama Barang</th>
                        <th class="col-md-2">Harga</th>
                        <th class="col-md-2">Qty</th>
                        <th class="col-md-2">Subtotal</th>
                        <th class="col-md-2"></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!isset($detail_penjualan)){ ?>
                    <tr class="empty-detail">
                        <td colspan="6">Detail masih kosong</td>
                    </tr>
                <?php }else {
                    foreach ($detail_penjualan as $key => $value) { ?>
                    <tr>
                        <td class="col-md-2"><input type="hidden" name="kodebarang[]" value="<?php echo $value['kode_barang']; ?>"><?php echo $value['kode_barang'] ?></td>
                        <td class="col-md-2"><input type="hidden" name="namabarang[]" value="<?php echo $value['nama_barang']; ?>"><?php echo $value['nama_barang'] ?></td>
                        <td class="col-md-2"><input type="hidden" name="harga[]" value="<?php echo $value['selling_price']; ?>"><?php echo $value['selling_price'] ?></td>
                        <td class="col-md-2"><input type="hidden" name="qty[]" value="<?php echo $value['qty']; ?>"><?php echo $value['qty'] ?></td>                                                                                                        
                        <td class="col-md-2"><input type="hidden" name="subtotal[]" value="<?php echo $value['sub_total']; ?>"><?php echo $value['sub_total'] ?></td>
                        <td class="col-md-2"><a href="#" class="btn btn-danger form-control remove" data-id="'+$("#kodebarang").val()+'"><i class="icon-remove icon-white"></i>Remove</a></td>
<!--                                                     <td class="col-md-2"><a href="<?php echo base_url()."transaksi_pembelian/delete_detail_transaksi2?trxid=".$_GET['trxid']."&kodebarang=".$value['kode_barang'] ?>" class="btn btn-danger form-control remove"><i class="icon-remove icon-white"></i>Remove</a></td> -->
                    </tr>
                <?php  } } ?>
<!--                                                  <tr class="empty-detail">
                    <?php 
                        if (isset($detail_penjualan)) {  ?>
                            <?php foreach ($detail_penjualan as $key => $value) { ?>
                        <input type="text" name="kodebarang[]" value="<?php echo $value['kode_barang']; ?>">
                        <input type="text" name="namabarang[]" value="<?php echo $value['nama_barang'];?>">
                    <?php }  } ?>
                    </tr> -->
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Grandtotal
                            </div>
                        </th>
                        <td colspan="2" id="grandtotal">
                            <input type="hidden" name="grandtotal" value="<?php echo (isset($detail_pembelian[0]['total_supplier_price'])?$detail_pembelian[0]['total_supplier_price']:0); ?>">
                            <?php echo (isset($detail_pembelian[0]['total_supplier_price'])?$detail_pembelian[0]['total_supplier_price']:0); ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                PPN
                            </div>
                        </th>
                        <td colspan="2">
                            <input type="text" required min="0" name="pph" id="pph" class="form-control" autocomplete="off" value="<?php echo (isset($detail_pembelian[0]['pph'])?$detail_pembelian[0]['pph']:""); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Harga setelah PPN
                            </div>
                        </th>
                            <td colspan="2" id="afterpph"><?php echo (isset($detail_pembelian[0]['total_supplier_price'])?$detail_pembelian[0]['total_supplier_price']+$detail_penjualan[0]['total_customer_pph']:0) ?></td>
                    </tr>
                </tfoot>
            </table>
            </div>


            <hr>
            <div class="col-md-12">
                <div class="block-content text-right" style="padding:20px">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</section>
<?php $this->load->view("footer"); ?>          
<script type="text/javascript" src="<?php echo base_url()."asset/my_js/currency.js" ?>"></script>
<script type="text/javascript" src="<?php echo base_url()."asset/my_js/trx_beli.js" ?>"></script>
<script type="text/javascript">
  $(function(){
    $("#combocustomer").change(function(){
      if ($(this).val()=="") {
        $("#newcustomer").fadeIn();
        $("#methodpayment").fadeOut();
      } 
      else{
        $("#newcustomer").fadeOut();
        $("#methodpayment").fadeIn();
      };
    });
  });
</script>