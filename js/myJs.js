$(document).ready(function() {
    $('.mdb-select').material_select();
    $('#input_starttime').pickatime({
        twelvehour: true
    });
    $("#formsignup").submit(function(event){
        if($("#pwd").val() != $("#conf-pwd").val()) {
            event.preventDefault();
            toastr.error("Password do not match");
        }
    });
});

