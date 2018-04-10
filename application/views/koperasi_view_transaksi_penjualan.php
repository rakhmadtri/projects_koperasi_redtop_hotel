<?php $this->load->view("header");?>
<iframe name="iframenota" style="display:none"></iframe>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Horizontal Form</h3>
    </div><!-- /.box-header -->

    <!-- form start -->
    <div class="row">
        <form class="form-horizontal" method="post" action="transaksi_penjualan/insertTransaction" id="form" target="iframenota">
            <input type="hidden" value="<?php echo (isset($_GET['trxid'])?$_GET['trxid']:""); ?>" name="trxid">
            <div class="col-md-12" style="margin-bottom:50px">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">No Penjualan</label>
                        <div class="col-md-6">
                            <input type="text" name="nopenjualan" id="tanggalpenjuaalan" class="form-control " disabled value="<?php echo isset($detail_penjualan[0]['order_id'])?$detail_penjualan[0]['order_id']:"" ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Tanggal Penjualan</label>
                          <div class="col-md-6">
                            <input type="text" name="tanggalpenjualan" id="tanggalpenjualan" class="form-control datepicker" disabled value="<?php echo isset($detail_penjualan[0]['tgl_nota'])?$detail_penjualan[0]['tgl_nota']:"" ?>">
                          </div>
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-6" for="pelanggan">Pelanggan</label>
                        <div class="col-md-6">
                           <input type="text" name="nopenjualan" id="tanggalpenjuaalan" class="form-control " disabled value="<?php if($detail_penjualan[0]['nama'] == null){ echo "New Customer"; }else{echo $detail_penjualan[0]['nama'];} ?>">
                        </div>
                    </div>
<!--                     <div class="form-group" id="newcustomer">
                        <label class="col-md-6" for="tanggalpenjualan">Nama Customer</label>
                        <div class="col-md-6">
                            <input type="text" name="customer" class="form-control">
                        </div>
                    </div> -->
                </div>
            </div>
            <hr>
<!--             <?php 
            echo "<pre>";
            print_r($detail_penjualan);
            echo "</pre>"; ?> -->
            <div class="col-md-12">
                    <table class="table table-striped table-bordered padd-bottom" id="detail">
                <thead>
                    <tr>
                        <th class="col-md-2">Kode Barang</th>
                        <th class="col-md-2">Nama Barang</th>
                        <th class="col-md-2">Harga</th>
                        <th class="col-md-2">Qty</th>
                        <th class="col-md-2">Subtotal</th>
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
                                Total
                            </div>
                        </th>
                        <td colspan="2" id="grandtotal">
                            <input type="hidden" name="grandtotal" value="<?php echo (isset($detail_penjualan[0]['total_before_ppn'])?$detail_penjualan[0]['total_before_ppn']:0); ?>">
                            <?php echo (isset($detail_penjualan[0]['total_before_ppn'])?$detail_penjualan[0]['total_before_ppn']:0); ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                PPN
                            </div>
                        </th>
                        <td colspan="2">
                            <input type="text" disabled name="pph" id="pph" class="form-control" autocomplete="off" value="<?php echo (isset($detail_penjualan[0]['ppn'])?$detail_penjualan[0]['ppn']:""); ?>">
                        </td>
                    </tr>
                     <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Grand Total
                            </div>
                        </th>
                            <td colspan="2" id="afterpph"><?php echo (isset($detail_penjualan[0]['total_after_ppn'])?$detail_penjualan[0]['total_after_ppn']:0) ?></td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Cash
                            </div>
                        </th>
                        <td colspan="2">
                            <input type="text" name="cash" id="cash" class="form-control" autocomplete="off" disabled value="<?php echo (isset($detail_penjualan[0]['cash'])?$detail_penjualan[0]['cash']:0); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Kredit
                            </div>
                        </th>
                        <td colspan="2">
                            <input type="text" disabled id="kredit" name="kredit" class="form-control" autocomplete="off" value="<?php echo (isset($detail_penjualan[0]['kredit'])?$detail_penjualan[0]['kredit']:0); ?>">
                        </td>
                    </tr>
                </tfoot>
            </table>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="block-content text-right" style="padding:20px">
                </div>
            </div>
        </form>
    </div>
    </div>
</section>
<?php $this->load->view("footer"); ?> 