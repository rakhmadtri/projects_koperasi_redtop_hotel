$(function() {
	var showModal = function(){
			$(".image-modal").fadeIn('slow');
	}
	$("#detail_mutasi").click(showModal);
	$(".modal .close").click(function(){
		$(".image-modal").fadeOut('slow');
	});
	$(".openBtn").click(function(){
		// alert($(this).data('id'));
		// alert("sam");
		// var no_anggota=$(this).data('id');
		var no_anggota = $(this).val();
		// alert(no_anggota);
		$("#mutasi_anggota").html("");
      	$.ajax({
            url:"report_mutasi_anggota/show_modal",
            type:"get",
            data:{term:no_anggota},
            success:function(data){
            console.log(data);
                // alert(data[0].nama);
                $("#nama_anggota").html(data['result'][0]['nama']);
                // $("#mutasi_anggota").html("");
                $("#title_shu").html(data['result'][0]['nama']);
                for (var i =0 ; i < data.result.length; i++) {
	                var row='<tr>'+
		                	'<td>'+data.result[i].nama+'</td>'+
			                '<td>'+data.result[i].nama_jabatan+'</td>'+
			                '<td class="text-right">'+data.result[i].nama_departemen+'</td>'+
			                '<td class="text-right">'+data.result[i].untung_by_order+'</td>'+
			                '<td class="text-right">'+data.result[i].keterangan+'</td>'+				                
			            '</tr>';
				    $("#mutasi_anggota").append(row);     
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