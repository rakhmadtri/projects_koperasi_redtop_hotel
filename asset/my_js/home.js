$(function(){
	$(".small-box").click(function(){
		var target = $(this).data("target");
		for (var i = 0; i < $(".data").length; i++) {
			$($(".data")[i]).hide();
		};
		$("#"+target).slideDown();
		var tbody = $("#"+target).find("tbody");
		var table = $("#"+target).find("table");
     	$.ajax({
            url:"master_anggota/allAnggota/",
            success: function(data){
	         	tbody.html("");
            	for (var i = 0; i < data.length; i++) {
            		tbody.append('<tr><td>'+data[i].no_anggota+'</td></tr>');
            	};
            	table.dataTable().fnDestroy();
            	table.DataTable({
		          "paging": true,
		          "lengthChange": true,
		          "searching": true,
		          "ordering": true,
		          "info": true,
		          "autoWidth": true
		        });
            }
          });
	});
});