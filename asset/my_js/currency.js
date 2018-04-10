$.fn.currency = function(){
    var name = $(this).attr("name");
    var id = $(this).attr("id");
    var value = $('<input type="hidden" name="' + name + '" id="' + id + '-value">');
    value.insertAfter(this);
    // $(this).removeAttr("name");
    var format = function(num){
    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(",") > 0) {
        parts = str.split(",");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ".") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(".");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
	    return(formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
	};
	// $(this).keyup(function(){
	// 	var val = $(this).val();
	// 	value.val(getNumberValue(val));
 //        return(formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
 //    };
    $(this).keyup(function(){
        var val = $(this).val();
        // value.val(val);
        value.val(getNumberValue(val));
        $(this).val(format($(this).val()));
        console.log(val);
    });
}
var getNumberValue = function(val){
    val = val.replace("$","");
    val = val.replace(/\./g,"");
    return val;
}
$(function(){
    $("#nominal").currency();
    $(".nominal3").currency();
    $("#nominal2").currency();
});