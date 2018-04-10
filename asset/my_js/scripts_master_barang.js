$(function() {
	$.initForm(function(){
		//dalem ini isinya yg isi data tadi yg di comment di scripts.js
		$("#kode").val($(this).data("kode"));
    $("select[name=product_type]").val($(this).data("selecttype"));
		$("#nama").val($(this).data("nama"));
		$("#deskripsi").val($(this).data("deskripsi"));
    $(".harga_beli").val(parseInt($(this).data("beli")));
    $(".keuntungan").val(parseInt($(this).data("presentase")));
    $(".harga_jual").val(parseInt($(this).data("jual")));
    $(".harga_beli").keyup();
    $(".keuntungan").keyup();
		$("#deskripsi").val($(this).data("deskripsi"));
    // $("kode").attr("readonly",true);
    $('#kode').prop('readonly', true);
		console.log($(this).data("selecttype"));
		// alert(data();
	});
    $(".keuntungan, .harga_beli").keyup(function(){
    	console.log($(".harga_beli").val());
      var harga_beli = $("#nominal-value").val();
      var presentase = $("#nominal2-value").val();
      if(!isNaN(harga_beli) && harga_beli != "" && !isNaN(presentase) && presentase != ""){
        harga_beli = parseInt(harga_beli);
        presentase = parseInt(presentase);
        var harga_jual = harga_beli + presentase;
        console.log();
        $("#harga_jual").val(harga_jual);
      }else{
        $("#harga_jual").val("0");
      }
    });
});