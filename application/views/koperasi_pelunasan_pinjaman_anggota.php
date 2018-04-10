<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Pelunasan Pinjaman</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
        <div class="row">
          <form class="form-horizontal" method="post" action="<?php echo base_url()."pelunasan_pinjaman_anggota/update_transaksi_pinjaman" ?>" id="form">
          <div class="col-md-12" style="margin-bottom:50px">
            <div class="col-md-4">  
              <div class="control-group">
                <label class="control-label" for="nopenjualan">NIK</label>
                <div class="controls">
                   <select name="no_anggota" class="form-control select2" style="width: 100%;" id="nik">
                      <option value="">- Pilih -</option>
                        <?php foreach ($data_anggota as $value): ?>
                      <option value="<?php echo $value['no_anggota'] ?>"><?php echo $value['nik']." - ".$value['nama'] ?></option>
                      <?php endforeach ?>
                </select>
                </div>
              </div>

          </div>
              <table class="table table-striped table-bordered padd-bottom" id="detail">
                  <thead>
                      <tr>
                          <th class="span2">No Peminjaman</th>
                          <th class="span2">Jenis Transaksi</th>
                          <th class="span2">Nominal Angsuran</th>
                          <th class="span2">Sisa Angsuran</th>
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
                <button type="submit" name="submit" value="save" class="btn">Save</button>
                <button type="reset" name="submit"  value="cancel" class="btn">Cancel</button>
              </div>
          </form>
          </div>
      </div>
    </div>
</section>
<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="<?php echo base_url('asset/bootstrap/bootstrap/js/jquery.printPage.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/pelunasan.js"></script>           