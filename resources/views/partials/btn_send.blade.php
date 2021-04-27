@if(isset($submitBtnText))
    {{ Form::button($submitBtnText, ['class' => 'btn btn-primary', 'type' => 'submit']) }}
@else
    {{ Form::button('Save', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
@endif
