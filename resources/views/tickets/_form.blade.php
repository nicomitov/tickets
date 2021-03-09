{{-- NAME --}}
<div class="form-group row required">
    {{ Form::label('name', __('Name:'), ['class' => 'col-sm-2 form-control-label']) }}
    <div class="col-sm-10">
    {{ Form::text('name', null, ['class'=>'form-control boxed', 'placeholder'=>'The name must be at least 2 characters']) }}
    </div>
</div>

{{-- DESCRIPTION --}}
<div class="form-group row required">
    {{ Form::label('description', __('Description:'), ['class' => 'col-sm-2 form-control-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('description', null, ['class'=>'form-control boxed', 'id' => 'tiny', 'placeholder'=>'The description must be at least 2 characters', 'rows' => 6]) }}
    </div>
</div>

{{-- EMPLOYEES --}}
<div class="form-group row required">
    {{ Form::label('toEmployees[]', __('Employees:'), ['class' => 'col-sm-2 form-control-label']) }}
    <div class="col-sm-10">
        <select multiple="true" name="toEmployees[]" class="form-control boxed bsmultiselect" data-width="100%" data-height="200" data-text="None Selected" data-dropup="false">

            @foreach($emp as $employee)

            @if(!in_array($employee, $selected))
            <option value="{{ $employee['id'] }}">
                {{ $employee['name'] }}
            </option>
            @else
            <option value="{{ $employee['id'] }}" selected="selected">
                {{ $employee['name'] }}
            </option>
            @endif
            @endforeach

        </select>
    </div>
</div>

{{-- PRIORITY --}}
<div class="form-group row required">
    {{ Form::label('priority_id', __('Priority:'), ['class' => 'col-sm-2 form-control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('priority_id', $priorities, null, ['class'=>'form-control boxed', 'laceholder'=>'Please Select...']) }}
    </div>
</div>

{{-- STATUS --}}
<div class="form-group row required">
    {{ Form::label('status_id', __('Status:'), ['class' => 'col-sm-2 form-control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('status_id', $statuses, null, ['class' => 'form-control boxed', 'laceholder' => 'Please Select...']) }}
    </div>
</div>

{{-- CATEGORY --}}
<div class="form-group row required">
    {{ Form::label('category_id', __('Category:'), ['class' => 'col-sm-2 form-control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('category_id', $categories, null, ['class'=>'form-control boxed', 'laceholder'=>'Please Select...']) }}
    </div>
</div>

@include('partials.btn_send')
