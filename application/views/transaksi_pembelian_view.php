<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Transaksi Pembelian Barang</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" method="post" action="transaksi_pembelian/insertTransaction" id="form">
                                        <div class="control-group">
                                          <label class="control-label" for="nopembelian">No Pembelian</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input">[ AUTO GENERATED ]</span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="tanggalpembelian">Tanggal Pembelian</label>
                                          <div class="controls">
                                            <input type="text" name="tanggalpembelian" id="tanggalpembelian" class="input-xlarge datepicker" disabled value="<?php echo date('Y/m/d'); ?>">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="supplier">Supplier</label>
                                          <div class="controls">
                                            <input type="hidden" name="kodesupplier" id="kodesupplier">
                                            <input type="text" name="namasupplier" id="namasupplier" class="input-xlarge" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="keterangan">Keterangan</label>
                                          <div class="controls">
                                            <textarea name="keterangan" required class="input-xlarge"></textarea>
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
                                                <label for="harga">Harga Beli</label>
                                                <input type="text" id="harga" class="input-block-level uneditable-input" disabled>
                                            </div>
                                            <div class="span2">
                                                <label for="qty">Qty</label>
                                                <input type="text" id="qty" class="input-block-level" autocomplete="off">
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
                                                <tr class="empty-detail">
                                                    <td colspan="6">Detail masih kosong</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">
                                                        <div class="text-right">
                                                            Grandtotal
                                                        </div>
                                                    </th>
                                                    <td colspan="2" id="grandtotal">0</td>
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
<script type="text/javascript" src="<?php echo base_url() ?>asset/bootstrap/assets/trx_beli.js"></script>
