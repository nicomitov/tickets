<div class="item-col fixed item-col-actions-dropdown">
    <div class="item-actions-dropdown">
        <a class="item-actions-toggle-btn">
            <span class="inactive">
                <i class="fas fa-cog"></i>
            </span>
            <span class="active">
                <i class="fas fa-chevron-circle-right"></i>
            </span>
        </a>
        <div class="item-actions-block">
            <ul class="item-actions-list">
                @if(strpos(url()->current(), 'trashed'))
                <li>
                    {{Form::open(['method' => 'DELETE', 'route'=> [$route.'.restore', $model ]])}}
                    <button class="remove" data-rel="tooltip" title="@lang('Restore')" type="submit" role="button"><i class="fas fa-undo fa-fw"></i></button>
                    {{Form::close()}}
                </li>
                @else
                <li>
                    @include('partials.btn_delete_modal', ['model' => $model, 'route' => $route.'.destroy', 'btn_class' => 'remove', 'permission' => ['delete', $model], 'message' => $message ?? null])
                </li>
                <li>
                    @if (isset($modal) && $modal)
                        @include('partials.btn_edit_modal', ['model' => $model, 'route' => $route.'.update', 'redirect' => $route.'.index', 'class' => 'edit', 'title' => 'icon', 'modal_title' => 'Edit ', 'permission' => ['update', $model]])
                    @else
                        <a href="{{ route($route.'.edit', $model) }}" class="edit">
                            <i class="far fa-edit icon"></i>
                        </a>
                    @endif
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

{{-- <script type="text/javascript">
    $(function() {
        let $itemActions = $(".item-actions-dropdown");

        $(document).on('click',function(e) {
            if (!$(e.target).closest('.item-actions-dropdown').length) {
                $itemActions.removeClass('active');
            }
        });

        $('.fa-cog').on('click',function(e){
            e.preventDefault();

            let $thisActionList = $(this).closest('.item-actions-dropdown');

            $thisActionList.addClass('active');
        });

        $('.fa-chevron-circle-right').on('click',function(e){

            e.preventDefault();

            let $thisActionList1 = $(this).closest('.item-actions-dropdown');
            console.log($thisActionList1)

            $thisActionList1.removeClass('active');
        });
    });

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
</script> --}}

