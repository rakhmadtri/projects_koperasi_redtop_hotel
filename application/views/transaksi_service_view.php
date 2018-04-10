<?php 
$this->load->view("header");?>
<div class="span9" id="content">
                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Transaksi Service</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" method="post" action="transaksi_service/insertTransaction" id="form">
                                        <div class="span12">
                                            <div class="span5">
                                                <div class="control-group">
                                                  <label class="control-label" for="noservice">No Service</label>
                                                  <div class="controls">
                                                    <span class="input-xlarge uneditable-input">[ AUTO GENERATED ]</span>
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="tanggalservice">Tanggal Service</label>
                                                  <div class="controls">
                                                    <input type="text" name="tanggalservice" id="tanggalservice" class="input-xlarge datepicker" disabled value="<?php echo date('Y/m/d'); ?>">
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="pelanggan">Pelanggan</label>
                                                  <div class="controls">
                                                    <input type="hidden" name="kodepelanggan" id="kodepelanggan">
                                                    <input type="text" name="namapelanggan" id="namapelanggan" class="input-xlarge" required>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="control-group">
                                                  <label class="control-label" for="cabang">Nama Branch</label>
                                                  <div class="controls">
                                                    <select name="cabang" id="cabang" class="input-xlarge chzn-select">

                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="namatoko">Nama Toko</label>
                                                  <div class="controls">
                                                    <select name="namatoko" id="namatoko" class="input-xlarge chzn-select">
                                                       
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="control-group">
                                                  <label class="control-label" for="namaup">Nama Up</label>
                                                  <div class="controls">
                                                    <input type="text" name="namaup" id="namaup" class="input-xlarge" required>
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
<script type="text/javascript" src="<?php echo base_url() ?>asset/bootstrap/assets/service.js"></script>  