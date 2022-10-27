// MEMBERSHIP QUIZ
if ($("#form-4260").length == 1) {
    function onlyNumbers(number) {
        return(number.replace(/[^0-9]/g, ""));
    }

    $('#text-53316 label').append('<span id="q1-custom-text">Hint: If you are unsure, how many thermostats do you have?</span>');

    var radio53290Img = '<div class="radio-53290-img-wrap"><img src="images/img-filter-illustration.png" alt="Filter Illustration" /></div>';
    $(radio53290Img).insertAfter('#radio-53290 fieldset legend');

    var radio53294Img = '<div class="radio-53294-img-wrap"><img src="images/img-humidfier-illustration.png" alt="Humidfier Illustration" /></div>';
    $(radio53294Img).insertAfter('#radio-53294 fieldset legend');

    var radio53295Img = '<div class="radio-53295-img-wrap"><img src="images/img-system-illustration.png" alt="System Illustration" /></div>';
    $(radio53295Img).insertAfter('#radio-53295 fieldset legend');

    var radio53297Img = '<div class="radio-53297-img-wrap"><img src="images/img-phone-computer-illustration.png" alt="Phone and Computer Illustration" /></div>';
    $(radio53297Img).insertAfter('#radio-53297 fieldset legend');

    var radio53298Img = '<div class="radio-53298-img-wrap"><img src="images/img-shield-checkmark-illustration.png" alt="Shield with Checkmark Illustration" /></div>';
    $(radio53298Img).insertAfter('#radio-53298 fieldset legend');

    $('#pageBack4260').append('<span>Previous</span>');
    $('#pageNext4260').append('<span>Next</span>');

    $("#53316").after('<div id="input-53316-buttons"><span class="span-53316-buttons" id="up"></span><span class="span-53316-buttons" id="down"></span></div>');

    $("span[class='span-53316-buttons']").off('click').on('click', function() {
        var whichWay = $(this).prop("id");
        if (whichWay == 'up') {
            $("#53316").val($("#53316").val()*1+1);
        }
        else {
            if ($("#53316").val() != 0) {
                $("#53316").val($("#53316").val()*1-1);
            }
        }
    });

    $("#53316").off('change').on('change', function() {
        $("#53316").val(onlyNumbers($("#53316").val()));
    });

    // move to next question
    //var qnum = 0;
    $("#start-quiz-btn, #question-1-btn, .formRow input[type='radio']").off('click').on('click', function() {
        if ($(this).parents('li').attr('id') == 'radio-53297') {
            document.getElementById('submit4260').click();
        } else {
            pageNext4260();

            document.body.scrollTop = 1;
            document.documentElement.scrollTop = 1;
        }
    });

    // previous question
    $("div.previousQuestion").off('click').on('click', function() {
        pageBack4260();
    });
}
