$(function(){


	$("#namakurir").autocomplete({
      source: "login/allUser",
      open: function(){
      	$("#kodekurir").val("");
      },
      focus: function( event, ui ) {
        $("#namakurir").val(ui.item.namakurir);
        return false;
      },
      select: function( event, ui ) {
      	$("#kodekurir").val(ui.item.kodekurir);
      	$("#namakurir").val(ui.item.namakurir);
      	return false;
      }
    });
    $("#nopo").change(function(){
      $.ajax({
            url:"approval_po/all_transaksi_pembelian",
            type:"post",
            data:{orderid:$(this).val()},
            success:function(data){
              console.log(data);
              $("#btn-print2").attr("href","transaksi_penjualan/print_penjualan/"+data.order_id);
              $("#tanggal-penjualan").html(data.order_timestamp);
              $("#pelanggan-penjualan").html(data.kode_supplier+"-"+data.nama_supplier);
              $("#detail tbody").html("");
              for(i = 0; i< data.order_detail.length; i++){
                $("#detail tbody").append('<tr>'+
                                              '<td>'+ data.order_detail[i].order_master_id +'</td>'+
                                              '<td>'+ data.order_detail[i].nama_barang +'</td>'+
                                              '<td>'+ data.order_detail[i].buying_price +'</td>'+
                                              '<td>'+ data.order_detail[i].qty +'</td>'+
                                              '<td>'+ data.order_detail[i].sub_total +'</td>'+
                                           '</tr>');
             }
             $("#ppn").html(data.ppn);
             $("#grandtotal").html(data.total_transaksi);
          }
      });
  });
  $("#btn-print2").click(function(){
    var kurir = $("#kodekurir").val();
    var orderid = $("#nopenjualan").val();
    $(this).attr("href","transaksi_penjualan/insertSuratJalan?kurir="+kurir+"&orderid="+orderid);
    $(this).attr("href","surat_jalan/cetak_suratjalan?kurir="+kurir+"&orderid="+orderid);
    // $(this).attr("href","transaksi_penjualan/insertSuratJalan?kurir="+kurir+"&orderid="+orderid);
// >>>>>>> 7186014cedc9ab9cc10284f1fcb79864592e0097
    // $(this).attr("href","surat_jalan/cetak_suratjalan?orderid="+orderid);
    document.getElementById("form").reset();
  });
});