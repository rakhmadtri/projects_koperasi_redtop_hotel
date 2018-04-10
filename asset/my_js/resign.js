$(function() {
  var no_anggota =$("#no_anggota").val();
  $("#no_anggota").change(function(){
      $.ajax({
            url:"master_anggota/allAnggota",
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
            // $("#lama_cicilan").val(data.set_pinjaman[0].lama_cicilan);
                // alert(data[0].nama);              
          }
      });
    
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
            $('#sisa_pinjaman').val("");
            if (data.total_pinjaman.length>0){
                $("#response").fadeIn();
                $("#response").html("ADA PINJAMAN IDR "+data.total_pinjaman[0].total_hutang);
                $("#sisa_pinjaman").val(data.total_pinjaman[0].total_hutang);
                 var hutang      = data.total_pinjaman[0].total_hutang;
                 $('#form_noHide').append('<input type=hidden value='+hutang+ 'name=sisa_pinjaman id=sisa_pinjaman>');

            }
            else{
               $("#response").fadeOut();
            };



              maxPinjaman = parseInt(data.nominal_max[0].nominal_max);
          }
      });
  });
  $("#form_noHide button[type=submit]").click(function(){
    // alert('Masih ada Hutang Sebesar ' + $('#sisa_pinjaman').val());
    if ($('#sisa_pinjaman').val() !=''){
        swal('Oops...', 'Masih Ada Peminjaman !', 'error'); 
        return false;
    }else{
      return true;
    }
  });
});