$.ajaxLoader={
	show:function(){
		if ($('.loader').length==0) {
			var loader=$('<div class="loader" style="display:none;position: fixed; width: 100%; height: 100%; left: 0; top: 0; background: rgba(0, 0, 0, 0.5); z-index: 9999">'+
							'<img src="asset/ajax-loader.gif" style="position: absolute; width: 16px; height: 16px; left: 0; top: 0; bottom: 0; right: 0; margin: auto">'+
						'</div>');
			$('body').append(loader);
			loader.fadeIn('slow');
		}
	},
	hide:function(){
		$('.loader').fadeOut('slow',function(){
			$(this).remove();
		});
	}
}


$(function(){
	$(".datepicker").datepicker({
		format:"yyyy-mm-dd"
	});
	$(".datepicker").datepicker().on("changeDate", function(ev){                 
        $(this).datepicker("hide");
    });
    $(".datepicker").keydown(function(){return false;});
 	$(".select2").select2();
	//buat Data table
	$('.datatable').DataTable({
	          "paging": true,
	          "lengthChange": true,
	          "searching": true,
	          "ordering": true,
	          "info": true,
	          "autoWidth": true
	        });

	$.initForm = function(callback){
		var formVisible = false;
		$("#form").hide();
		var showHideForm = function(){
			var form = $("#form");
			if(!form.is(":visible")){
				form.stop(true,true).slideDown("fast",function(){
					formVisible = true;

				});
			}
			else if(formVisible){
				form.stop(true,true).slideUp("fast",function(){
					formVisible = false;
				});
			}
		}
		
		$("#btn_addnew").click(function(){
			showHideForm();
			return false;
		});
		$(document).on("click",".btn_edit",function(){
			var form = $("#form");
			if(!form.is(":visible")){
				showHideForm();
			}
			callback.call(this);		
		});
	}


});