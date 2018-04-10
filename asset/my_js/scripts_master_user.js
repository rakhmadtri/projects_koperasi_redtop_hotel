$(function() {
	$.initForm(function(){
		//dalem ini isinya yg isi data tadi yg di comment di scripts.js
		$("#kode").val($(this).data("kode"));
		$("#nama").val($(this).data("nama"));
		$("#email").val($(this).data("email"));
		// $("#password").val($(this).data("txt2"));
		$("#no_telfon").val($(this).data("notelfon"));
		$("select[name=keterangan]").select2("val",$(this).data("selected"));
		$("#alamat").val($(this).data("alamat"));
		console.log($(this).data());
	});
	var showModal = function(){
		var fileName = URL.createObjectURL(event.target.files[0]);
		if (fileName!=null){
			$(".image-modal").fadeIn('slow');
	       	$("#profile_img").attr('src',fileName);
		};
	}
	$("#foto_profile").change(showModal);
	$(".modal .close").click(function(){
		$(".image-modal").fadeOut('slow');
	});
	// $("#view_password").click(function(){
	// 	$('#password').get(0).type = 'text';
	// });
});