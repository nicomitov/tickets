<div class="d-flex flex-column flex-md-row flex-lg-row flex-xl-row justify-content-between">

    <div class="w-100">
        {{-- NAME --}}
        <div class="form-group row required">
            {{ Form::label('name', __('Name:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                {{ Form::text('name', null, ['class'=>'form-control boxed', 'placeholder'=>'The name must be at least 2 characters']) }}
            </div>
        </div>

        {{-- EMAIL --}}
        <div class="form-group row required">
            {{ Form::label('email', __('Email:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10 input-group mb-0">
                {{ Form::email('email', null, ['class'=>'form-control boxed', 'placeholder'=>'Email Address', 'aria-describedby' => 'generate_email']) }}

                <div class="input-group-append">
                    <button class="btn btn-info mb-0" type="button" id="generate_email">
                        Generate Email
                    </button>
              </div>
            </div>
        </div>

        {{-- PASSWD --}}
        <div class="form-group row required">
            {{ Form::label('password', __('Password:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10 input-group mb-0">
                {{ Form::password('password', ['class'=>'form-control boxed', 'placeholder'=>'The password must be at least 6 characters', 'aria-describedby' => 'generate_passwd']) }}

                <div class="input-group-append">
                    <a class="btn btn-warning mb-0 toggle-password">
                        <i class="fas fa-eye pt-1"></i>
                    </a>
                </div>

                <div class="input-group-append">
                    <button class="btn btn-info mb-0" type="button" id="generate_passwd" style="padding-top:8px; padding-bottom:8px">
                        Generate Password
                    </button>
              </div>
            </div>
        </div>

        {{-- PASSWD CONFIRM --}}
        @if (Request::segment(3) == 'edit')
        <div class="form-group row required">
            {{ Form::label('password_confirmation', __('Confirmation:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                {{ Form::password('password_confirmation', ['class'=>'form-control boxed', 'placeholder'=>'The password must be at least 6 characters']) }}
            </div>
        </div>
        @endif

        {{-- DEPT --}}
        <div class="form-group row required">
            {{ Form::label('department_id', __('Department:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                {{ Form::select('department_id', $departments, null, ['class'=>'form-control boxed bsmultiselect', 'data-width' => '100%', 'data-height' => '200', 'data-text' => 'Select department', 'data-dropup' => 'false', 'data-id' => 'department_id']) }}
            </div>
        </div>

        {{-- POSITION --}}
        <div class="form-group row">
            {{ Form::label('position', __('Position:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                {{ Form::text('position', null, ['class'=>'form-control boxed', 'placeholder'=>'e.g. IT-Technician']) }}
            </div>
        </div>

        {{-- W PHONE --}}
        <div class="form-group row">
            {{ Form::label('work_phone', __('Work Phone:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                {{ Form::text('work_phone', null, ['class'=>'form-control boxed', 'placeholder'=>'e.g. 363']) }}
            </div>
        </div>

        {{-- m PHONE --}}
        <div class="form-group row">
            {{ Form::label('mobile_phone', __('Mobile Phone:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                {{ Form::text('mobile_phone', null, ['class'=>'form-control boxed', 'placeholder'=>'e.g. 0888 123 123']) }}
            </div>
        </div>

        @role('admin')
            {{-- Roles --}}
            <div class="form-group row">
                {{ Form::label('toRoles', __('Modules:'), ['class' => 'col-sm-2 form-control-label']) }}
                <div class="col-sm-10">
                    {{ Form::select('toRoles[]', $roles, $selectedRoles, ['multiple' => true, 'class' => 'form-control boxed']) }}
                </div>
            </div>
        @endrole

        {{-- NOTIFICATIONS --}}
        <div class="form-group row">
            {{ Form::label('notify', __('Notifications:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                <label>
                    {{ Form::checkbox('notify', null, null, ['class' => 'app_checkbox']) }}
                    <span>Send notifications</span>
                </label>
            </div>
        </div>

        {{-- STATUS --}}
        @role('admin')
        <div class="form-group row">
            {{ Form::label('is_active', __('Status:'), ['class' => 'col-sm-2 form-control-label']) }}
            <div class="col-sm-10">
                <label>
                    {{ Form::checkbox('is_active', null, null, ['class' => 'app_checkbox']) }}
                    <span>Active</span>
                </label>
            </div>
        </div>
        @endrole

    </div>

    @if (Request::segment(3) == 'edit')
    <div class="d-flex align-items-start">
        <div class="card w-100 ml-md-4 ml-lg-4 ml-xl-4 filter text-nowrap">
            <div class="form-group row">
                {{ Form::hidden('avatar', null, ['id' => 'thumbnail', 'class' => 'form-control']) }}
                <div class="col-sm-12 pb-3 opa-container">
                    <a id="lfm" data-input="thumbnail" data-preview="holder">
                        <img src="{{ $user->getAvatarThumb() }}" id="holder" class="opa img-fluid rounded-circle img-thumbnail">

                        <div class="opa-middle">
                            <div class="opa-text">Change Image</div>
                        </div>
                    </a>
                </div>
                <a id="reset_avatar" data-id="{{ $user->id }}" class="btn btn-danger ml-auto mr-auto">Delete Image</a>
            </div>
        </div>
    </div>
    @endif
</div>

@include('partials.btn_send')
