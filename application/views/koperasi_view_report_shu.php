<?php 
$this->load->view("header"); ?>
<section class="content" style="min-height:auto">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Report SHU Anggota</h3>
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
    <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>report_mutasi_anggota/report" method="get">
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
  </div>
</section>

<!-- SUMMARY REPORT SHU -->
<?php if (!empty($this->input->get("periode")) && !empty($data['summary'])): ?>
  <div class="form-group">
  <?php if (isset($data['summary'][0]['summary_transaksi_shu']) && count($data['summary'])==1 ): ?>
    <?php foreach ($data['summary'][0]['summary_transaksi_shu'] as $key => $value): ?>
      <div class="col-md-4">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo strtoupper($key) ?></h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body" style="display: block;">
            <?php echo currency_format($value); ?>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    <?php endforeach ?>
  <?php endif ?>
  </div>

  <form action="<?php echo base_url()."report_mutasi_anggota/insert" ?>" method="POST">
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box">

              <div class="box-header">
                <h3 class="box-title"><label class="label bg-green">Published</label> SHU PER-ANGGOTA</h3>
                <div class="btn-group pull-right ">
                   <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                   <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url()."report_mutasi_anggota/report/export_xls"?><?php echo (!empty($_GET['periode'])?'?periode='.$_GET['periode']:""); echo (!empty($_GET['to'])?'&to='.$_GET['to']:""); ?>">Export to Excel</a></li>
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
                  <?php if (isset($data['detail'])): ?>
                    <?php foreach ($data['detail'] as $key => $value) {  ?>
                         <tr class="odd gradeX">
                          <td><?php echo $value['nik'] ?></td>
                          <td><?php echo $value['nama'] ?></td>
                          <td><?php echo number_format($value['saldo_simpanan'],2) ?></td>
                          <td><?php echo number_format($value['shu_simpanan'],2) ?></td>
                          <td><?php echo number_format($value['shu_ekonomi'],2) ?></td>
                          <td><?php echo number_format($value['shu_total'],2) ?></td>
                        </tr>
                      <?php  } ?>
                  <?php endif ?>
                  </tbody>
                  <tfoot> 
                        <tr class="odd gradeX" style="background: #f9fb87;border: none;">
                          <td colspan="2">GrandTotal</td>
                          <td><?php echo currency_format($data['summary'][0]['subtotal_saldo_simpanan']) ?></td>
                          <td><?php echo currency_format($data['summary'][0]['subtotal_shu_simpanan']) ?></td>
                          <td><?php echo currency_format($data['summary'][0]['subtotal_shu_ekonomi']) ?></td>
                          <td><?php echo currency_format($data['summary'][0]['grand_total_shu']) ?></td>
                        </tr>                 
                  </tfoot>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
        </div>
      </div>
    </section>
  </form>  
<?php endif ?>
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