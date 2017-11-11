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
    $(".teacher-delete").click(function(event){
        $.post('/thesis/teacher/delete',{teacher_id: $(event.target).val()}, function(data) {
            if(data === "success") {
                console.log(data);
                $("#teacher-" + $(event.target).val()).hide(500);
            } else {
                console.log(data);
            }
        });
    });
});

