<?php $this->load->view("header"); ?>
<div class="span9" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">SPK</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>spk/insertSpk" id="form">
                                        <div class="control-group">
                                          <label class="control-label" for="nosuratjalan">No SPK</label>
                                          <div class="controls">
                                            <input type="hidden" name="nosuratjalan" id="nosuratjalan" value="SJ001">
                                            <span class="input-xlarge uneditable-input">[ AUTO GENERATED ]</span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="nopenjualan">No Penjualan</label>
                                          <div class="controls">
                                          <select name="nopenjualan" id="nopenjualan" class="input-xlarge chzn-select" required>
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($transaksi_0 as $key => $value): ?>
                                              <option><?php echo $value['order_id'] ?></option>
                                            <?php endforeach ?>
                                          </select>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Tanggal Penjualan</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input" id="tanggal-penjualan"></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" >Pelanggan</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input" id="pelanggan-penjualan"></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="tanggalkirim">Tanggal Kirim</label>
                                          <div class="controls">
                                            <input type="text" name="tanggalkirim" id="tanggalkirim" class="input-xlarge datepicker">
                                            <i class="icon-calendar"></i>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="namakurir">Teknisi</label>
                                          <div class="controls">
                                            <input type="hidden" name="kodekurir" id="kodekurir">
                                            <input type="text" name="namakurir" id="namakurir" class="input-xlarge" required>
                                          </div>
                                        </div>
                                          <div class="control-group">
                                            <label class="control-label">Keterangan<span class="required">*</span></label>
                                            <div class="controls">
                                             <textarea class="input-xlarge" name="alamat"><?php echo (isset($edit_customer)?$edit_customer[0]['alamat']:"") ?></textarea>
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
                                                            Grandtotal
                                                        </div>
                                                    </th>
                                                    <td id="grandtotal">0</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <hr>
                                        <div class="block-content text-right">
                                            <a class="btn btnPrint2" id="btn-print2">
                                               <i class="icon-print"></i> Print
                                           </a>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
	            <!-- /wizard -->
                </div>
            </div>
<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="<?php echo base_url('asset/bootstrap/bootstrap/js/jquery.printPage.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".btnPrint2").printPage();
    })
</script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/spk.js"></script>           