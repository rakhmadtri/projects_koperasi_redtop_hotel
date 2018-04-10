$(function(){


    $("#nik").change(function(){
      var grandtotal =0;
      $.ajax({
            url:"sales_to_cicilan/detail_sales",
            type:"post",
            data:{order_id:$(this).val()},
            success:function(data){
              console.log(data);
              console.log(data.length);
              $("#detail tbody").html("");
              if (data.length>0) {
                 for(i = 0; i< data.length; i++){
                   // grandtotal += parseInt(data[i].total_sisa_angsuran);
                   $("#detail tbody").append('<tr>'+
                                                 '<td>'+ data[i].order_master_id +'</td>'+
                                                 '<td>'+ data[i].nama_barang +'</td>'+
                                                 '<td>'+ data[i].qty +'</td>'+
                                                 '<td>'+ data[i].selling_price +'</td>'+
                                                 '<td>'+ data[i].sub_total +'</td>'+
                                              '</tr>');
                }
                $("#grandtotal").html(data[0].total_after_ppn);
              }
              else{
                $("#grandtotal").html(0);
              }
          }
      });
  });
    $("#form button[type=submit]").click(function(){
      var nominal = $("#kredit").val();
    if(nominal>0){
        $.ajax({
          url:"transaksi_penjualan/validasi_hutang",
          type:"post",
          data:{no_anggota:$("#nik").val(),nominal_kredit:$("#kredit").val()},
            success:function(data){
              // console.log(data);
              if (data.length>0){
                swal('',data,'error');
              }else{
                // console.log("samuel");

                $("#form").submit();
              }
            }
        });
      }
      else{
        return true;
      }
      // alert(sumTotal);

      return false;
    });
});