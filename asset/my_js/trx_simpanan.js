$(function(){
    // $.showHideMenu();
	// $(".datepicker").datepicker().on("changeDate", function(ev){                 
	//     $(this).datepicker("hide");
	// });
	// $(".datepicker").keydown(function(){return false;});

	$("#namaanggota").autocomplete({
      source: "master_anggota/allAnggota",
      open: function(){
      	$("#noanggota").val("");
      },
      focus: function( event, ui ) {
        $("#namaanggota").val(ui.item.nama_supplier);
        return false;
      },
      select: function( event, ui ) {
      	$("#noanggota").val(ui.item.no_anggota); //yg ui.item.namafield dari json
      	$("#namaanggota").val(ui.item.nama);
      	return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.nik + " - " + item.nama + "</a>" )
        .appendTo( ul );
    };
    $("#namaanggota").keyup(function(){
    	if($(this).val()==""){
    		$("#noanggota").val("");
    	}
    });
    $("#kode_jenis_simpanan").autocomplete({
      source: "jenis_simpanan/allJenisSimpanan",
      open: function(){
      	$("#namasimpanan").html("");
      	$("#nominal").html("0");
      	$("#subtotal").html("0");
      },
      focus: function( event, ui ) {
        $("#kode_jenis_simpanan").val(ui.item.kode_jenis_simpanan);
        return false;
      },
      select: function( event, ui ) {
        console.log(ui.item);
      	$("#kode_jenis_simpanan").val(ui.item.kode_jenis_simpanan);
      	$("#namasimpanan").html(ui.item.nama_simpanan);
      	$("#nominal").val(ui.item.nominal);
      	$("#tambah").focus();
      	return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.kode_jenis_simpanan + " - " + item.nama_simpanan + "</a>" )
        .appendTo( ul );
    };
    $("#kode_jenis_simpanan").keyup(function(){
    	if($(this).val()==""){
    		$("#namasimpanan").html("");
    		$("#nominal").val("");
      		$("#subtotal").html("0");
    	}
    });


    var countGrandtotal = function(){
      var detail = $("#detail tbody");
    	if(detail.find(".empty-detail").length==0){
    		var grandtotal = 0;
    		var rows = detail.find("tr");
    		for(i = 0; i < rows.length; i++){
		    	var row = $(rows[i]);
		    	var subtotal = parseInt(row.find("td:nth-child(3) input").val());
		    	grandtotal += subtotal;
		    }
		    $("#grandtotal").html('<input type="hidden" name="grandtotal" value="'+grandtotal+'">'+grandtotal); 
    	}else{
    		$("#grandtotal").html('<input type="hidden" name="grandtotal" value="0">0');
    	}
    }

    var tambah = function(){
    	if( $("#kode_jenis_simpanan").val() != "" && 
    		$("#namasimpanan").html() != "" && 
    		$("#nominal").val() != "0" && 
    		$("#qty").val() != "" && 
    		$("#subtotal").html() != "0" ){
    		var detail = $("#detail tbody");
    		var isAvailable = false;

    		if(detail.find(".empty-detail").length>0){
		    	detail.html("");
		    }else{
		    	var rows = detail.find("tr");
		    	for(i = 0; i < rows.length; i++){
		    		var row = $(rows[i]);
		    		var kode_jenis_simpanan = row.find("td:nth-child(1) input").val();
		    		if(kode_jenis_simpanan == $("#kode_jenis_simpanan").val()){
              row.find("td:nth-child(3)").html($("#nominal-value").val());
		    			var subtotal = qty*parseInt($("#nominal-value").val())
		    			row.find("td:nth-child(5)").html('<input type="hidden" name="subtotal[]" value="'+subtotal+'">'+subtotal);
		    			isAvailable = true;
		    			break;
		    		}
		    	}
		    }

		    if(!isAvailable){
		    	var row = $(
			    	'<tr data-id="'+$("#kode_jenis_simpanan").val()+'">'+
			            '<td>'+
			            	'<input type="hidden" name="kode_jenis_simpanan[]" value="'+$("#kode_jenis_simpanan").val()+'">'+
			            	$("#kode_jenis_simpanan").val()+
			            '</td>'+
			            '<td>'+
			            	'<input type="hidden" name="namasimpanan[]" value="'+$("#namasimpanan").html()+'">'+
			            	$("#namasimpanan").html()+
			            '</td>'+
			            '<td>'+
			            	'<input type="hidden" name="nominal[]" value="'+$("#nominal").val()+'">'+
			            	$("#nominal").val()+
			            '</td>'+
			            '<td colspan="2">'+
			            	'<a href="#" class="btn btn-danger input-block-level remove" data-id="'+$("#kode_jenis_simpanan").val()+'"><i class="icon-remove icon-white"></i>Remove</a>'+
			            '</td>'+
			        '</tr>'
			    );
			    detail.append(row);
			}

			countGrandtotal();
			$("#kode_jenis_simpanan").val("");
			$("#namasimpanan").html("");
			$("#nominal").val("");
			$("#qty").val("");
			$("#subtotal").html("0");
			$("#kode_jenis_simpanan").focus();
		}
    	return false;
    }

    $("#tambah").click(tambah);
    $("#kode_jenis_simpanan, #qty").keyup(function(e){
    	if(e.keyCode ==  13){
    		tambah();
    	}
    	return false;
    });


    $(document).on("click",".remove",function(){
    	var id = $(this).data("id");
    	$("tr[data-id="+id+"]").remove();

    	var detail = $("#detail tbody");
    	if(detail.find("tr").length == 0){
    		detail.html('<tr class="empty-detail">'+
                            '<td colspan="5">Detail masih kosong</td>'+
                        '</tr>');
    	}
    	countGrandtotal();
    	return false;
    });

    $("#form button[type=submit]").click(function(){
      if( $("#nopenjualan").val() != "" &&
        $("#tanggalpenjualan").val() != "" &&
        $("#kodepelanggan").val() != "" &&
        $("#detail .empty-detail").length == 0){
        return true;
      }
      return false;
    });

    $("#form button[type=reset]").click(function(){
    	var detail = $("#detail tbody");
		detail.html('<tr class="empty-detail">'+
                        '<td colspan="5">Detail masih kosong</td>'+
                    '</tr>');
		countGrandtotal();
    });
});