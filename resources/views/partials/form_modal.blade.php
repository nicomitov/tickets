{{-- modal form --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'modal_form']) !!}
                {{-- messgaes --}}
                @if(strpos(url()->current(), 'threads'))
                    <div class="form-group row required">
                        {{ Form::label('subject', __('Subject'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                        {{ Form::text('subject', null, ['class'=>'form-control boxed', 'placeholder' => 'The subject must be at least 3 characters...']) }}
                            <span class="small text-danger" id="subject-error"></span>
                        </div>
                    </div>

                    <div class="form-group row required">
                        {{ Form::label('message', __('Message'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                        {{ Form::textarea('message', null, ['class' => 'form-control boxed', 'placeholder' => 'Type your message here...', 'rows' => 8]) }}
                            <span class="small text-danger" id="message-error"></span>
                        </div>
                    </div>

                    <div class="form-group row required">
                        {{ Form::label('recipients[]', __('Participants'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                        {{ Form::select('recipients[]', \App\User::activeUsers()->where('id', '!=', Auth::id())->pluck('name', 'id'), isset($toUserId) ? $toUserId : null, ['class' => 'bsmultiselect', 'data-width' => '100%', 'data-height' => '200', 'data-text' => 'Select participants', 'data-dropup' => 'false', 'multiple' => true]) }}
                            <span class="small text-danger" id="recipients-error"></span>
                        </div>
                    </div>
{{-- <button type="submit" class="btn btn-dark" role="button">Saveeee</button> --}}
                @else

                    {{-- name --}}
                    <div class="form-group row required">
                        {{ Form::label('name', __('Name:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('name', null, ['class' => 'form-control boxed', 'placeholder' => 'The name must be at least 2 characters...']) }}
                            <span class="small text-danger" id="name-error"></span>
                        </div>
                    </div>

                    @if (Route::currentRouteName() == 'departments.index')
                    {{-- abbr --}}
                    <div class="form-group row required">
                        {{ Form::label('abbr', __('Abbr:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('abbr', null, ['class' => 'form-control boxed', 'placeholder' => 'The abbr must be at least 2 characters...']) }}
                            <span class="small text-danger" id="abbr-error"></span>
                        </div>
                    </div>
                    @endif



                    {{-- HARDWARE --}}
                    {{-- @if(strpos(url()->current(), 'models')) --}}
                    @if (Route::currentRouteName() == 'devices.show' || Route::currentRouteName() == 'devices.models.show' || Route::currentRouteName() == 'devices.models.index')

                    {{-- @if() --}}
                        {{-- device_type_id --}}
                        <div class="form-group row required">
                            {{ Form::label('device_type_id', __('Type:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                 {{ Form::select('device_type_id', $device_types, null, ['class'=>'form-control boxed bsmultiselect', 'data-width' => '100%', 'data-height' => '200', 'data-text' => 'Select device type', 'data-dropup' => 'false', 'data-id' => 'device_type_id']) }}
                                <span class="small text-danger" id="device_type_id-error"></span>
                            </div>
                        </div>

                        {{-- specs --}}
                        <div class="form-group row">
                            {{ Form::label('specifications', __('Specs:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::textarea('specifications', null, ['class' => 'form-control boxed', 'placeholder' => 'Device specifications...', 'rows' => 5]) }}
                                <span class="small text-danger" id="specifications-error"></span>
                            </div>
                        </div>

                        {{-- device_supplier_id --}}
                        <div class="form-group row">
                            {{ Form::label('device_supplier_id', __('Supplier:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                 {{ Form::select('device_supplier_id', $device_suppliers, null, ['class'=>'form-control boxed bsmultiselect', 'data-width' => '100%', 'data-height' => '200', 'data-text' => 'Select device type', 'data-dropup' => 'false', 'data-id' => 'device_supplier_id', 'placeholder' => 'Device supplier']) }}
                                <span class="small text-danger" id="device_supplier_id-error"></span>
                            </div>
                        </div>

                        {{-- device_group_id --}}
                        <div class="form-group row">
                            {{ Form::label('device_group_id', __('Group:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                 {{ Form::select('device_group_id', $device_groups, null, ['class'=>'form-control boxed bsmultiselect', 'data-width' => '100%', 'data-height' => '200', 'data-text' => 'Select device type', 'data-dropup' => 'false', 'data-id' => 'device_group_id', 'placeholder' => 'Device group']) }}
                                <span class="small text-danger" id="device_group_id-error"></span>
                            </div>
                        </div>

                        {{-- DATE_MANUFACTURE --}}
                        <div class="form-group row">
                            {{ Form::label('date_manufacture', __('Manufactured:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::date('date_manufacture', null, ['class' => 'form-control boxed', 'id' => 'date_manufacture']) }}
                                <span class="small text-danger" id="date_manufacture"></span>
                            </div>
                        </div>

                        {{-- DATE_PURCHASE --}}
                        <div class="form-group row">
                            {{ Form::label('date_purchase', __('Purchased:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::date('date_purchase', null, ['class' => 'form-control boxed', 'id' => 'date_purchase']) }}
                                <span class="small text-danger" id="date_purchase"></span>
                            </div>
                        </div>

                        {{-- DATE_WARRANTY --}}
                        <div class="form-group row">
                            {{ Form::label('date_warranty', __('Warranty:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::date('date_warranty', null, ['class' => 'form-control boxed', 'id' => 'date_warranty']) }}
                                <span class="small text-danger" id="date_warranty"></span>
                            </div>
                        </div>
                    @endif

                    @if (Route::currentRouteName() == 'devices.groups.index')
                        {{-- num --}}
                        <div class="form-group row required">
                            {{ Form::label('num', __('Num:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('num', null, ['class' => 'form-control boxed', 'placeholder' => 'Group num...']) }}
                                <span class="small text-danger" id="num-error"></span>
                            </div>
                        </div>
                    @endif

                    @if (Route::currentRouteName() == 'devices.suppliers.index')
                        {{-- eik --}}
                        <div class="form-group row">
                            {{ Form::label('eik', __('ЕИК:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('eik', null, ['class' => 'form-control boxed', 'placeholder' => 'ЕИК']) }}
                                <span class="small text-danger" id="eik-error"></span>
                            </div>
                        </div>

                        {{-- address --}}
                        <div class="form-group row">
                            {{ Form::label('address', __('Address:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::textarea('address', null, ['class' => 'form-control boxed', 'placeholder' => 'Address', 'rows' => 3]) }}
                                <span class="small text-danger" id="address-error"></span>
                            </div>
                        </div>

                        {{-- phone --}}
                        <div class="form-group row">
                            {{ Form::label('phone', __('Phone:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('phone', null, ['class' => 'form-control boxed', 'placeholder' => 'Phone']) }}
                                <span class="small text-danger" id="phone-error"></span>
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="form-group row">
                            {{ Form::label('email', __('Email:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('email', null, ['class' => 'form-control boxed', 'placeholder' => 'Email']) }}
                                <span class="small text-danger" id="email-error"></span>
                            </div>
                        </div>

                        {{-- bank --}}
                        <div class="form-group row">
                            {{ Form::label('bank', __('Bank:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('bank', null, ['class' => 'form-control boxed', 'placeholder' => 'Bank']) }}
                                <span class="small text-danger" id="bank-error"></span>
                            </div>
                        </div>

                        {{-- iban --}}
                        <div class="form-group row">
                            {{ Form::label('iban', __('IBAN:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('iban', null, ['class' => 'form-control boxed', 'placeholder' => 'IBAN']) }}
                                <span class="small text-danger" id="iban-error"></span>
                            </div>
                        </div>

                        {{-- bic --}}
                        <div class="form-group row">
                            {{ Form::label('bic', __('BIC:'), ['class' => 'col-sm-2 form-control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('bic', null, ['class' => 'form-control boxed', 'placeholder' => 'BIC']) }}
                                <span class="small text-danger" id="bic-error"></span>
                            </div>
                        </div>
                    @endif

                    {{-- employees --}}
                    @if(strpos(url()->current(), 'employees') && Route::currentRouteName() != 'tickets.employee')
                    <div class="form-group row required">
                        {{ Form::label('department_id', __('Dept:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                             {{ Form::select('department_id', $departments, null, ['class'=>'form-control boxed bsmultiselect', 'data-width' => '100%', 'data-height' => '200', 'data-text' => 'Select department', 'data-dropup' => 'false', 'data-id' => 'department_id']) }}
                            <span class="small text-danger" id="department_id-error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('email', __('E-Mail:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                             {{ Form::text('email', null, ['class' => 'form-control boxed', 'placeholder' => 'E-Mail']) }}
                            <span class="small text-danger" id="email-error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('work_phone', __('Phone:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                             {{ Form::text('work_phone', null, ['class' => 'form-control boxed', 'placeholder' => 'Phone']) }}
                            <span class="small text-danger" id="work_phone-error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('mobile_phone', __('Mobile:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                             {{ Form::text('mobile_phone', null, ['class' => 'form-control boxed', 'placeholder' => 'Mobile']) }}
                            <span class="small text-danger" id="mobile_phone-error"></span>
                        </div>
                    </div>
                    @endif

                    {{-- checkitems --}}
                    @if(str_is('checkitems.*', Route::currentRouteName()))
                    <div class="form-group row">
                        {{ Form::label('description', __('Description:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('description', null, ['class' => 'form-control boxed', 'placeholder' => 'Short description...']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('time', __('Time:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::select('time', ['СУТРИН'=>'СУТРИН', 'ВЕЧЕР'=>'ВЕЧЕР'], null, ['class'=>'form-control boxed', 'placeholder'=>'СУТРИН/ВЕЧЕР']) }}
                            <span class="small text-danger" id="time-error"></span>
                        </div>
                    </div>

                    <div class="form-group row required">
                        {{ Form::label('item_order', __('Order:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::number('item_order', $item_order, ['class'=>'form-control boxed', 'placeholder'=>'Order']) }}
                            <span class="small text-danger" id="item_order-error"></span>
                        </div>
                    </div>
                    @endif

                    {{-- roles/permissions --}}
{{--                     @if(str_is('roles.*', Route::currentRouteName()) || str_is('permissions.*', Route::currentRouteName()))
                    <div class="form-group row required">
                        {{ Form::label('guard_name', __('Guard:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::select('guard_name', $guards, $selectedGuard, ['class' => 'c-select form-control boxed']) }}
                            <span class="small text-danger" id="guard_name-error"></span>
                        </div>
                    </div>
                    @endif --}}

                    @if(str_is('roles.*', Route::currentRouteName()))
                    <div class="form-group row required">
                        {{ Form::label('display_name', __('Display:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('display_name', null, ['class' => 'form-control boxed', 'placeholder' => 'The name must be at least 2 characters...']) }}
                            <span class="small text-danger" id="display_name-error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('description', __('Description:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('description', null, ['class' => 'form-control boxed', 'placeholder' => 'Short description...']) }}
                        </div>
                    </div>
                    @endif

                    {{-- @if(str_is('permissions.*', Route::currentRouteName()))
                    <div class="form-group row">
                        {{ Form::label('toRoles', __('Assign to Roles:'), ['class' => 'col-sm-2 form-control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::select('toRoles[]', $roles, $selectedRoles, ['multiple' => true, 'class' => 'form-control boxed', 'id' => 'toRoles']) }}
                            <span class="small text-danger" id="toRoles-error"></span>
                        </div>
                    </div>
                    @endif --}}

                    {{-- <button type="submit" class="btn btn-dark" role="button">Saveeee</button> --}}
                @endif
                {!! Form::close() !!}

            </div>
            <div class="modal-footer">

                <span class="loading">
                    <i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </span>

                <button id="modal_submit_btn" type="button" class="btn btn-primary" role="button">Save</button>
            </div>
        </div>
    </div>
</div>
