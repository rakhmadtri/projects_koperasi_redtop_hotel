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
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.kodekurir + " - " + item.namakurir + "</a>" )
        .appendTo( ul );
    };
    $("#namakurir").keyup(function(){
    	if($(this).val()==""){
    		$("#kodekurir").val("");
    	}
    });
    $("#nopenjualan").change(function(){
      $.ajax({
            url:"transaksi_penjualan/allTransaksi",
            type:"post",
            data:{orderid:$(this).val()},
            success:function(data){
              console.log(data);
              $("#btn-print2").attr("href","transaksi_penjualan/print_penjualan/"+data.order_id);
              $("#tanggal-penjualan").html(data.order_timestamp);
              $("#pelanggan-penjualan").html(data.kode_customer+"-"+data.nama_customer);
              $("#detail tbody").html("");
              for(i = 0; i< data.order_detail.length; i++){
                $("#detail tbody").append('<tr>'+
                                              '<td>'+ data.order_detail[i].order_master_id +'</td>'+
                                              '<td>'+ data.order_detail[i].nama_barang +'</td>'+
                                              '<td>'+ data.order_detail[i].selling_price +'</td>'+
                                              '<td>'+ data.order_detail[i].qty +'</td>'+
                                              '<td>'+ data.order_detail[i].sub_total +'</td>'+
                                           '</tr>');
             }
             $("#grandtotal").html(data.total_customer_price);
          }
      });
  });
  $("#btn-print2").click(function(){
    var kurir = $("#kodekurir").val();
    var orderid = $("#nopenjualan").val();
    // $(this).attr("href","transaksi_penjualan/insertSuratJalan?kurir="+kurir+"&orderid="+orderid);
    $(this).attr("href","surat_jalan/cetak_suratjalan?orderid="+orderid);
    document.getElementById("form").reset();
  });
});