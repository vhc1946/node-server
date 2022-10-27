// Rewards Membership Subscription
if ($("#form-4327").length == 1) {
    function hideShowPage1() {
        for (var i = 1; i < 3; i++) {
            $("#form-4327 #row-"+i).toggle();
        }
        $("#ecomTotal").toggle();
        $("#pageButton").toggle();
    }
    hideShowPage1();

    function populateFormValues(whichSelected) {
        var addSystem = 0;
        var filterStd = 0;
        var humPad = 0;
        var filterSpec = 7;
        var timeSave = -4;
        if (whichSelected == 44) {
            // Ultimate
            addSystem = 37;
        } else if (whichSelected == 33) {
            // Premium
            addSystem = 29;
        } else if (whichSelected == 24) {
            // Classic
            addSystem = 21;
            filterStd = 5;
            humPad = 5;
            filterSpec = 12;
        }
        // Additional Systems
        $("input[name=54055-ecomVariable1]").attr("value", addSystem);
        // Standard Filters
        $("input[name=54064-ecomVariable1]").attr("value", filterStd);
        // Humidifier Service/Pad
        $("input[name=54066-ecomVariable1]").attr("value", humPad);
        // Specialty Filters
        $("input[name=54070-ecomVariable1]").attr("value", filterSpec);
        // Time Saver Deduction
        $("input[name=54075-ecomVariable1]").attr("value", timeSave);

        if ($("#ecomTotal").css('display') == 'none') {
            hideShowPage1();
        }
    }
    $('select[name="54231-ecomSelect"]').on('change', function() {
        populateFormValues(this.value);
    });

    var whichPlan = getQueryVariable("s");
    if (whichPlan != false) {
        $("select[name='54231-ecomSelect'] option[value="+whichPlan+"]").prop("selected", true);
        populateFormValues(whichPlan);
    }
    function checkMaxFilters() {
        var maxFilters = $('input[name="54055-ecomVariable"]').val() * 1 + 1;
        if ($('input[name="54064-ecomVariable"]').val() > maxFilters) {
            $('input[name="54064-ecomVariable"]').val(maxFilters);
        }
        if ($('input[name="54075-ecomVariable"]').val() > maxFilters) {
            $('input[name="54075-ecomVariable"]').val(maxFilters);
        }
        addEcom();
    }

    setTimeout(() => {
        // Additional Systems - max 10
        $('input[name="54055-ecomVariable"]').on('change', function() {
            if ($(this).val() > 10) {
                $(this).val('10');
            }
        });
        // Additional Component - max 5
        $('input[name="54058-ecomVariable"]').on('change', function() {
            if ($(this).val() > 5) {
                $(this).val('5');
            }
        });

        // Standard filters & Time Saver Deduction not to exceed number of systems
        // Standard Filters
        $('input[name="54064-ecomVariable"]').on('change', function() {
            checkMaxFilters();
        });
        // Time Saver Deduction
        $('input[name="54075-ecomVariable"]').on('change', function() {
            checkMaxFilters();
        });
        // Additional Systems
        $('input[name="54055-ecomVariable"]').on('change', function() {
            checkMaxFilters();
        });

        var btn = $("#pageNext4327");
        var clickHandler = btn[0].onclick;
        btn[0].onclick = false;

        $("#pageNext4327").off('click').on('click', function() {
            var selectedPlan = $('select[name="54231-ecomSelect"]').val();

            if (selectedPlan != '24') {
                var totalFilters = $('input[name="54064-ecomVariable"]').val() * 1;
                totalFilters += $('input[name="54070-ecomVariable"]').val() * 1;
                var totalSystems = $('input[name="54055-ecomVariable"]').val() * 1 + 1;
                var s = (totalSystems > 1) ? 's' : '';

                if (totalSystems > totalFilters) {
                    addErrorBox('ecomTotal', 'You must select at least '+totalSystems+' filter'+s);
                } else {
                    pageNext4327();
                    document.body.scrollTop = 1;
                    document.documentElement.scrollTop = 1;
                }
            } else {
                pageNext4327();

                document.body.scrollTop = 1;
                document.documentElement.scrollTop = 1;
            }
        });
    }, 100);

    // add tooltips
    $("#text-54055 legend").append(' <span data-tooltip tabindex="1" title="A system defined as something that does both heating and cooling, for example a furnace and an air conditioner is a system. Still not sure? Give us a call at 314.351.2533"><i class="fa fa-question-circle" aria-hidden="true"></i></span>');

    $("#text-54064 legend").append(' <span data-tooltip tabindex="1" title="The term \'standard filter\' applies to 100\'s of common filter sizes.  Normally, these are 1\'\' or 2\'\' thick.  If this is what your system uses check this.  You will get a year supply if you select this option.  Not sure, call us at 314.351.2533"><i class="fa fa-question-circle" aria-hidden="true"></i></span>');

    $("#text-54066 legend").append(' <span data-tooltip tabindex="1" title="How many humidifiers do you have?  Your Premium Rewards Plan includes maintaining your humidifier and we include a humidifier pad as a part of that service."><i class="fa fa-question-circle" aria-hidden="true"></i></span>');

    $("#text-54058 legend").append(' <span data-tooltip tabindex="1" title="Do you have a heating or cooling unit that is used for one season only?  We will service that system also without the need of a separate Premium Rewards Plan"><i class="fa fa-question-circle" aria-hidden="true"></i></span>');

    $("#text-54070 legend").append(' <span data-tooltip tabindex="1" title="Some filters rated at MERV 10 or above are considered to be a Specialty Filter due to the cost of these filters.  These are often 4\'\' thick or more.  Not sure if your filter is considered a specialty filter? Call us at 314.351.2533 and we will help you"><i class="fa fa-question-circle" aria-hidden="true"></i></span>');

    $("#text-54075 legend").append(' <span data-tooltip tabindex="1" title="Do you like to save time & money?  At the same visit we can provide the heating and cooling maintenance that\'s included with your Premium Rewards Plan"><i class="fa fa-question-circle" aria-hidden="true"></i></span>');
}
