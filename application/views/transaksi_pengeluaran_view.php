<?php $this->load->view("header");?>
<!-- <iframe name="iframenota" style="display:none"></iframe> -->

<?php 
    if (!empty($this->uri->segment(2)) && empty($detail_penjualan)) {
        redirect(base_url()."transaksi_penjualan");
    }
 ?>
<section class="content">
    <?php if (isset($detail_penjualan[0])): ?>
        <div class="callout callout-danger">
            <h4>
                Status Pembayaran :
                <?php 
                    if (!empty($detail_cicilan[0]['status']) && $detail_cicilan[0]['status']=='lunas') 
                    {
                        echo "LUNAS IDR ".$detail_cicilan[0]['cicilan_perbulan'];
                    }
                    else if (!empty($detail_cicilan[0]['status']) && $detail_cicilan[0]['status']=='belum') 
                    {
                        echo "BELUM DI BAYARKAN ".$detail_cicilan[0]['cicilan_perbulan'];
                    }
                    else
                    {
                        echo "CASH";
                    }

                 ?>
                
            </h4>
            <p>1. Cek Stok Terlebih Dahulu </p>
            <p>2. Jika Customer Sudah Melakukan pembayaran ,Maka Kembalikan Duit customer tersebut</p>
        </div>
    <?php endif ?>
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Form Transaksi Pengeluaran Koperasi</h3>
    </div><!-- /.box-header -->

    <!-- form start -->
    <div class="row">
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>transaksi_pengeluaran/insertTransaction" id="form" target="iframenota">
        <!-- <form class="form-horizontal" method="post" action="transaksi_penjualan/insertTransaction" id="form"> -->
            <input type="hidden" value="<?php echo base_url() ?>" name="base_url" id="base_url">
            <div class="col-md-12" style="margin-bottom:50px">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">No Transaksi</label>
                        <div class="col-md-6">
                            <!-- <input type="text" name="nopenjualan" id="tanggalpenjuaalan" class="form-control " disabled value="AUTO GENERATED"> -->
                            <input type="text" name="nopenjualan" id="tanggalpenjuaalan" class="form-control " readonly value="<?php echo isset($detail_penjualan[0]['order_id'])?$detail_penjualan[0]['order_id']:"AUTO GENERATED" ?>">
                            <input type="hidden" value="<?php echo isset($detail_penjualan[0]['order_id'])?$detail_penjualan[0]['order_id']:"" ?>" name="nopenjualan">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6" for="tanggalpenjualan">Tanggal Transaksi</label>
                          <div class="col-md-6">
                            <!-- <input type="text" name="tanggalpenjualan" id="tanggalpenjualan" class="form-control datepicker" disabled value="<?php echo date('Y/m/d'); ?>"> -->
                            <input type="text" name="tanggalpenjualan" id="tanggalpenjualan" class="form-control datepicker" disabled value="<?php echo isset($detail_penjualan[0]['tgl_nota'])?$detail_penjualan[0]['tgl_nota']:date('Y/m/d') ?>">
                          </div>
                    </div>
                </div>  
            </div>
            <hr>
            <div class="col-md-12">
                <div class="col-md-4">
                    <label for="kodebarang">Nama Barang</label>
                    <input type="text" id="kodebarang" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="harga">Harga</label>
                    <input type="number" name="price[]" class="form-control" min="0" id="harga">
                </div>
                <div class="col-md-2">
                    <label for="qty">Qty</label>
                    <input type="text" id="qty" class="form-control" autocomplete="off">
                    <div class="error-container">
                        <span id="response" class="error">table-striped</span>
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
                        <th class="col-md-4">Nama Barang</th>
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
                        <td class="col-md-2"><input type="hidden" name="harga[]" value="<?php echo $value['selling_price']; ?>"><?php echo $value['selling_price'] ?></td>
                        <td class="col-md-2" style="position: relative"><input type="hidden" name="qty[]" value="<?php echo $value['qty']; ?>">
                            <span><?php echo $value['qty'] ?></span>
                            <div class="error-container">
                                <span class="error response">table-striped</span>
                            </div>
                        </td>                                                                                                        
                        <td class="col-md-2"><input type="hidden" name="subtotal[]" value="<?php echo $value['sub_total']; ?>"><?php echo $value['sub_total'] ?></td>
                        <td class="col-md-2">
                            <a href="#" class="btn btn-default fa fa-edit btn-default btn_edit"><i class="icon-pencil icon-white"></i> Edit</a>
                            <a href="#" class="<?php echo !empty($detail_penjualan)?'btn btn-default fa fa-trash btn-default remove':'btn btn-danger form-control remove'?>" data-id="'+$("#kodebarang").val()+'"><i class="icon-remove icon-white"></i>Remove</a>
                        </td>
<!--                                                     <td class="col-md-2"><a href="<?php echo base_url()."transaksi_penjualan/delete_detail_transaksi2?trxid=".$_GET['trxid']."&kodebarang=".$value['kode_barang'] ?>" class="btn btn-danger form-control remove"><i class="icon-remove icon-white"></i>Remove</a></td> -->
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
                            <input type="text" name="pph" id="pph" class="form-control" autocomplete="off" value="<?php echo (isset($detail_penjualan[0]['ppn'])?$detail_penjualan[0]['ppn']:"0"); ?>">
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
<!--                     <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Cash
                            </div>
                        </th>
                        <td colspan="2">
                            <input type="text" name="cash" id="cash" class="form-control" autocomplete="off" value="<?php echo (isset($detail_penjualan[0]['cash'])?$detail_penjualan[0]['cash']:0); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <div class="text-right">
                                Kredit
                            </div>
                        </th>
                        <td colspan="2">
                            <input type="text" id="kredit" name="kredit" class="form-control" autocomplete="off" value="<?php echo (isset($detail_penjualan[0]['kredit'])?$detail_penjualan[0]['kredit']:""); ?>">
                        </td>
                    </tr> -->
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
<script type="text/javascript" src="<?php echo base_url()."asset/my_js/koperasi_trx_pengeluaran.js" ?>"></script>
<script type="text/javascript">
  $(function(){
    $("#combocustomer").change(function(){
        // alert($('[name=grandtotal]').val());
      if ($(this).val()=="newCustomer") {
        // $("#newcustomer").fadeIn();
        // $("#kredit").fadeOut();  
        $('#kredit').val(0);  
        $("#kredit").prop("disabled", true);
        $("#cash").prop("disabled", true);     
        $('#cash').val($('[name=afterpph]').val());
      } 
      else{
      //   // $("#newcustomer").fadeOut();
      //   // $("#kredit").fadeIn();
        // $('#kredit').val(0); 
        $("#kredit").prop("disabled", false);
        $("#kredit").prop("readonly", true);      
        $("#cash").prop("disabled", false);  
      };
    });
  });
</script>