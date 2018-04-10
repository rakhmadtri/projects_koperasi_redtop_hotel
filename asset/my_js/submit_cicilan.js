$(function() {
  var no_anggota =$("#nik").val();
  $("#nik").change(function(){
  console.log(no_anggota);
      if ($(this).val()==""){
          $("#no_pinjaman").html("");
          $("#angsuran_ke").val("");
          $("#lama_pinjaman").val("");  
          $("#jumlah_pinjaman").val("");  
          $("#sisa_pinjaman").val("");
          $("#nominal_angsuran").val("");
      }
      else{
        $.ajax({
              url:"transaksi_submit_cicilan/select_cicilan_header",
              type:"get",
              data:{term:$(this).val()},
              success:function(data){
              console.log(data);
              $('#no_pinjaman').html("");
              data.unshift({id:"",text:"- Pilih -"});
              $("#no_pinjaman").select2({data : data});
            //       // alert(data[0].nama);
            //   // $("#nama_anggota").val(data[0].nama);
            //   if (data.header_pinjaman.length!=0){
            //       // $("#no_pinjaman").val(data[0].order_id);
            //       // $("#angsuran_ke").val(data[0].angsuran_ke);
            //       // $("#lama_pinjaman").val(data[0].count_cicilan);
            //       // $("#jumlah_pinjaman").val(data[0].total_pinjaman);  
            //       // $("#sisa_pinjaman").val(data[0].sisa_pinjaman);
            //       // $("#nominal_angsuran").val(data[0].cicilan_perbulan);
            //       console.log(data.header_pinjaman.length);
            //       // $('#no_pinjaman').html("");
            //       // for (var i = 0; i < data.header_pinjaman.length; i++) {
            //       // $('#no_pinjaman').append('<option value="">- Pilih -</option>'
            //       //     +'<option value='+data.header_pinjaman[i].order_id+'>'+data.header_pinjaman[i].order_id+' - '+data.header_pinjaman[i].keterangan+'</option>');
            //       //   $('#dari_transaksi').val(data.header_pinjaman[i].keterangan);
            //       // };
            //       $("#no_pinjaman").select2({data : data});
            //   }
            //  else{
            //       $("#no_pinjaman").html("");
            //       $("#angsuran_ke").val("");
            //       $("#lama_pinjaman").val("");  
            //       $("#jumlah_pinjaman").val("");  
            //       $("#sisa_pinjaman").val("");
            //       $("#nominal_angsuran").val("");

            // };                       
            }
        });
      };
  });
  $('#no_pinjaman').change(function(){
    // alert($('#no_pinjaman').val()+'-'+$('#nik').val());
          $.ajax({
            url:"transaksi_submit_cicilan/select_cicilan_detail",
            type:"get",
            data:{params:$('#no_pinjaman').val(),no_anggota:$('#nik').val()},
            success:function(data){
            console.log(data);

            if (data.detail_pinjaman.length!=0){
              // alert(data.detail_pinjaman[0].angsuran_ke);
                // $("#no_pinjaman").val(data.detail_pinjaman[0].order_id);
                $("#jatuh_tempo").val(data.detail_pinjaman[0].jatuh_tempo);
                $("#angsuran_ke").val(data.detail_pinjaman[0].angsuran_ke);
                $("#lama_pinjaman").val(data.detail_pinjaman[0].count_cicilan);
                $("#jumlah_pinjaman").val(data.detail_pinjaman[0].total_pinjaman);  
                $("#sisa_pinjaman").val(data.detail_pinjaman[0].sisa_pinjaman);
                $("#nominal_angsuran").val(data.detail_pinjaman[0].cicilan_perbulan);
                $("#dari_transaksi").val(data.detail_pinjaman[0].keterangan);
            }
            else{
              alert(data.detail_pinjaman[0].angsuran_ke);
            };
                                 
          }
      }); 
  });
});