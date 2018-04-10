<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Sales To Cicilan</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
        <div class="row">
          <form class="form-horizontal" method="post" action="<?php echo base_url()."sales_to_cicilan/update_status" ?>" id="form">
          <div class="col-md-12" style="margin-bottom:50px">
            <div class="col-md-4">  
              <div class="control-group">
                <label class="control-label" for="nopenjualan">ORDER ID</label>
                <div class="controls">
                   <select name="order_id" class="form-control select2" style="width: 100%;" id="nik">
                      <option value="">- Order ID : Nama Anggota -</option>
                        <?php foreach ($data_sales as $value): ?>
                      <option value="<?php echo $value['order_id'] ?>"><?php echo $value['order_id']." : ".$value['nama']  ?></option>
                      <?php endforeach ?>
                </select>
                </div>
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
                         <th colspan="4">
                             <div class="text-right">
                                 Kredit
                             </div>
                         </th>
                         <td colspan="2">
                             <input type="number" id="kredit" name="kredit" class="form-control" autocomplete="off" required min="0" >
                         </td>
                     </tr>
                 </tfoot>
              </table>
              <hr>
              <div class="block-content text-right">
                <button type="submit" value="save" class="btn">Save</button>
                <button type="reset" value="cancel" class="btn">Cancel</button>
              </div>
          </form>
          </div>
      </div>
    </div>
</section>
<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/sales_to_cicilan.js"></script>           