$(function(){

    var form1 = $('#form');
    var valid = true;
    var validate = form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            nik: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            url: {
                required: true,
                url: true
            },
            number: {
                required: true,
                number: true
            },
            number1: {
                required: true,
                number: true
            },
            digits: {
                required: true,
                digits: true
            },
            creditcard: {
                required: true,
                creditcard: true
            },
            occupation: {
                minlength: 5,
            },
            category: {
                required: true
            }
        },
        submitHandler: function (form) {
            if (valid) {
                form.submit();
            };
        }
    });
    //validasi 
    var primarykey=$("#primarykey");
    primarykey.blur(function(){
        if(validate.check(primarykey)){
             $.ajax({
                url:"master_anggota/cek_validation",
                type:"post",
                data:{"data_js":primarykey.val()},
                success:function(data){
                    var error = primarykey.siblings("div.error");
                    if (data=="ADA") {
                        if(error.length == 0){
                            error = $('<div for="inputEmail3" class="error">Data Sudah Ada Di Database !</div>');
                            error.insertAfter(primarykey);
                        }else{
                            error.html("Data Sudah Ada Di Database !");
                        }
                        valid=false;
                        error.show();
                    }else{
                        valid=true;
                        error.hide();
                    }
                }


            });
         }
    });
   
});