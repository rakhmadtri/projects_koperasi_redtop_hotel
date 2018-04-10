<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Transaksi Penjualan Barang</div>
                            </div>
<!--                             <?php print_r($detail_penjualan); ?> -->
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" method="post" action="transaksi_service/insertTransaction" id="form">
                                        <div class="control-group">
                                          <label class="control-label" for="nopembelian">No Penjualan</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo isset($detail_penjualan[0]['order_id'])?$detail_penjualan[0]['order_id']:"" ?></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="tanggalpembelian">Tanggal Penjualan</label>
                                          <div class="controls">
                                            <input type="text" name="tanggalpembelian" id="tanggalpembelian" class="input-xlarge datepicker" 
                                                    disabled value="<?php echo isset($detail_penjualan[0]['order_timestamp'])?$detail_penjualan[0]['order_timestamp']:""; ?>">
                                            <i class="icon-calendar"></i>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="supplier">Pelanggan</label>
                                          <div class="controls">
                                            <input type="hidden" name="kodesupplier" id="kodesupplier">
                                            <input type="text" name="namasupplier" id="namasupplier" class="input-xlarge" value="<?php echo isset($detail_penjualan[0]['nama_customer'])?$detail_penjualan[0]['nama_customer']:"" ?>" required disabled>
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
                                                <?php foreach ($detail_penjualan as $key => $value): ?>
                                                <tr class="empty-detail">
                                                    <td><?php echo $value['kode_barang'] ?></td>
                                                    <td><?php echo $value['nama_barang'] ?></td>
                                                    <td><?php echo $value['selling_price'] ?></td>
                                                    <td><?php echo $value['qty'] ?></td>
                                                    <td><?php echo $value['sub_total'] ?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">
                                                        <div class="text-right">
                                                            Grandtotal
                                                        </div>
                                                    </th>
                                                    <td colspan="2" id="grandtotal"><?php echo isset($detail_penjualan[0]['total_customer_price'])?$detail_penjualan[0]['total_customer_price']:"" ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <hr>
<!--                                         <div class="block-content text-right">
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div> -->
                                    </form>
                                </div>
<?php $this->load->view("footer"); ?>                
