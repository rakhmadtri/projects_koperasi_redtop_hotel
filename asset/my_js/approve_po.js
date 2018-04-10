$(function(){
  $(".remove").on("click",function(){
      $(this).parents("tr").remove();
      countGrandtotal();
      pph();
  });



  $(document).on("click",".btn_edit",function(){
      var parent= $(this).parents("tr");
      parent.find("td:nth-child(4) [type=hidden]").attr("type","text");
      parent.find("td:nth-child(4) [type=text]+span").hide();
  });
  $(document).on("keyup","#detail td:nth-child(4) [type=text]",function(){
        var parent= $(this).parents("tr");
        var harga= parent.find("td:nth-child(3) [type=hidden]").val();
        var qty=parseInt($(this).val());
        var subtotal = harga * qty;
        parent.find("td:nth-child(5)").html('<input type="hidden" name="subtotal[]" value="'+subtotal+'">'+subtotal );

        countGrandtotal();
        pph();
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
 var pph = function(){
    var grandtotal = parseInt($("[name=grandtotal]").val());
    var pph = parseInt($("#pph").val());
    var afterpph = grandtotal +(grandtotal * pph/100);
    $("#afterpph").html('<input type="hidden" name="afterpph" value="'+afterpph+'">'+afterpph);
   };
});