$(function(){
    // input number only
    $('.numericOnly').bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
             
        if (!(keyCode >= 48 && keyCode <= 57)) {
          return false;
        }
    });

    $('.rupiah').number( true, 2);
});
