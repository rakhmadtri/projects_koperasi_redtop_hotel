$(function() {
  var hitung = function(){
    var waktu_cicilan = $("#lama_cicilan").val();
    var nominal_pinjam= $("#jumlah_pinjaman").val();
    var nominal_bunga= $("#bunga").val();
    var nominal_angsuran = (parseInt(nominal_pinjam)+parseInt(nominal_bunga))/parseInt(waktu_cicilan);
     $("#angsuran").val(nominal_angsuran);
  }

  $("#lama_cicilan").keyup(function(){
    hitung();
  });

  var no_anggota =$("#no_anggota").val();
  var max_lama_cicilan=1;
  $("#no_anggota").change(function(){
      $.ajax({
            url:"master_anggota/autocomplete_allAnggota",
            type:"get",
            data:{term:$(this).val()},
            success:function(data){
            console.log(data[0].nama);
                // alert(data[0].nama);
            $("#nama_anggota").html(data[0].nama);                  
          }
      });
  });
  $("#jumlah_pinjaman").change(function(){
    var jumlah_pinjaman = $("#jumlah_pinjaman").val();
    // alert($("#jumlah_pinjaman").val());
   $.ajax({
            url:"transaksi_pinjaman/nominalPinjaman",
            type:"get",
            data:{jumlah_pinjaman:$(this).val()},
            success:function(data){
            console.log(data);
              // alert(data.testing[0].lama_cicilan);
            $("#lama_cicilan").val(data.set_pinjaman[0].lama_cicilan);
            $("#bunga").val(data.set_pinjaman[0].bunga);
            $("#angsuran").val(data.set_pinjaman[0].angsuran);
            max_lama_cicilan=data.set_pinjaman[0].lama_cicilan;
            // alert(max_lama_cicilan);
                // alert(data[0].nama);              
          }
      });
  });
  $("#lama_cicilan").keyup(function(){
      if(parseInt($(this).val()) < 1 || parseInt($(this).val()) > max_lama_cicilan){
        $(this).val("");
      }
    });
  var hutang=0;
  var maxPinjaman=0;
  $("#no_anggota").change(function(){
      $.ajaxLoader.show();
      $.ajax({
        url:"transaksi_pinjaman/currentPinjaman",
        type:"post",
        data:{no_anggota:$("#no_anggota").val()},
          complete:function(){
            $.ajaxLoader.hide();
          },
          success:function(data){
            console.log(data);
            if (data.total_pinjaman.length>0){
                $("#response").fadeIn();
                $("#response").html("ADA PINJAMAN IDR "+data.total_pinjaman[0].total_hutang);
                $("#total_pinjaman_before").val(data.total_pinjaman[0].total_hutang);
                  hutang      = data.total_pinjaman[0].total_hutang;

            }
            else{
               $("#response").fadeOut();
               hutang=0;
            };



              maxPinjaman = parseInt(data.nominal_max[0].nominal_max);
          }
      });
  });
  // Alur bisnis sebelumnya
  // $("#form_noHide button[type=submit]").click(function(){
  //   var currentPinjaman=$("#jumlah_pinjaman").val();
  //   var total_pinjaman=parseInt(currentPinjaman)+parseInt(hutang);
  //   var x = maxPinjaman-total_pinjaman; 
  //     // alert(maxPinjaman+"-"+total_pinjaman+"-"+x);
  //     // return false;
  //   if (x<0){
  //     swal('',maxPinjaman+"-"+total_pinjaman+" TOTAL HUTANG = "+x,'error');
  //     return false;
  //   };

  // });
  $("#form_noHide button[type=submit]").click(function(){
    var currentPinjaman=$("#jumlah_pinjaman").val();
    var total_pinjaman=parseInt(currentPinjaman)+parseInt(hutang);
    var x = maxPinjaman-total_pinjaman; 
    console.log(hutang);
      // alert(maxPinjaman+"-"+total_pinjaman+"-"+x);
      // return false;
      if (hutang>0){
        swal(''," TOTAL HUTANG = "+hutang,'error');
        return false;
      };

  });
});