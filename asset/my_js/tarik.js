$(function() {
  var no_pengunduran =$("#no_pengunduran").val();
  $("#no_pengunduran").change(function(){
      $.ajax({
            url:"transaksi_penarikan/getDataResign/"+$(this).val(),
            type:"get",
            // data:{no_pengunduran:$(this).val()},
            success:function(data){
            console.log(data);
                // alert(data[0].nama);
                $('#nama_anggota').html(data.nama);
                $('#keterangan').val(data.Keterangan);
                $('#no_anggota').val(data.no_anggota);
            var total=0;
            for (var i = 0; i < data.detail_penarikan.length; i++) {
                  $('#simpanan_'+data.detail_penarikan[i].kode_jenis_simpanan).val(data.detail_penarikan[i].jumlah_simpanan);
                  total+= parseInt(data.detail_penarikan[i].jumlah_simpanan);
                };    
                $('#total_tarik').val(total);

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
});