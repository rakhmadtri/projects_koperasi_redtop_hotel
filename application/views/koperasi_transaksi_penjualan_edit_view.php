<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Sales To Cicilan</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
        <div class="row">
          <form class="form-horizontal" method="post" action="<?php echo base_url()."transaksi_penjualan/redirect_penjualan" ?>" id="form">
          <div class="col-md-12" style="margin-bottom:50px">
            <div class="col-md-4">  
              <div class="control-group">
                <label class="control-label" for="nopenjualan">ORDER ID</label>
                <div class="controls">
                   <select name="order_id" class="form-control select2" style="width: 100%;" id="order_id" required>
                      <option value="">- Order ID -</option>
                        <?php foreach ($data_transaksi as $value): ?>
                      <option value="<?php echo $value['order_id'] ?>"><?php echo $value['order_id']." - ".$value['total_after_ppn'] ?></option>
                      <?php endforeach ?>
                </select>
                </div>
              </div>
          </div>
        </div>
      </div>
          <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-5">
              <button type="submit" class="btn btn-info pull-left col-sm-4" id="click">Submit</button>
            </div>
          </div>
          </form>
          </div>
      </div>
    </div>
</section>
<?php $this->load->view("footer"); ?>