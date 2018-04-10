<?php $this->load->view("header");?>
<div class="span9" id="content">
                      <!-- morris stacked chart -->
<!--                       <?php print_r($detail_penjualan) ?> -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Transaksi Penjualan Barang</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" method="post" action="transaksi_penjualan/insertTransaction" id="form">
                                        <input type="hidden" value="<?php echo (isset($_GET['trxid'])?$_GET['trxid']:""); ?>" name="trxid">
                                        <div class="span12">
                                            <div class="span5">
                                                <div class="control-group">
                                                  <label class="control-label" for="nopenjualan">No Penjualan</label>
                                                  <div class="controls">
                                                    <span class="input-xlarge uneditable-input">[ AUTO GENERATED ]</span>
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="tanggalpenjualan">Tanggal Penjualan</label>
                                                  <div class="controls">
                                                    <input type="text" name="tanggalpenjualan" id="tanggalpenjualan" class="input-xlarge datepicker" disabled value="<?php echo date('Y/m/d'); ?>">
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="pelanggan">Pelanggan</label>
                                                    <input type="text" name="namapelanggan" id="namapelanggan" class="input-xlarge" required value="<?php echo (isset($detail_penjualan[0]['nama_cabang'])?$detail_penjualan[0]['nama_cabang']:"") ?>">
                                                  <div class="controls">
                                                    <input type="hidden" name="kodepelanggan" id="kodepelanggan">
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="control-group">
                                                  <label class="control-label" for="cabang">Nama Branch</label>
                                                  <div class="controls">
                                                    <select name="cabang" id="cabang" class="input-xlarge chzn-select">
                                                        <?php if (isset($detail_penjualan[0]['kokab_nama'])): ?>
                                                           <option value="<?php echo $detail_penjualan[0]['kokab_nama'] ?>"><?php echo $detail_penjualan[0]['kokab_nama'] ?></option>
                                                        <?php endif ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="namatoko">Nama Toko</label>
                                                  <div class="controls">
                                                    <select name="namatoko" id="namatoko" class="input-xlarge chzn-select">
                                                       <?php if (isset($detail_penjualan[0]['kokab_nama'])): ?>
                                                           <option value="<?php echo $detail_penjualan[0]['kode_customer'] ?>"><?php echo $detail_penjualan[0]['nama_customer'] ?></option>
                                                       <?php endif ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="namaup">Nama Up</label>
                                                  <div class="controls">
                                                    <input type="text" name="namaup" id="namaup" class="input-xlarge" value="<?php echo (isset($detail_penjualan[0]['up_customer'])?$detail_penjualan[0]['up_customer']:""); ?>" required>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row-fluid padd-bottom">
                                            <div class="span2">
                                                <label for="kodebarang">Kode Barang</label>
                                                <input type="text" id="kodebarang" class="input-block-level">
                                            </div>
                                            <div class="span2">
                                                <label for="namabarang">Nama Barang</label>
                                                <span id="namabarang" class="input-block-level uneditable-input"></span>
                                            </div>
                                            <div class="span2">
                                                <label for="harga">Harga</label>
                                                <input type="text" id="harga" class="input-block-level" autocomplete="off">
                                            </div>

                                            <div class="span2">
                                                <label for="qty">Qty</label>
                                                <input type="text" id="qty" class="input-block-level" autocomplete="off">
                                                <div class="error-container">
                                                    <span id="response" class="error">test</span>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <label for="subtotal">Subtotal</label>
                                                <span id="subtotal" class="input-block-level uneditable-input">0</span>
                                            </div>
                                            <div class="span2">
                                                <label>&nbsp;</label>
                                                <a href="#" class="btn btn-success input-block-level" id="tambah"><i class="icon-plus icon-white"></i>Tambah</a>
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered padd-bottom" id="detail">
                                            <thead>
                                                <tr>
                                                    <th class="span2">Kode Barang</th>
                                                    <th class="span2">Nama Barang</th>
                                                    <th class="span2">Harga</th>
                                                    <th class="span2">Qty</th>
                                                    <th class="span2">Subtotal</th>
                                                    <th class="span2"></th>
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
                                                    <td class="span2"><input type="hidden" name="kodebarang[]" value="<?php echo $value['kode_barang']; ?>"><?php echo $value['kode_barang'] ?></td>
                                                    <td class="span2"><input type="hidden" name="namabarang[]" value="<?php echo $value['nama_barang']; ?>"><?php echo $value['nama_barang'] ?></td>
                                                    <td class="span2"><input type="hidden" name="harga[]" value="<?php echo $value['selling_price']; ?>"><?php echo $value['selling_price'] ?></td>
                                                    <td class="span2"><input type="hidden" name="qty[]" value="<?php echo $value['qty']; ?>"><?php echo $value['qty'] ?></td>                                                                                                        
                                                    <td class="span2"><input type="hidden" name="subtotal[]" value="<?php echo $value['sub_total']; ?>"><?php echo $value['sub_total'] ?></td>
                                                    <td class="span2"><a href="#" class="btn btn-danger input-block-level remove" data-id="'+$("#kodebarang").val()+'"><i class="icon-remove icon-white"></i>Remove</a></td>
<!--                                                     <td class="span2"><a href="<?php echo base_url()."transaksi_penjualan/delete_detail_transaksi2?trxid=".$_GET['trxid']."&kodebarang=".$value['kode_barang'] ?>" class="btn btn-danger input-block-level remove"><i class="icon-remove icon-white"></i>Remove</a></td> -->
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
                                                        <input type="hidden" name="grandtotal" value="<?php echo (isset($detail_penjualan[0]['total_customer_price'])?$detail_penjualan[0]['total_customer_price']:0); ?>">
                                                        <?php echo (isset($detail_penjualan[0]['total_customer_price'])?$detail_penjualan[0]['total_customer_price']:0); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4">
                                                        <div class="text-right">
                                                            PPH
                                                        </div>
                                                    </th>
                                                    <td colspan="2">
                                                        <input type="text" name="pph" id="pph" class="input-block-level" autocomplete="off" value="<?php echo (isset($detail_penjualan[0]['pph'])?$detail_penjualan[0]['pph']:""); ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4">
                                                        <div class="text-right">
                                                            Harga setelah PPH
                                                        </div>
                                                    </th>
                                                        <td colspan="2" id="afterpph"><?php echo (isset($detail_penjualan[0]['total_customer_price'])?$detail_penjualan[0]['total_customer_price']+$detail_penjualan[0]['total_customer_pph']:0) ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <hr>
                                        <div class="block-content text-right">
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                    </form>

                                </div>
<?php $this->load->view("footer"); ?>   
<script type="text/javascript" src="<?php echo base_url() ?>asset/bootstrap/assets/trx.js"></script>  