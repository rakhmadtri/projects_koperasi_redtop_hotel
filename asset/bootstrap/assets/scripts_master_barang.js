$(function() {
    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
	  $('#sidebar').hide('fast', function() {
	  	$('#content').removeClass('span9');
	  	$('#content').addClass('span12');
	  	$('.hide-sidebar').hide();
	  	$('.show-sidebar').show();
	  });
	});

	$('.show-sidebar').click(function() {
		$('#content').removeClass('span12');
	   	$('#content').addClass('span9');
	   	$('.show-sidebar').hide();
	   	$('.hide-sidebar').show();
	  	$('#sidebar').show('fast');
	});

	var formVisible = false;
	var showHideForm = function(){
		var form = $("#form_sample_1");
		if(!form.is(":visible")){
			form.stop(true,true).slideDown("fast",function(){
				formVisible = true;

			});
		}else if(formVisible){
			form.stop(true,true).slideUp("fast",function(){
				formVisible = false;
			});
		}
	}
	$("#btn_addnew").click(function(){
		showHideForm();
		return false;
	});
	$(".btn_edit").click(function(){
		var form = $("#form_sample_1");
		if(!form.is(":visible")){
			showHideForm();
		}
		$("input[name=kode]").val($(this).data("kode"));
		$("input[name=name]").val($(this).data("nama"));
		$("select[name=category]").val($(this).data("category"));
		$("input[name=license]").val($(this).data("license"));
		$("textarea[name=deskripsi]").val($(this).data("deskripsi"));
		$("input[name=status]").prop("checked",$(this).data("status-checked")=="checked"?true:false); 
		$("#kode").prop('readonly',true);				
	});
});
