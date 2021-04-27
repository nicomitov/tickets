require('./bootstrap');
require('./bootstrap-multiselect');
require('./prettify');
// require('datatables.net-bs4');
require('metismenu');

$(document).ready(function() {

    // datatables actions
    $('table').on('draw.dt', function() {
        // popover
        $('[data-toggle="popover"]').popover();

        // tooltip
        $('[data-rel="tooltip"]').tooltip();

        // dropdown
        $(function() {
            let $itemActions = $(".item-actions-dropdown");

            $(document).on('click',function(e) {
                if (!$(e.target).closest('.item-actions-dropdown').length) {
                    $itemActions.removeClass('active');
                }
            });

            $('.item-actions-toggle-btn').on('click',function(e){
                e.preventDefault();

                var $thisActionList = $(this).closest('.item-actions-dropdown');

                $itemActions.not($thisActionList).removeClass('active');

                $thisActionList.toggleClass('active');
            });
        });

        // form-delete
        $(function() {
            $('.form-delete').on('click',  function(e){
                e.preventDefault();
                $('.modal-title').text('Delete Confirmation');

                if ($('.del').length > 0 && $('.del').data("message").length > 0) {
                    $('.modal-body').html("<p>"+$('.del').data("message")+"</p><p>Are you sure you, want to delete?</p>");
                } else {
                    $('.modal-body').html("<p>Are you sure you, want to delete?</p>");
                }

                $('.modal-footer').html("<button type=\"button\" class=\"btn btn-danger\" id=\"delete-btn\" role=\"button\">Delete</button><button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\" role=\"button\">Close</button>");
                $('#modal').modal('show');
                var $form=$(this);
                $('#modal').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                        $form.submit();
                    });
            });
        });

        $(function() {
            $('.dataTable tbody').on('click', '.form-delete', function (e) {
                e.preventDefault();
                let form = $(this);

                $('#confirm').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                        form.submit();
                });
            });
        });
    })
    // datatables actions

    // THEME
    $(function() {
        var $itemActions = $(".item-actions-dropdown");

        $(document).on('click',function(e) {
            if (!$(e.target).closest('.item-actions-dropdown').length) {
                $itemActions.removeClass('active');
            }
        });

        $('.item-actions-toggle-btn').on('click',function(e){
            e.preventDefault();

            var $thisActionList = $(this).closest('.item-actions-dropdown');

            $itemActions.not($thisActionList).removeClass('active');

            $thisActionList.toggleClass('active');
        });
    });

    $(function () {
        $('#sidebar-menu').metisMenu({
            activeClass: 'open',
            toggle: true,
        });

        $('#sidebar-collapse-btn').on('click', function(event){
            event.preventDefault();

            $("#app").toggleClass("sidebar-open");
        });

        $("#sidebar-overlay").on('click', function() {
            $("#app").removeClass("sidebar-open");
        });
    });

    // END THEME

    // // datatables
    // let table = $('#dTable').DataTable({
    //     lengthMenu: [10, 20, 50, 100, 1000],
    //     "pageLength": 20,
    //     responsive: true,
    //     "deferRender": true,
    //     columnDefs: [
    //        { orderable: false, targets: -1 }
    //     ]
    // });

    // // datatables modal delete
    // $('#dTable tbody').on('click', '.form-delete', function (e) {
    //     e.preventDefault();
    //     let form = $(this);

    //     $('#confirm').modal({ backdrop: 'static', keyboard: false })
    //         .on('click', '#delete-btn', function(){
    //             form.submit();
    //     });
    // });

    // // dadtatables clickable row
    // $('table').on('click', '.clickable', function (event) {
    //     if(!$(event.target).hasClass('href')) {
    //        window.document.location = $(this).data("href");
    //     }
    // });

    // email generate
    $(function() {
        $('#generate_email').on('click', function() {
            let chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
            let string = '';
            for(var ii=0; ii<8; ii++){
                string += chars[Math.floor(Math.random() * chars.length)];
            }

            $('#email').val(string + '@gmail.com');
        });
    });

    // pass generate
    $(function() {
        $('#generate_passwd').on('click', function() {
            let chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
            let string = '';
            for(var ii=0; ii<8; ii++){
                string += chars[Math.floor(Math.random() * chars.length)];
            }

            $('#password').val(string);
        });
    });

    $(function() {
        $('.toggle-password').on('click', function() {
            $(this).children().toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });

    // TOOLTIPS
    $('[data-rel="tooltip"]').tooltip();

    // filter menu collapse
    let windowWidth = $(window).width();
    if(windowWidth < 1200) {
        $('.collapse').removeClass('show')
    }

    // collapse clickable
    $(function() {
        $('.click').on('click', function() {
            $('.fa', this)
            .toggleClass('fa-chevron-up')
            .toggleClass('fa-chevron-right');
        });
    });

    // remove menuitem
    $('.remove_item').click(function(e) {
        e.preventdefault;
        $(this).parent().parent().remove();
    })

    // RESET AVATAR
    $('#reset_avatar').click(function() {
        let id = $(this).data("id");
        $('input#thumbnail').val('default.png');
        $('img#holder').attr('src','/storage/photos/'+id+'/avatars/thumbs/default.png');
    })

    // POPOVER
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    $(document).on('click', function (e) {
        $('[data-toggle="popover"],[data-original-title]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
            }
        });
    });

    // scroll to bottom messages pane
    $(".msg_history").animate({ scrollTop: $(this).height() }, "slow");
    // return false;

    // PRETTYPRINT
    $(".prettyprint br").each(function(index, element) {
        $(element).replaceWith(document.createTextNode("\n"));
    });
    prettyPrint();


    // SELECT ALL CHECKBOXES
    $('#selectAll').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.check_item').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "check_item"
            });
        }else{
            $('.check_item').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "check_item"
            });
        }
    });

    // set active tab by url
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#") + 1);

    if (activeTab !== url) {
        $(".tab-pane").removeClass("active show");
        $(".nav-link").removeClass("active show");
        $("#" + activeTab).addClass("active show");
        $("#" + 'nav-' + activeTab).addClass("active show");
    }


    // alert popup hide
    // setTimeout(function() {
    //     if ($("#alert").length > 0) {
    //         $("#alert").fadeTo(500, 0).slideUp(500, function() {
    //             $(this).remove();
    //         });
    //     }
    // }, 4000);
    setTimeout(function() {
        if ($("#alert").length > 0) {
            $("#alert").fadeTo(5, 0).slideUp(5, function() {
                $(this).remove();
            });
        }
    }, 5000);


    // prevent form-submit on pressing enter
    $(document).on("keypress", 'form', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13 && !$(e.target).is(".form_submit") && !$(e.target).is("textarea")) {
            e.preventDefault();
            return false;
        }
    });

    // specificationsModal
    $(document).on('click', '#specModal', function(e) {
        $('#specificationsModal').modal('show');
        // $('.modal-body').html($(this).data("spec"));
        children = document.querySelectorAll('#specificationsModal .modal-body');
        $(children).html($(this).data("spec"));
    });

    // new check
    // $(document).on('click', '#create_check', function(e) {
    //     e.preventDefault();
    //     $('#check').modal('show');
    //     $url = $(this).data("href");
    // });

    // $('body').on('click', '#check_submit_btn', function() {
    //     let form = $("#check_form");
    //     let formData = form.serialize();

    //     $('#check-error').html( "" );

    //     $.ajax({
    //         url: $url,
    //         type: 'POST',
    //         data: formData,
    //         success:function(data) {
    //             if(data.success) {
    //                 $('#check').modal('hide');
    //                 location.href = '/logs/'+data.name+'?success=1';
    //             }
    //         },
    //     })
    // });

    // modal reset
    $(function () {
        var myBackup = $('#modal').clone();

        $(document).on("hidden.bs.modal", "#modal", function () {
            $('#modal').modal('hide').remove();
            var myClone = myBackup.clone();
            $('body').append(myClone);
        });
    });

    // modal 403
    $(document).on('click', '#403', function(e) {
        e.preventDefault();
        $('.modal-title').text('Permission denied');
        $('.modal-body').html("<i class=\"fa fa-times-circle text-danger fa-2x align-middle mr-2\"></i><p class=\"d-inline\">Sorry, you don\'t have permissions to view this page!</p>");
        $('#modal').modal('show');
        $('#modal_submit_btn').remove();
        $('.modal-footer').html('<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">Close</button>');
    });

    // modal delete
    $('.form-delete').on('click',  function(e){
        e.preventDefault();
        $('.modal-title').text('Delete Confirmation');

        if ($('.del').length > 0 && $('.del').data("message").length > 0) {
            $('.modal-body').html("<p>"+$('.del').data("message")+"</p><p>Are you sure you, want to delete?</p>");
        } else {
            $('.modal-body').html("<p>Are you sure you, want to delete?</p>");
        }

        $('.modal-footer').html("<button type=\"button\" class=\"btn btn-danger\" id=\"delete-btn\" role=\"button\">Delete</button><button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\" role=\"button\">Close</button>");
        $('#modal').modal('show');
        var $form=$(this);
        $('#modal').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
                $form.submit();
            });
    });

    // modal create
    $(document).on('click', '#create_modal', function(e) {
        e.preventDefault();
        $('.modal-title').text($(this).data("title"));
        $('#modal').modal('show');
        if ($("#modal_form").length > 0) {
            $("#modal_form")[0].reset();
            // if ($("#recipients[]").length > 0) {
                // $("#recipients").multiselect('rebuild');
            // }
        }
        $action = $(this).data("action");
        $url = $(this).data("href");
        $redirect = $(this).data("redirect");
        bsms();
    });

    // modal edit
    $(document).on('click', '#edit_modal', function(e) {
        e.preventDefault();
        $('.modal-title').text($(this).data("title"));
        $('#modal').modal('show');
        $action = $(this).data("action");
        $url = $(this).data("href");
        $redirect = $(this).data("redirect");
        bsms();

        if ($(".item_title").length > 0) {
            $('.item_title').val($(this).data('item_title'));
        }
        if ($("#depth").length > 0) {
            $('#depth').val($(this).data('model').depth);
        }
        if ($(".parent_id").length > 0) {
            $(".parent_id").val($(this).data('parent_id'));
        }
        if ($(".item_url").length > 0) {
            $(".item_url").val($(this).data('item_url'));
        }
        if ($(".is_dropdown").length > 0) {
            if ($(this).data('is_dropdown') == 1) {
                $('.is_dropdown')[0].checked = true;
            }
        }

        if ($("#name").length > 0) {
            $('#name').val($(this).data('model').name);
        }
        if ($("#abbr").length > 0) {
            $('#abbr').val($(this).data('model').abbr);
        }
        if ($("#department_id").length > 0) {
            // $("#department_id").val($(this).data('model').department_id);
            // $('#department_id').multiselect('rebuild');
            $('.bsmultiselect').multiselect('select', $(this).data('model').department_id);
        }
        if ($("#work_phone").length > 0) {
            $('#work_phone').val($(this).data('model').work_phone);
        }
        if ($("#mobile_phone").length > 0) {
            $('#mobile_phone').val($(this).data('model').mobile_phone);
        }
        if ($("#device_group_id").length > 0) {
            $("#device_group_id").multiselect('select', $(this).data('model').device_group_id);
        }
        if ($("#device_supplier_id").length > 0) {
            $("#device_supplier_id").multiselect('select', $(this).data('model').device_supplier_id);
        }
        if ($("#num").length > 0) {
            $('#num').val($(this).data('model').num);
        }
        if ($("#description").length > 0) {
            $('#description').val($(this).data('model').description);
        }
        if ($("#time").length > 0) {
            $('#time').val($(this).data('model').time);
        }
        if ($("#item_order").length > 0) {
            $('#item_order').val($(this).data('model').item_order);
        }
        if ($("#display_name").length > 0) {
            $('#display_name').val($(this).data('model').display_name);
        }
        // if ($("#toPermissions").length > 0) {
        //     $('#toPermissions').val($(this).data('permissions'));
        // }
        if ($("#toRoles").length > 0) {
            $('#toRoles').val($(this).data('roles'));
        }
        if ($("#device_type_id").length > 0) {
            $("#device_type_id").multiselect('select', $(this).data('model').device_type_id);
        }
        if ($("#specifications").length > 0) {
            $('#specifications').val($(this).data('model').specifications);
        }
        if ($("#service").length > 0) {
            $('#service').val($(this).data('model').service);
        }
        if ($("#date_manufacture").length > 0) {
            $('#date_manufacture').val($(this).data('manuf'));
        }
        if ($("#date_purchase").length > 0) {
            $('#date_purchase').val($(this).data('purch'));
        }
        if ($("#date_warranty").length > 0) {
            $('#date_warranty').val($(this).data('warr'));
        }
        if ($("#email").length > 0) {
            $('#email').val($(this).data('model').email);
        }
        if ($("#eik").length > 0) {
            $('#eik').val($(this).data('model').eik);
        }
        if ($("#address").length > 0) {
            $('#address').val($(this).data('model').address);
        }
        if ($("#phone").length > 0) {
            $('#phone').val($(this).data('model').phone);
        }
        if ($("#bank").length > 0) {
            $('#bank').val($(this).data('model').bank);
        }
        if ($("#iban").length > 0) {
            $('#iban').val($(this).data('model').iban);
        }
        if ($("#bic").length > 0) {
            $('#bic').val($(this).data('model').bic);
        }
        // $('#modal').on('hidden.bs.modal', function (e) {
            // $('#department_id').multiselect('destroy');
            // $('.modal-body').html('');
        // })

    });

    $('body').on('click', '#modal_submit_btn', function() {
        let form = $("#modal_form");
        let formData = form.serialize();

        $('#modal-error').html( "" );

        if ($action == 'create') {
            $type = 'POST';
        } else if ($action == 'edit') {
            $type = 'PUT';
        }

        $('.loading').show();  // show the loading message.
        $.ajax({
            url: $url,
            type: $type,
            data: formData,
            success:function(data) {
                if(data.errors) {
                    $('.loading').hide();

                    if(data.errors.title){
                        $('#title-error').html( data.errors.title[0] );
                    }

                    if(data.errors.name){
                        $('#name-error').html( data.errors.name[0] );
                    }
                    if(data.errors.abbr){
                        $('#abbr-error').html( data.errors.abbr[0] );
                    }
                    if(data.errors.num){
                        $('#num-error').html( data.errors.num[0] );
                    }
                    if(data.errors.department_id){
                        $('#department_id-error').html( data.errors.department_id[0] );
                    }
                    if(data.errors.device_group_id){
                        $('#device_group_id-error').html( data.errors.device_group_id[0] );
                    }
                    if(data.errors.time){
                        $('#time-error').html( data.errors.time[0] );
                    }
                    if(data.errors.item_order){
                        $('#item_order-error').html( data.errors.item_order[0] );
                    }
                    if(data.errors.display_name){
                        $('#display_name-error').html( data.errors.display_name[0] );
                    }
                    if(data.errors.subject){
                        $('#subject-error').html( data.errors.subject[0] );
                    }
                    if(data.errors.message){
                        $('#message-error').html( data.errors.message[0] );
                    }
                    if(data.errors.recipients){
                        $('#recipients-error').html( data.errors.recipients[0] );
                    }
                    if(data.errors.device_type_id){
                        $('#device_type_id-error').html( data.errors.device_type_id[0] );
                    }
                    if(data.errors.email){
                        $('#email-error').html( data.errors.email[0] );
                    }
                    if(data.errors.eik){
                        $('#eik-error').html( data.errors.eik[0] );
                    }
                    if(data.errors.device_supplier_id){
                        $('#device_supplier_id-error').html( data.errors.device_supplier_id[0] );
                    }

                    // if(data.errors.specifications){
                    //     $('#specifications-error').html( data.errors.specifications[0] );
                    // }
                    // if(data.errors.service){
                    //     $('#service-error').html( data.errors.service[0] );
                    // }
                    // if(data.errors.date_manufacture){
                    //     $('#date_manufacture-error').html( data.errors.date_manufacture[0] );
                    // }
                    // if(data.errors.date_purchase){
                    //     $('#date_purchase-error').html( data.errors.date_purchase[0] );
                    // }
                    // if(data.errors.date_warranty){
                    //     $('#date_warranty-error').html( data.errors.date_warranty[0] );
                    // }
                }
                if(data.success) {
                    $('#modal').modal('hide');

                    if ($("#to_tags").length > 0) {
                        // entry - add/edit - new tag - append
                        $('#to_tags').append('<option value="'+data.id+'">'+data.name+'</option>');
                        // $('.content').append('<div class="alert alert-success" id="alert"><span class="close" data-dismiss="alert" role="button">&times;</span><i class="fa fa-check fa-lg fa-fw" aria-hidden="true"></i> Successfully created!</div>');
                        $('#alert').delay(5000).hide(0);
                        $('#to_tags').multiselect('rebuild');
                        $('#to_tags').multiselect('select', data.id);
                    } else {
                        if ($action == 'create') {
                            location.href = $redirect+'?created=1';
                        } else {
                            location.href = $redirect+'?updated=1';
                        }
                    }
                    $('.loading').hide();
                }
            },
        });
    });

    // bootstrap-multiselect init settings
    function bsms() {
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
                ul: ' <ul class="multiselect-container dropdown-menu w-100"></ul>',
                button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" data-flip="false"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>',
                filter: '<li class="multiselect-item filter" style="min-width:100%"><div class="input-group"><input class="form-control multiselect-search rounded-0" type="text"></div></li>',
                filterClearBtn: '<div class="mr-2 input-group-append"><button class="btn btn-sm btn-secondary m-0 multiselect-clear-filter" type="button"><i class="fas fa-times"></i></button></div>'
            },
            buttonContainer: '<div class="dropdown" />',
            buttonClass: 'btn btn-secondary'
        });
        });
    }
    };
});



