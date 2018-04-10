$(function() {
	$.initForm(function(){
		//dalem ini isinya yg isi data tadi yg di comment di scripts.js
		$("#kode").val($(this).data("kode"));
		$("#nama").val($(this).data("nama"));
		$("#email").val($(this).data("email"));
		$("#no_telfon").val($(this).data("notelfon"));
		$("#alamat").val($(this).data("alamat"));
		console.log($(this).data());
	});
});