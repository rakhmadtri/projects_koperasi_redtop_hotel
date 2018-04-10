<?php $this->load->view("header"); ?>
<iframe name="iframecetak" style="display:none"></iframe>
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Submit Cicilan Bulanan</h3>
    <div class="block-content collapse in">
  <div class="span12">
      <div class="table-toolbar">
<!--         <div class="btn-group">
           <a href="#" class="btn btn-success" id="btn_addnew">Add New <i class="icon-plus icon-white"></i></a>
        </div> -->
        <div class="btn-group pull-right hidden">
           <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
           <ul class="dropdown-menu">
              <li><a href="#">Print</a></li>
              <li><a href="#">Save as PDF</a></li>
              <li><a href="<?php echo base_url() ?>master_barang/TRUE">Export to Excel</a></li>
           </ul>
        </div>
      </div>   
  </div> 
    </div>
    </div><!-- /.box-header -->

  <form class="form-horizontal" id="form_noHide" action="<?php echo base_url() ?>transaksi_submit_cicilan_bulanan" method="get">
      <div class="box-body">
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Proses Bulan ? </label>
            <div class="col-sm-2">
            <!--   <select name="bulan_proses" class="form-control select2" style="width: 100%;" id="nik" required>
                <option value="">- Pilih Bulan -</option>
                <?php foreach ($data_bulan as $key => $value): ?>
                <option value="<?php echo $value['bulan'] ?>" <?php if (isset($_GET['bulan_proses'])) {
                                if ($_GET['bulan_proses']==$value['bulan']) {
                                  echo "selected";
                                }
                            }?> >
                                  <?php echo $value['bulan']; ?>
                </option>
                <?php endforeach ?>
              </select> -->
                <input type="text" name="bulan_proses" class="form-control datepicker" value="<?php echo isset($_GET['bulan_proses'])?$_GET['bulan_proses']:"" ?>" >
            </div>
            <div class="col-sm-2">
              <input name="no_anggota" type="text" class="form-control" id="nama" autocomplete="off" placeholder="No Anggota" value="<?php echo isset($_GET['no_anggota'])?$_GET['no_anggota']:"" ?>">
            </div>
            <div class="col-sm-2">
                <select name="departemen" class="form-control select2" style="width: 100%;" id="nik">
                  <option value="">- Pilih Departemen -</option>
                  <?php foreach ($data_departemen as $key => $value): ?>
                    <option value="<?php echo $value['kode_departemen'] ?>"><?php echo $value['nama_departemen'] ?></option>
                  <?php endforeach ?>
              </select>
            </div>
            <div class="col-sm-2">
              <button class="btn btn-success pull-right"><i class="fa  fa-search"></i> Search Data </button>
          </div>
        </div>
      </div>
  </form>


  <div class="col-md-12">
<!--           <h3 class="box-title">Transaksi Cicilan Bulanan</h3> -->
          <div class="box-tools pull-right">
            <div class="has-feedback">
              <!-- <input type="text" class="form-control input-sm" placeholder="Search Mail"> -->
              <!-- <span class="glyphicon glyphicon-search form-control-feedback"></span> -->
            </div>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
            <div class="btn-group">
              <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
              <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
              <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
            </div><!-- /.btn-group -->
            <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
            <div class="box-tools pull-right">
              <ul class="pagination pagination-sm inline">
                  <li><?php echo $this->pagination->create_links() ?></li>
              </ul>
            </div><!-- /.pull-right -->
          </div>
          <div class="table-responsive mailbox-messages">
          <form class="form-horizontal" id="form3" action="<?php echo base_url() ?>transaksi_submit_cicilan_bulanan/insertTransaction" method="POST" target="iframecetak">
            <table class="table table-hover table-striped">
              <tbody>
              <input type="hidden" name="proses_bulanan" value="<?php echo (isset($_GET['bulan_proses'])?$_GET['bulan_proses']:date("Y-m")); ?>">
              <tr style="background-color:black;color:#fff">
                <td></td>
                <td>Order ID</td>
                <td>Nama Anggota</td>
                <td>Nominal Cicilan</td>
                <td>Jatuh Tempo</td>
              </tr>
              <?php foreach ($cicilan_bulanan as $key => $value): ?>
                <tr>
                  <td><input type="checkbox" name="checkbox[]" value="<?php echo $value["order_id"]."-".$value["keterangan"];?>"></td>
<!--                   <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> -->
                  <td class="mailbox-attachment"><?php echo $value['order_id'] ?></td>
                  <td class="mailbox-name"><b><?php echo $value['nama'] ?></b></td>
                  <td class="mailbox-subject"><b><?php echo currency_format($value['cicilan_perbulan']) ?></b> - <?php echo strtoupper(str_replace("_", " ", $value['keterangan'])) ?></td>
                  <td class="mailbox-date"><?php echo $value['jatuh_tempo'] ?></td>
                </tr>
              <?php endforeach ?>
              </tbody>
            </table><!-- /.table -->
          </div><!-- /.mail-box-messages -->
        </div><!-- /.box-body -->
        <div class="col-md-5" style="padding-left:0px;margin-top:10px">
          <button class="btn btn-success pull-left col-sm-5 btn-print2" name="submit" value="cetak" ><i class="fa fa-credit-card"></i> Cetak </button>
          <button class="btn btn-success pull-right col-sm-5" name="submit" value="save"><i class="fa fa-credit-card"></i> Save & Cetak </button>
        </div>
        <div class="box-footer no-padding">
      <div class="mailbox-controls">
  </div>
</form>

</section>
<?php $this->load->view("footer"); ?>
<script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });
</script>
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: "yyyy-mm",
    minViewMode: 'months', 
    // startView: 'decade',
    // startDate : new Date(new Date().getYear() + 1900,0,1)
  }).on('changeMonth', function(e) {
    $(e.currentTarget).data('datepicker').hide();
  });
</script>    