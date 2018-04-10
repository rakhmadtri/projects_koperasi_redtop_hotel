

$(function(){
  // $(".datepicker").datepicker().on("changeDate", function(ev){                 
  //     $(this).datepicker("hide");
  // });
  // $(".datepicker").keydown(function(){return false;});
  $(".remove").on("click",function(){
    $(this).parents("tr").remove();
    countGrandtotal();
    $("#pph").keyup();
    return false;
  });
  // $.showHideMenu();
  $("#pph").keyup(function(){
      var grandtotal = parseInt($("[name=grandtotal]").val());
      var pph = parseInt($("#pph").val());
      var afterpph = grandtotal +(grandtotal * pph/100);
      $("#afterpph").html('<input type="hidden" name="afterpph" value="'+afterpph+'">'+afterpph);
      $("#cash").val(afterpph);
      if (($("#combocustomer").val()!="newCustomer") || ($("#combocustomer").val()!="")){
            $("#cash").keyup(function(){
              var afterpph = grandtotal +(grandtotal * pph/100);
              // console.log(afterpph);
              $("#kredit").val(afterpph-$("#cash").val());
          });
          // console.log($("[name=afterpph]").val());
        }
      else{
          $("#kredit").val('0');
      }    
  });

  customer=null;


    // $("#kodebarang").autocomplete({
    //   source: function(request, response){
    //     var result=[];
    //     result.push({
    //       kode_barang : 0,
    //       nama_barang:"Tambah" + request.term
    //     });
    //     response(result);
    //     $.ajax({
    //       url : "master_barang/allProductInventaris",
    //       type:"get",
    //       data:{kode_barang:$("#kodebarang").val()},
    //       success : function(data){
    //         console.log(data);
    //         result = result.concat(data);
    //         response(result);
    //       }
    //     });
    //   },
    //   open: function(){
    //     $("#namabarang").html("");
    //     $("#harga").html("");
    //     $("#subtotal").html("0");
    //   },
    //   focus: function( event, ui ) {
    //     $("#kodebarang").val(ui.item.kode_barang);
    //     return false;
    //   },
    //   select: function( event, ui ) {
    //     if (ui.item.kode_barang == 0){

    //     }
    //     else{
    //         $("#kodebarang").val(ui.item.kode_barang);
    //         $("#namabarang").html(ui.item.nama_barang);
    //         $("#harga").html(ui.item.harga_jual);
    //         console.log(ui.item.nama_barang);
    //         // $("#category")
    //         category = ui.item.category;
    //         $("#subtotal").html("0");
    //         $("#qty").focus();
    //     }
    //     return false;
    //   }
    // }).data("ui-autocomplete")._renderItem = function( ul, item ) {
    //   if (item.kode_barang==0){      
    //     return $( "<li>" )
    //       .append( "<a>" + item.nama_barang + "</a>" )
    //       .appendTo( ul );
    //   }
    //   else{
    //    return $( "<li>" )
    //       .append( "<a>" + item.kode_barang + " - " + item.nama_barang + "</a>" )
    //       .appendTo( ul ); 
    //   }
    // };
    $("#kodebarang").keyup(function(){
      if($(this).val()==""){
        $("#namabarang").html("");
        $("#harga").html("");
          $("#subtotal").html("0");
      }
    });


    $("#qty, #harga").keyup(function(){
      console.log("keyup");
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
          var subtotal = parseInt(row.find("td:nth-child(4) input").val());
          grandtotal += subtotal;
        }
        $("#grandtotal").html('<input type="hidden" name="grandtotal" value="'+grandtotal+'">'+grandtotal); 
      }else{
        $("#grandtotal").html('<input type="hidden" name="grandtotal" value="0">0');
      }
      $("#pph").keyup();
    }
    isEnough = false;
    category ="";
    var tambah = function(){
      console.log("addss");
      if( $("#kodebarang").val() != "" && 
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
              row.find("td:nth-child(3)").html('<input type="hidden" name="harga[]" value="'+$("#harga").val()+'">'+$("#harga").val());
              var qty = parseInt(row.find("td:nth-child(4) input").val())+parseInt($("#qty").val());
              row.find("td:nth-child(4)").html('<input type="hidden" name="qty[]" value="'+qty+'">'+qty);
              var subtotal = qty*parseInt($("#harga").val())
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



      return false;
    }

    $("#tambah").click(tambah);
    $("#kodebarang, #qty").keyup(function(e){
      if(e.keyCode ==  13){
        tambah();
      }
      return false;      
    });
    // $("#qty").keyup(function(){
    //     $.ajax({
    //       url:"master_barang/currentStok",
    //       type:"post",
    //       data:{id_barang:$("#kodebarang").val(),qty:$("#qty").val()},
    //         success:function(data){
    //           console.log(data);
    //           if (data=="OUT OF STOCK"){
    //             isEnough=false;
    //             $("#response").fadeIn();
    //             $("#response").html(data);
    //           }else{
    //             isEnough=true;
    //             $("#response").fadeOut();
    //           }
    //         }
    //     });
    // });


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

    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });


    $("#form button[type=reset]").click(function(){
      var detail = $("#detail tbody");
    detail.html('<tr class="empty-detail">'+
                        '<td colspan="6">Detail masih kosong</td>'+
                    '</tr>');
    countGrandtotal();
    });
});