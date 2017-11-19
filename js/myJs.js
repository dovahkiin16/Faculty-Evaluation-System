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
    $("#eval-tbl.table.table-bordered").floatThead();
    $("#eval-tbl2").floatThead();
    $(".sec-list-expander").on("click", function(event) {
        var id = event.target.value;
        $("#expand-" + id).toggle(300);
    });
    $("#account_type").change(function() {
        if($("#account_type")[0].value === "teacher") {
            $($("#section_selector")[0]).prop("disabled", true).prop("required", false);
            $($("input.select-dropdown")[1]).prop("disabled", true).prop("required", false);
        } else if ($("#account_type")[0].value === "student") {
            $($("#section_selector")[0]).prop("disabled", false).prop("required", true);
            $($("input.select-dropdown")[1]).prop("disabled", false).prop("required", true);
        }
    });
});

