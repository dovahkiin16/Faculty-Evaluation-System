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
    $("#submit-eval").click(function() {
        var name = "";
        var hasChecks = false;
        $("input[type='radio']").each(function() {
            if(name!==$(this).attr("name") || name==="") {
                if(name!=="") {
                    if(!hasChecks) {
                        $("#"+name+"-row").css("border", "2px solid red");
                    } else {
                        $("#"+name+"-row").css("border-color", "rgb(233, 236, 239)")
                    }
                }
                name = $(this).attr("name");
                hasChecks = false;
            }
            if($(this).is(':checked')){
                console.log("has check");
                hasChecks = true;
            }
        });
        if(!hasChecks) {
            $("#"+name+"-row").css("border", "2px solid red");
        } else {
            $("#"+name+"-row").css("border-color", "rgb(233, 236, 239)")
        }
    });
    $("#submit-sched").click(function(event) {
        $("input[type='text'].select-dropdown").each(function() {
            console.log($(this).val());
            if($(this).val() === 'Day' || $(this).val() === 'Month' || $(this).val() === 'Year' || $(this).val() === 'Room') {
                $("#error-message").text("The " + $(this).val() + " field is missing");
                $("#error-holder").show();
                event.preventDefault();
                return;
            }
            if($("input[type='radio']:checked").length === 0) {
                $("#error-message").text("Please choose an evaluator");
                $("#error-holder").show();
                event.preventDefault();
            }
        });
    });
});

