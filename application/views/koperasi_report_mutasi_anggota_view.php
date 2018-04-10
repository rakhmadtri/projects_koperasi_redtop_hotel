<?php $this->load->view("header"); ?>
<section class="content" style="min-height:auto">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report Mutasi Per-anggota</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
        <div class="btn-group hidden">
           <a href="#" class="btn btn-success" id="btn_addnew">Add New <i class="icon-plus icon-white"></i></a>
        </div>
        <div class="btn-group pull-right">
           <button data-toggle="dropdown" class="btn dropdown-toggle hidden">Tools <span class="caret"></span></button>
           <ul class="dropdown-menu">
              <li><a href="#">Print</a></li>
              <li><a href="#">Save as PDF</a></li>
              <li><a href="<?php echo base_url()."report_stok/export_stok_xls?from="?><?php echo (!empty($_GET['from'])?$_GET['from']:""); echo (!empty($_GET['to'])?'&to='.$_GET['to']:""); ?>">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_mutasi_anggota" method="get">
      <div class="box-body">
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Periode </label>
            <div class="col-sm-2">
                <input type="text" name="periode" class="form-control datepicker" value="<?php echo isset($_GET['periode'])?$_GET['periode']:"" ?>" >
            </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <button type="submit" class="btn btn-info pull-left col-sm-4" id="click">Submit</button>
        </div>
      </div>
      </form>
<!--         <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Remember me
              </label>
            </div>
          </div>
        </div>
      </div><! -->

  </div>
</section>

<form action="<?php echo base_url()."report_mutasi_anggota/insert" ?>" method="POST">
<div class="form-group">
<?php $grand_total = 0; ?>
<?php if (isset($import_data['data']) && is_array($import_data['data']) && !empty($import_data['data'])): ?>
  <?php foreach ($import_data['data'] as $key => $value): 
      $grand_total += $value['nominal'];
  ?>
  <div class="col-md-4">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo strtoupper($value['transaksi_type']) ?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body" style="display: block;">
        <?php echo currency_format($value['nominal']); ?>
        <input type="text" class="form-control hidden"  name="summary_transaksi_shu[<?php echo $value['transaksi_type']?>]" value="<?php echo $value['nominal'] ?>">
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
  <?php endforeach ?>
<?php endif ?>

<?php if (isset($data) && is_array($data) && !empty($data)): ?>
  <?php foreach ($data as $key => $value): 
        if (isset($value[0]['untung_by_order'])) {
          $grand_total += $value[0]['untung_by_order'];
        }
        else if (isset($value[0]['grand_total'])) {
          $grand_total += $value[0]['grand_total'];
        }
        else if (isset($value[0]['nominal'])) {
          $grand_total += $value[0]['nominal'];
        }
        else{
          $grand_total += 0;
        }
  ?>

  <div class="col-md-4">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo strtoupper($key) ?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body" style="display: block;">
        <?php 
          if (isset($value[0]['untung_by_order'])) {
            echo currency_format($value[0]['untung_by_order']);
            echo "<input type='text' class='hidden' name=summary_transaksi_shu[$key] value='".$value[0]['untung_by_order']."' >";
          }
          else if (isset($value[0]['grand_total'])) {
            echo currency_format($value[0]['grand_total']);
            echo "<input type='text' class='hidden' name=summary_transaksi_shu[$key] value='".$value[0]['grand_total']."' >";
          }
          else if (isset($value[0]['nominal'])) {
            echo currency_format($value[0]['nominal']);
            echo "<input type='text' class='hidden' name=summary_transaksi_shu[$key] value='".$value[0]['nominal']."' >";
          }
          else{
            echo currency_format(0);
          }
        ?>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
  <?php endforeach ?>
<?php endif ?>

  <div class="col-md-4">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo strtoupper("total_pengeluaran") ?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body" style="display: block;">
        <?php echo currency_format(isset($total_pengeluaran[0]['grand_total'])?$total_pengeluaran[0]['grand_total']:0); ?>
        <input type="text" class='hidden' name="summary_transaksi_shu[total_pengeluaran]" 
        value="<?php echo isset($total_pengeluaran[0]['grand_total'])?$total_pengeluaran[0]['grand_total']:0 ?>">
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
  </div>
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box">

            <div class="box-header">
              <h3 class="box-title">SHU PER-ANGGOTA</h3>
              <button type="submit" class="btn btn-primary">Save</button>
              <div class="btn-group pull-right">
                 <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                 <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url()."report_mutasi_anggota/export_xls"?><?php echo (!empty($_GET['periode'])?'?periode='.$_GET['periode']:""); echo (!empty($_GET['to'])?'&to='.$_GET['to']:""); ?>">Export to Excel</a></li>
                 </ul>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped datatable">
                <thead>
                  <tr>
                    <th>NIK</th>
                    <th>NAMA ANGGOTA</th>
                    <th >SALDO</th>
                    <th >SIMPAN</th>
                    <th >EKONOMI</th>
                    <th> SHU</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (isset($list_shu)): ?>
                  <?php foreach ($list_shu as $key => $value) { 

                    ?>
                       <tr class="odd gradeX">
                        <td><?php echo $value['nik'] ?></td>
                        <td><?php echo $value['nama'] ?></td>
                        <td><?php echo number_format($value['t_union.total_simpanan'],2) ?></td>
                        <td><?php echo number_format($value['shu_simpanan'],2) ?></td>
                        <td><?php echo number_format($value['shu_ekonomi'],2) ?></td>
                        <td><?php echo number_format($value['grand_total_shu'],2) ?></td>
                      </tr>
                      <input type="text" class="hidden" name="no_anggota[]" value="<?php echo $value['no_anggota'] ?>">
                      <input type="text" class="hidden" name="total_simpanan[]" 
                              value="<?php echo $value['t_union.total_simpanan'];?>">
                      <input type="text" class="hidden" name="shu_simpanan[]" 
                              value="<?php echo $value['shu_simpanan']; ?>">
                      <input type="text" class="hidden" name="shu_ekonomi[]" 
                              value="<?php echo $value['shu_ekonomi']; ?>">
                      <input type="text" class="hidden" name="grand_total_shu[]" 
                              value="<?php echo $value['grand_total_shu'];?>">
                    <?php  } ?>
                <?php endif ?>
                </tbody>
                <tfoot> 
                      <tr class="odd gradeX" style="background: #f9fb87;border: none;">
                        <td colspan="2">GrandTotal</td>
                        <?php if (isset($subtotal)): ?>
                          <?php foreach ($subtotal as $key => $value): ?>
                            <td><?php echo currency_format($value) ?></td>
                            <input type="text" class="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
                          <?php endforeach ?>
                        <?php endif ?>
                      </tr>                 
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div>
    </div>
  </section>
  <input type="text" name="periode" class="hidden" value="<?php echo isset($_GET['periode'])?$_GET['periode']:date("Y") ?>" >
</form>
<style>
  .image-modal {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0; 
    left: 0;
    display: block;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.5);
    display: none;
  }
  .image-modal .modal-body{
    overflow: auto;
    min-height: 400px;
    max-height: 530px;
  }
</style>
<div class="image-modal modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Mutasi</h4>

      </div>
      <div class="modal-body">
        <!-- <img src="" id="profile_img" style="width: 100%"> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
<div class="modal fade" id="myModal">
<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title"><span value="samuel erwardi" id="title_shu"></span></h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-3">No Anggota</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="no_anggota">Testes</div>
          </div>
          <div class="row">
            <div class="col-sm-3">Nama Anggota</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="nama_anggota">Testes</div>
          </div>
          <div class="row">
            <div class="col-sm-3">Saldo Awal</div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-8" id="saldo_total">Testes</div>
          </div>
          <form id="search_mutasi">
            <div class="row">
              <div class="col-sm-3">FROM</div>
              <div class="col-sm-1">:</div>
              <div class="col-sm-8"><input type="date" name="from"></div>
            </div>
            <div class="row">
              <div class="col-sm-3">TO</div>
              <div class="col-sm-1">:</div>
              <div class="col-sm-8"><input type="date" name="to"></div>
            </div>
            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-1"></div>
              <div class="col-sm-8" style="padding-top:10px"><button type="submit" class="btn btn-primary">Search</button></div>
            </div>
          </form>
          <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th>TANGGAL</th>
                <th>T.SIMPANAN</th>
                <th class="text-right">T.PINJAMAN</th>
                <th class="text-right">SALDO</th>
                <th class="text-right">KETERANGAN</th>
              </tr>
            </thead>
            <tbody id="mutasi_anggota">
              
            </tbody>
          </table>
          <div class="form-group">
            <input type="button" class="btn btn-warning btn-sm pull-right" value="Reset">
            <div class="clearfix"></div>
          </div>
    </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/script_report_mutasi_anggota.js"></script>
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: "yyyy",
    minViewMode: 'years', 
    startView: 'decade',
  }).on('changeMonth', function(e) {
  $(e.currentTarget).data('datepicker').hide();
  });
    $(document).ready(function() {
      $('#example2').DataTable().destroy();
        $('#example2').DataTable( {
            "order": [[ 2, "ASC" ]],
            "scrollX": true
        } );
    } );

</script>    