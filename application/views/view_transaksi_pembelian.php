<?php 
$this->load->view("header");?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Transaksi Pembelian Barang VIEW</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="row">
        <form class="form-horizontal" method="post" action="transaksi_pembelian/insertTransaction" id="form" target="iframecetakpo">
           <div class="col-md-12" style="margin-bottom:50px">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">No PO</label>
                        <div class="col-md-6">
                            <input disabled type="text" name="nopembelian" id="tanggalpenjuaalan" class="form-control " readonly="true" value="<?php echo isset($detail_pembelian[0]['order_id'])?$detail_pembelian[0]['order_id']:"AUTO GENERATED"; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Tanggal Created PO</label>
                          <div class="col-md-6">
                            <input disabled type="text" name="tanggalpenjualan" id="tanggalpenjualan" class="form-control datepicker" disabled value="<?php echo isset($detail_pembelian[0]['pembelian_timestamp'])?$detail_pembelian[0]['pembelian_timestamp']:date('Y/m/d'); ?>">
                          </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Supplier</label>
                          <div class="col-md-6">
                            <input disabled type="hidden" name="kodesupplier" id="kodesupplier" value="<?php echo isset($detail_pembelian[0]['kode_supplier'])?$detail_pembelian[0]['kode_supplier']:""; ?>">
                            <input disabled type="text" name="namasupplier" id="namasupplier" class="form-control " disabled required value="<?php echo isset($detail_pembelian[0]['nama_supplier'])?$detail_pembelian[0]['nama_supplier']:""; ?>">
                          </div>
                    </div>
                </div>  
            </div>
            <hr>

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
                <?php if (!isset($detail_pembelian)){ ?>
                    <tr class="empty-detail">
                        <td colspan="6">Detail masih kosong</td>
                    </tr>
                <?php }else {
                    foreach ($detail_pembelian as $key => $value) { ?>
                    <tr>
                        <td class="col-md-2"><input disabled type="hidden" name="kodebarang[]" value="<?php echo $value['kode_barang']; ?>"><?php echo $value['kode_barang'] ?></td>
                        <td class="col-md-2"><input disabled type="hidden" name="namabarang[]" value="<?php echo $value['nama_barang']; ?>"><?php echo $value['nama_barang'] ?></td>
                        <td class="col-md-2"><input disabled type="hidden" name="harga[]" value="<?php echo $value['buying_price']; ?>"><?php echo $value['buying_price'] ?></td>
                        <td class="col-md-2"><input disabled type="hidden" name="qty[]" value="<?php echo $value['qty']; ?>"><span><?php echo $value['qty'] ?></span></td>                                                                                                        
                        <td class="col-md-2"><input disabled type="hidden" name="subtotal[]" value="<?php echo $value['sub_total']; ?>"><?php echo $value['sub_total'] ?></td>
                        <td class="col-md-2">
                          
                        </td>
                    </tr>
                <?php  } } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Grandtotal
                            </div>
                        </th>
                        <td colspan="2" id="grandtotal">
                            <input type="hidden" name="grandtotal" value="<?php echo (isset($detail_pembelian[0]['transaksi_noppn'])?$detail_pembelian[0]['transaksi_noppn']:0); ?>">
                            <?php echo (isset($detail_pembelian[0]['transaksi_noppn'])?$detail_pembelian[0]['transaksi_noppn']:0); ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                PPN
                            </div>
                        </th>
                        <td colspan="2">
                            <input type="text" disabled required min="0" name="pph" id="pph" class="form-control" autocomplete="off" value="<?php echo (isset($detail_pembelian[0]['ppn'])?$detail_pembelian[0]['ppn']:""); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Harga setelah PPN
                            </div>
                        </th>
                            <td colspan="2" id="afterpph"><?php echo (isset($detail_pembelian[0]['total_transaksi'])?$detail_pembelian[0]['total_transaksi']:0) ?></td>
                    </tr>
                </tfoot>
            </table>
            </div>


            <hr>
           
        </form>
    </div>
    </div>
</section>
<?php $this->load->view("footer"); ?>          