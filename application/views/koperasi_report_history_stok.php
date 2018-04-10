<?php $this->load->view("header"); ?>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">History Report Stok</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
        <div class="row">
          <form class="form-horizontal" method="get" action="<?php echo base_url()."history_stok" ?>" id="form">
          <div class="col-md-12" style="margin-bottom:50px">
            <div class="col-md-4">  
              <div class="control-group">
                <label class="control-label" for="nopenjualan">Kode-Nama Barang</label>
                <div class="controls">
                   <select name="kode_barang" class="form-control select2" style="width: 100%;" id="order_id" required>
                      <option value="">- Kode-Nama Barang -</option>
                        <?php foreach ($data_barang as $value): ?>
                      <option value="<?php echo $value['kode_barang'] ?>" <?php echo (isset($_GET['kode_barang']) AND $_GET['kode_barang']==$value['kode_barang'])?'selected':'' ?> ><?php echo $value['kode_barang']." - ".$value['nama_barang'] ?></option>
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
    <?php if (!empty($this->input->get("kode_barang"))): ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>Result Stok</b></h3>
              <div class="box-tools">
                <!-- <div class="input-group" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div> -->
              </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr style="background-color: black;color:white">
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Date</th>
                  <th>Saldo Awal</th>
                  <th>Barang Masuk</th>
                  <th>Barang Keluar</th>
                  <th>Closing</th>
                  <th>Stok Akhir</th>
                </tr>
                <?php if (!empty($detail_history_barang)): ?>
                  <?php $stok_akhir = 0; ?>
                  <?php foreach ($detail_history_barang as $key => $value): ?>
                    <?php if ($value['status']=='opname'): ?>
                      <tr style="background-color:#dd4b39 !important;">
                    <?php else: ?>
                      <tr>
                    <?php endif ?>
                      <td><?php echo $value['kode_barang'] ?></td>
                      <td><?php echo $value['nama_barang'] ?></td>
                      <td><?php echo date('d-m-Y',strtotime($value['timestamp'])) ?></td>
                      <!-- <td><span class="label label-success"><?php echo $value['status'] ?></span></td> -->
                      <td><?php echo $value['saldoawal'] ?></td>
                      <td><?php echo $value['barangmasuk'] ?></td>
                      <td><?php echo $value['barangkeluar'] ?></td>
                      <td ><span class="label label-danger"><?php echo $value['opname'] ?></span></td>
                      <td><?php 
                            $stok_akhir += $value['saldoawal']+$value['barangmasuk']+$value['barangkeluar']+$value['opname'];
                                echo $stok_akhir; 
                            ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>
<!--                 <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-primary">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-danger">Denied</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr> -->
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div>
    <?php endif ?>
</section>
<?php $this->load->view("footer"); ?>