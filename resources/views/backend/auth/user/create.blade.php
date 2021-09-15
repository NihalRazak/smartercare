@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create User'))

@section('content')
    <x-forms.post :action="route('admin.auth.user.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create User')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $model::TYPE_USER }}'}">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                        <div class="col-md-10">
                            <select name="type" class="form-control" required x-on:change="userType = $event.target.value">
                                <option value="{{ $model::TYPE_USER }}">@lang('User')</option>
                                <option value="{{ $model::TYPE_COMPANY_ADMIN }}">@lang('Company Administrator')</option>
                                <option value="{{ $model::TYPE_ADMIN }}">@lang('Administrator')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="first_name" class="col-md-2 col-form-label">@lang('First Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="first_name" class="form-control" placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="middle_name" class="col-md-2 col-form-label">@lang('Middle Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="middle_name" class="form-control" placeholder="{{ __('Middle Name') }}" value="{{ old('middle_name') }}" maxlength="100" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="last_name" class="col-md-2 col-form-label">@lang('Last Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="last_name" class="form-control" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label">@lang('Address')</label>

                        <div class="col-md-10 row">
                            <div class="form-group col-md-4">
                                <label for="address_number">Number</label>
                                <input type="text" name="address_number" id="address_number" class="form-control" placeholder="{{ __('Street Number') }}" maxlength="255" required />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="address_street_name">Street Name</label>
                                <input type="text" name="address_street_name" id="address_street_name" class="form-control" placeholder="{{ __('Street Name') }}" maxlength="255" required />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="apt_or_unit">Apt or Unit (Optional)</label>
                                <input type="text" name="apt_or_unit" id="apt_or_unit" class="form-control" placeholder="{{ __('Apt or Unit') }}" maxlength="255" />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="zip_code">Zip Code</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="{{ __('Zip Code') }}" maxlength="255" />
                            </div>
                        
                            <div class="form-group col-md-4">
                                <label for="address_city">City</label>
                                <input type="text" name="address_city" id="address_city" class="form-control" placeholder="{{ __('City') }}" maxlength="255" required />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="address_state">State</label>
                                <select class="form-control" id="address_state" name="address_state">
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                </select>
                            </div>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('E-mail Address')</label>

                        <div class="col-md-10">
                            <input type="email" name="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                            
                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label">@lang('Mobile Phone')</label>

                        <div class="col-md-10">
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="{{ __('Mobile Phone') }}" maxlength="100" required autocomplete="phone" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="company" class="col-md-2 col-form-label">@lang('Company')</label>

                        <div class="col-md-10">
                            <select name="company_id" class="form-control" required>
                                <option value="0">Guest</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label">@lang('Password')</label>

                        <div class="col-md-10">
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-2 col-form-label">@lang('Password Confirmation')</label>

                        <div class="col-md-10">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row d-none">
                        <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="active" id="active" class="form-check-input" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->

                    <div class="d-none" x-data="{ emailVerified : false }">
                        <div class="form-group row">
                            <label for="email_verified" class="col-md-2 col-form-label">@lang('E-mail Verified')</label>

                            <div class="col-md-10">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="email_verified"
                                        id="email_verified"
                                        value="1"
                                        class="form-check-input"
                                        x-on:click="emailVerified = !emailVerified"
                                        {{ old('email_verified') ? 'checked' : '' }} />
                                </div><!--form-check-->
                            </div>
                        </div><!--form-group-->

                        <div x-show="!emailVerified">
                            <div class="form-group row">
                                <label for="send_confirmation_email" class="col-md-2 col-form-label">@lang('Send Confirmation E-mail')</label>

                                <div class="col-md-10">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            name="send_confirmation_email"
                                            id="send_confirmation_email"
                                            value="1"
                                            class="form-check-input"
                                            {{ old('send_confirmation_email') ? 'checked' : '' }} />
                                    </div><!--form-check-->
                                </div>
                            </div><!--form-group-->
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create User')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@push("after-scripts")
<script src="{{ mix('js/user.js') }}"></script>
@endpush
