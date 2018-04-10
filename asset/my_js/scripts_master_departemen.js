$(function() {
	$.initForm(function(){
		//dalem ini isinya yg isi data tadi yg di comment di scripts.js
		$("#kode").val($(this).data("kode"));
		$("#nama").val($(this).data("nama"));
		$("#keterangan").val($(this).data("keterangan"));
		console.log($(this).data());
	});
});