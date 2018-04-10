$(function(){

	$("#example1").on('click','.view-detail',function(){
		var order_id = $(this).val();
		$("#mutasi_anggota").html("");
      	$.ajax({
            url:"transaksi_penjualan/json_detail_penjualan",
            type:"get",
            data:{order_id:order_id},
            success:function(data){

            // $("#title_shu").html(data['result'][0]['nama']);
            if (data.length>0){
                for (var i =0 ; i < data.length; i++) {
	                var row='<tr>'+
		                	'<td>'+data[i].kode_barang+'</td>'+
			                '<td>'+data[i].nama_barang+'</td>'+
			                '<td class="text-right">'+data[i].qty+'</td>'+
			                '<td class="text-right">'+data[i].selling_price+'</td>'+
			                '<td class="text-right">'+data[i].sub_total+'</td>'+				                
			            '</tr>';
				    $("#mutasi_anggota").append(row);     
                };
                $('#order_id').html(data[0].order_id);
                $('#tanggal_transaksi').html(data[0].tgl_nota);
                $('#pelanggan').html(data[0].nama==null?data[0].kode_customer:data[0].kode_customer+' - '+data[0].nama);
        	  	$('#total').html('Rp '+data[0].total_before_ppn);
        	  	$('#ppn').html(data[0].ppn);
        	  	$('#grand_total').html('Rp '+data[0].total_after_ppn);
        	  	$('#cash').html('Rp '+data[0].cash);
        	  	$('#kredit').html('Rp '+data[0].kredit);
        	  	
        	  	$("#myModal").modal('show');
        	  // showModalDialog($("#myModal"));
            };
          }
      });
	});
});