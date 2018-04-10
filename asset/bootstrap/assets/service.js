$(function(){
	// $(".datepicker").datepicker().on("changeDate", function(ev){                 
	//     $(this).datepicker("hide");
	// });
	// $(".datepicker").keydown(function(){return false;});

  // $.showHideMenu();
  $("#pph").keyup(function(){
      var grandtotal = parseInt($("[name=grandtotal]").val());
      var pph = parseInt($("#pph").val());
      var afterpph = grandtotal +(grandtotal * pph/100);
      $("#afterpph").html('<input type="hidden" name="afterpph" value="'+afterpph+'">'+afterpph);
  });

  $("#cabang").change(function(){
      $("#namapelanggan").blur(function(){$("#cabang").change()});
      $.ajax({
          url:"master_customer/allToko",
          type:"post",
          data:{cabang:$("#cabang").val(),
                customer:$("#kodepelanggan").val()},
          success:function(data){ 
            $("#namatoko").html("");
            for(i = 0; i < data.length; i++){
                $("#namatoko").append("<option value='"+data[i].kode_customer+"'>"+data[i].nama_customer+"</option>");
            console.log("test"); 
            }
            $('#namatoko').trigger("liszt:updated");
            $("#namatoko").change();
            $('#cabang').trigger("liszt:updated");
          }
    });
  });
  customer=null;
	$("#namapelanggan").autocomplete({
      source: "master_pt/allPT",
      // open: function(){
      // 	$("#kodepelanggan").val("");
      // },
      focus: function( event, ui ) {
        $("#namapelanggan").val(ui.item.nama_cabang);
        return false;
      },
      select: function( event, ui ) {
      	$("#kodepelanggan").val(ui.item.kode_cabang); //yg ui.item.namafield dari json
      	$("#namapelanggan").val(ui.item.nama_cabang);
      	customer=ui.item;
        $.ajax({
          url:"master_pt/allKota",  
          type:"post",
          data:{kodepelanggan : ui.item.kode_cabang},
          success : function(data){
            console.log(data);
            $("#cabang").html("");
            for(i = 0; i < data.length; i++){
                $("#cabang").append("<option value='"+data[i].kota_id+"'>"+data[i].kokab_nama+"</option>");
            console.log("test"); 
            }
            $('#cabang').change();
            $('#cabang').trigger("liszt:updated");
          }
        });
        return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.kode_cabang + " - " + item.nama_cabang + "</a>" )
        .appendTo( ul );
    };
    $("#namapelanggan").keyup(function(){
    	 if (customer != null && 
          customer.nama_cabang == $(this).val()){
          $("#kodepelanggan").val(customer.kode_cabang);
        }else{
          $("#kodepelanggan").val("");
        }
    });

    $("#kodebarang").autocomplete({
      source: "master_barang/allProductBySparePart",
      open: function(){
      	$("#namabarang").html("");
      	$("#harga").html("0");
      	$("#subtotal").html("0");
      },
      focus: function( event, ui ) {
        $("#kodebarang").val(ui.item.kode_barang);
        return false;
      },
      select: function( event, ui ) {
      	$("#kodebarang").val(ui.item.kode_barang);
      	$("#namabarang").html(ui.item.nama_barang);
      	// $("#harga").html(ui.item.harga);
      	$("#subtotal").html("0");
      	$("#harga").focus();
      	return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.kode_barang + " - " + item.nama_barang + "</a>" )
        .appendTo( ul );
    };
    $("#kodebarang").keyup(function(){
    	if($(this).val()==""){
    		$("#namabarang").html("");
    		$("#harga").val("");
      		$("#subtotal").html("0");
    	}
    });

    $("#qty, #harga").keyup(function(){
      var qty = $("#qty").val();
      var harga = $("#harga").val();
      if(!isNaN(qty) && qty != "" && !isNaN(harga) && harga != ""){
        qty = parseInt(qty);
        harga = parseInt(harga);
        $("#subtotal").html(qty*harga);
      }else{
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
		    	var subtotal = parseInt(row.find("td:nth-child(5) input").val());
		    	grandtotal += subtotal;
		    }
		    $("#grandtotal").html('<input type="hidden" name="grandtotal" value="'+grandtotal+'">'+grandtotal); 
    	}else{
    		$("#grandtotal").html('<input type="hidden" name="grandtotal" value="0">0');
    	}
    }
    isEnough = false;
    var tambah = function(){
      if (isEnough) {
      if( $("#kodebarang").val() != "" && 
        $("#namabarang").html() != "" && 
        $("#harga").val() != "0" && 
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
            var kodebarang = row.find("td:nth-child(1) input").val();
            if(kodebarang == $("#kodebarang").val()){
              row.find("td:nth-child(3)").html($("#harga").val());
              var qty = parseInt(row.find("td:nth-child(4) input").val())+parseInt($("#qty").val());
              row.find("td:nth-child(4)").html(qty);
              var subtotal = qty*parseInt($("#harga").val());
              row.find("td:nth-child(5)").html('<input type="hidden" name="subtotal[]" value="'+subtotal+'">'+subtotal);
              isAvailable = true;
              break;
            }
          }
        }

        if(!isAvailable){
          var row = $(
            '<tr data-id="'+$("#kodebarang").val()+'">'+
                  '<td>'+
                    '<input type="hidden" name="kodebarang[]" value="'+$("#kodebarang").val()+'">'+
                    $("#kodebarang").val()+
                  '</td>'+
                  '<td>'+
                    '<input type="hidden" name="namabarang[]" value="'+$("#namabarang").html()+'">'+
                    $("#namabarang").html()+
                  '</td>'+
                  '<td>'+
                    '<input type="hidden" name="harga[]" value="'+$("#harga").val()+'">'+
                    $("#harga").val()+
                  '</td>'+
                  '<td>'+
                    '<input type="hidden" name="qty[]" value="'+$("#qty").val()+'">'+
                    $("#qty").val()+
                  '</td>'+
                  '<td>'+
                    '<input type="hidden" name="subtotal[]" value="'+$("#subtotal").html()+'">'+
                    $("#subtotal").html()+
                  '</td>'+
                  '<td>'+
                    '<a href="#" class="btn btn-danger input-block-level remove" data-id="'+$("#kodebarang").val()+'"><i class="icon-remove icon-white"></i>Remove</a>'+
                  '</td>'+
              '</tr>'
          );
          detail.append(row);
      }

      countGrandtotal();
      $("#kodebarang").val("");
      $("#namabarang").html("");
      $("#harga").val("");
      $("#qty").val("");
      $("#subtotal").html("0");
      $("#kodebarang").focus();
    }


      };

    	return false;
    }

    $("#tambah").click(tambah);
    $("#kodebarang, #qty").keyup(function(e){
    	if(e.keyCode ==  13){
    		tambah();
    	}
    	return false;      
    });
    $("#qty").keyup(function(){
        $.ajax({
          url:"master_barang/currentStok",
          type:"post",
          data:{id_barang:
            $("#kodebarang").val(),qty:$("#qty").val()},
            success:function(data){
              if (data=="OUT OF STOCK"){
                isEnough=false;
                $("#response").fadeIn();
                $("#response").html(data);
              }else{
                isEnough=true;
                $("#response").fadeOut();
              }
            }
        });
    });


    $(document).on("click",".remove",function(){
    	var id = $(this).data("id");
    	$("tr[data-id="+id+"]").remove();

    	var detail = $("#detail tbody");
    	if(detail.find("tr").length == 0){
    		detail.html('<tr class="empty-detail">'+
                            '<td colspan="6">Detail masih kosong</td>'+
                        '</tr>');
    	}
    	countGrandtotal();
    	return false;
    });

    $("#form button[type=submit]").click(function(){
    	if( $("#nopenjualan").val() != "" &&
    		$("#tanggalservice").val() != "" &&
    		$("#kodepelanggan").val() != "" &&
    		$("#detail .empty-detail").length == 0){
    		return true;
    	}
    	return false;
    });

    $("#form button[type=reset]").click(function(){
    	var detail = $("#detail tbody");
		detail.html('<tr class="empty-detail">'+
                        '<td colspan="6">Detail masih kosong</td>'+
                    '</tr>');
		countGrandtotal();
    });
});