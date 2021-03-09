// bootstrap multiselect
$(document).ready(function() {

    let bs_multi = $('.bsmultiselect');

    if(bs_multi.length) {
        bs_multi.each(function (index, element) {

            let nonSelectedText = $(this).data("text");
            let maxHeight = $(this).data("height");
            let dropUp = $(this).data("dropup");
            let buttonWidth = $(this).data("width");
            let id = $(this).data("id");

            $(this).multiselect({
                nonSelectedText: nonSelectedText,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                enableHTML: false,
                includeSelectAllOption: true,
                maxHeight: maxHeight,
                dropUp: dropUp,
                buttonWidth: buttonWidth,

                templates: {
                    li: '<li><a class="dropdown-item my-1"><label class="m-0 px-0 w-100"></label></a></li>',
                    // ul: ' <ul class="multiselect-container dropdown-menu w-100" id="'+id+'"></ul>',
                    ul: ' <ul class="multiselect-container dropdown-menu w-100" id=""></ul>',
                    button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" data-flip="false"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>',
                    filter: '<li class="multiselect-item filter" style="min-width:100%"><div class="input-group"><input class="form-control multiselect-search rounded-0" type="text"></div></li>',
                    filterClearBtn: '<div class="mr-2 input-group-append"><button class="btn btn-sm btn-secondary m-0 multiselect-clear-filter" type="button"><i class="fas fa-times"></i></button></div>'
                },
                buttonContainer: '<div class="dropdown" />',
                buttonClass: 'btn btn-secondary'
            });
        });
    }
});
