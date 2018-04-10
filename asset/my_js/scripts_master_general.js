$(function() {
	$.initForm(function(){
		//dalem ini isinya yg isi data tadi yg di comment di scripts.js
		$("input[name=no_anggota]").val($(this).data("no"));
		$("input[name=nik]").val($(this).data("kode"));
		$("input[name=nama]").val($(this).data("nama"));
		$("select[name=departemen]").select2("val",$(this).data("selected"));
		$("select[name=jabatan]").select2("val",$(this).data("selectedj"));
		$("input[name=no_telpon]").val($(this).data("nomorsatu"));
		$("input[name=no_rekening]").val($(this).data("nomordua"));
		$("textarea[name=alamat]").val($(this).data("txt2"));
		console.log($(this).data());
		console.log($("select[name=jabatan]").length);
	});
});