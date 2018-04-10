<?php  $this->load->view("header");?>
<iframe name="iframesimpanan" style="display:none"></iframe>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Transaksi Simpanan</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="row">
        <form class="form-horizontal" method="post" action="transaksi_simpanan/insertTransaction" id="form" target="iframesimpanan">
            <input type="hidden" value="<?php echo (isset($_GET['trxid'])?$_GET['trxid']:""); ?>" name="trxid">
            <div class="col-md-12" style="margin-bottom:50px">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">No Transaksi Simpanan</label>
                        <div class="col-md-6">
                            <input type="text" name="nosimpanan" id="nosimpanan" class="form-control " disabled value="AUTO GENERATED">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Tanggal Created</label>
                          <div class="col-md-6">
                            <input type="text" name="tanggalpenjualan" id="tanggalpenjualan" class="form-control datepicker" disabled value="<?php echo date('Y/m/d'); ?>">
                          </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Anggota</label>
                          <div class="col-md-6">
                            <input type="hidden" name="no_anggota" id="noanggota">
                            <input type="text" name="nama_anggota" id="namaanggota" class="form-control " required>
                          </div>
                    </div>
                </div>  
            </div>
            <hr>
            <div class="col-md-12">
                <div class="col-md-3">
                    <label for="kodesimpanan">Kode Jenis Simpanan</label>
                    <input type="text" id="kode_jenis_simpanan" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="namasimpanan">Nama Simpanan</label>
                    <span id="namasimpanan" class="form-control uneditable-input"></span>
                </div>
                <div class="col-md-3">
                    <label for="nominal">Jumlah Simpanan</label>
                    <input type="text" id="nominal" name="jumlah_simpanan" class="form-control" readonly autocomplete="off">
                     <input type="hidden" id="category" class="form-control" autocomplete="off">
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
                        <th class="col-md-3">Kode Jenis Simpanan</th>
                        <th class="col-md-3">Nama Simpanan</th>
                        <th class="col-md-3">Jumlah Simpanan</th>
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
                        <td class="col-md-3"><input type="hidden" name="kode_jenis_simpanan[]" value="<?php echo $value['kode_simpanan']; ?>"><?php echo $value['kode_simpanan'] ?></td>
                        <td class="col-md-3"><input type="hidden" name="namasimpanan[]" value="<?php echo $value['nama_simpanan']; ?>"><?php echo $value['nama_simpanan'] ?></td>
                        <td class="col-md-3"><input type="hidden" name="nominal[]" value="<?php echo $value['selling_price']; ?>"><?php echo $value['selling_price'] ?></td>
                        <td class="col-md-3"><a href="#" class="btn btn-danger form-control remove" data-id="'+$("#kodesimpanan").val()+'"><i class="icon-remove icon-white"></i>Remove</a></td>
<!--                                                     <td class="col-md-2"><a href="<?php echo base_url()."transaksi_pembelian/delete_detail_transaksi2?trxid=".$_GET['trxid']."&kodesimpanan=".$value['kode_simpanan'] ?>" class="btn btn-danger form-control remove"><i class="icon-remove icon-white"></i>Remove</a></td> -->
                    </tr>
                <?php  } } ?>
<!--                                                  <tr class="empty-detail">
                    <?php 
                        if (isset($detail_penjualan)) {  ?>
                            <?php foreach ($detail_penjualan as $key => $value) { ?>
                        <input type="text" name="kodesimpanan[]" value="<?php echo $value['kode_simpanan']; ?>">
                        <input type="text" name="namasimpanan[]" value="<?php echo $value['nama_simpanan'];?>">
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
<script type="text/javascript" src="<?php echo base_url()."asset/my_js/trx_simpanan.js" ?>"></script>