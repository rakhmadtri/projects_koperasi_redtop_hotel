$(function() {
	var showModal = function(){
			$(".image-modal").fadeIn('slow');
	}
	$("#detail_mutasi").click(showModal);
	$(".modal .close").click(function(){
		$(".image-modal").fadeOut('slow');
	});
	$("#openBtn").click(function(){
		// alert($(this).data('id'));
		var no_anggota=$(this).data('id');
		// alert(no_anggota);
      	$.ajax({
            url:"report_resign_anggota/detail_resign_anggota",
            type:"get",
            data:{term:no_anggota},
            success:function(data){
            console.log(data);
                // alert(data[0].nama);
                // $("#nama_anggota").html(data['result'][0]['nama']);
                // $("#mutasi_anggota").html("");
                // $("#title_shu").html(data['result'][0]['nama']);
	            var grandTotal = 0;
                for (var i =0 ; i < data.result.length; i++) {
	                var row='<tr>'+
		                	'<td>'+data.result[i].kode_jenis_simpanan+'</td>'+
			                '<td>'+data.result[i].nama_simpanan+'</td>'+
			                '<td class="text-right">'+data.result[i].jumlahTarik+'</td>'+
			            '</tr>';
				 grandTotal += parseInt(data.result[i].jumlahTarik);
				$("#mutasi_anggota").append(row);     
				$("#grandTotal").html("Rp."+grandTotal+".00");
                };
            
          }
      });
	});

	
	$("#search_mutasi").submit(function(){
      	$.ajax({
            url:"report_mutasi_anggota/show_modal_search",
            type:"get",
            data:$(this).serialize(),
            success:function(data){
            console.log(data);
                // alert(data[0].nama);
                $("#nama_anggota").html(data['result'][0]['nama']);
                $("#mutasi_anggota").html("");
                for (var i =0 ; i < data.result.length; i++) {
	                var row='<tr>'+
		                	'<td>'+data.result[i].nama+'</td>'+
			                '<td>'+data.result[i].total_simpan+'</td>'+
			                '<td class="text-right">'+data.result[i].total_pinjam+'</td>'+
			                '<td class="text-right">'+data.result[i].saldo+'</td>'+				                
			            '</tr>';
				    $("#mutasi_anggota").append(row);     
                };
            
          }
      });

		return false;
	});
});