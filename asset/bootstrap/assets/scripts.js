//$.fn.showHideMenu
$.showHideMenu = function(){
	if($("body").width() > 979){
		var sidebar = $("#sidebar");
		var content = $("#content");
		
		//untuk pertama kali
		sidebar.width(42);
		content.width(1260);

		var show = function(isShow){ //true / false
			if(!isShow){
				sidebar.stop(true,true).animate({
					width : "42px"
				});
				content.stop(true,true).animate({
					width : "1260px"
				});
			}else{
				sidebar.stop(true,true).animate({
					width : "302.063px",
		      		paddingLeft: "55px"
				});
				content.stop(true,true).animate({
					width : "973.344px"
				});
			}
		}

		var status = false;

		sidebar.click(function(){
			if(!status){
				status = !status;
				show(status); //saat hover masuk
				return !status;
			}
		});
	}
}

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
		var form = $("#form_sample_1,#form");
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
		var form = $("#form_sample_1,#form");
		if(!form.is(":visible")){
			showHideForm();
		}
		$("input[name=kode]").val($(this).data("kode"));
		$("input[name=name]").val($(this).data("nama"));
		$("input[name=email]").val($(this).data("email"));
		$("textarea[name=alamat]").val($(this).data("alamat"));
		$("input[name=number]").val($(this).data("no-telfon"));
		//change by martin
		$("input[name=deskripsi]").val($(this).data("deskripsi"));
    	$("select[name=cabang]").val($(this).data("cabang"));
		//end change by martin
	return false;
	});

	//fix menu tidak bisa di klik pada mobile
	$("li.dropdown a").click(function(e){
	    $(this).next('ul.dropdown-menu').css("display", "block");
	    e.stopPropagation();
    });

    var slide = function(){
    	if($(this).is(".show")){
    		$(this).removeClass("show");
    	}else{
    		$(this).addClass("show");
    	}

    	var id = $(this).attr("id");
   		$('[data-target="'+id+'"]').slideToggle();

    	return false;
    }


    $(".menu-slide-parent").click(slide);

    $("[data-target]").each(function(){
    	if($(this).is(".active")){
    		var target = $(this).data("target");
    		slide.call($("#"+target));
    	}
    });

    $.showHideMenu();
});