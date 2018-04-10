$(function(){


    $("#nik").change(function(){
      var grandtotal =0;
      $.ajax({
            url:"pelunasan_pinjaman_anggota/list_pinjaman_anggota",
            type:"post",
            data:{no_anggota:$(this).val()},
            success:function(data){
              console.log(data);
              console.log(data.length);
              $("#detail tbody").html("");
              for(i = 0; i< data.length; i++){
                grandtotal += parseInt(data[i].total_sisa_angsuran);
                $("#detail tbody").append('<tr>'+
                                              '<td>'+ data[i].order_id +'</td>'+
                                              '<td>'+ data[i].keterangan +'</td>'+
                                              '<td>'+ data[i].cicilan_perbulan +'</td>'+
                                              '<td>'+ data[i].sisa_lama_cicilan +'</td>'+
                                              '<td>'+ data[i].total_sisa_angsuran +'</td>'+
                                           '</tr>');
             }
             $("#grandtotal").html(grandtotal+'.00');
          }
      });
  });
});