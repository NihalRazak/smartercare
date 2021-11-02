@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Register')
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.register')">
                            <input type="hidden" name="callback_url" value="{{ isset($_GET['url']) ? $_GET['url'] : '' }}" />
                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">@lang('First Name')</label>

                                <div class="col-md-6">
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="{{ __('First Name') }}" maxlength="100" required autofocus autocomplete="first_name" />
                                </div>
                            </div><!--form-group-->
                            
                            <div class="form-group row">
                                <label for="middle_name" class="col-md-4 col-form-label text-md-right">@lang('Middle Name')(Optional)</label>

                                <div class="col-md-6">
                                    <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name') }}" placeholder="{{ __('Middle Name') }}" maxlength="100" autocomplete="middle_name" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">@lang('Last Name')</label>

                                <div class="col-md-6">
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="{{ __('Last Name') }}" maxlength="100" required autocomplete="last_name" />
                                </div>
                            </div><!--form-group-->

                            <hr/>
                            <div class="form-group">
                                <div class="form-group row">
                                    <label for="address_number" class="col-md-4 col-form-label text-md-right">Number</label>
                                    
                                    <div class="col-md-6">
                                        <input type="text" name="address_number" id="address_number" class="form-control" placeholder="{{ __('Street Number') }}" maxlength="255" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address_street_name" class="col-md-4 col-form-label text-md-right">Street Name</label>
                                    
                                    <div class="col-md-6">
                                        <input type="text" name="address_street_name" id="address_street_name" class="form-control" placeholder="{{ __('Street Name') }}" maxlength="255" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="apt_or_unit" class="col-md-4 col-form-label text-md-right">Apt or Unit (Optional)</label>
                                    
                                    <div class="col-md-6">
                                        <input type="text" name="apt_or_unit" id="apt_or_unit" class="form-control" placeholder="{{ __('Apt or Unit') }}" maxlength="255" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="zip_code" class="col-md-4 col-form-label text-md-right">Zip Code</label>
                                    
                                    <div class="col-md-6">
                                        <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="{{ __('Zip Code') }}" maxlength="255" />
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="address_city" class="col-md-4 col-form-label text-md-right">City</label>
                                    
                                    <div class="col-md-6">
                                        <input type="text" name="address_city" id="address_city" class="form-control" placeholder="{{ __('City') }}" maxlength="255" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address_state" class="col-md-4 col-form-label text-md-right">State</label>
                                    
                                    <div class="col-md-6">
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
                            </div>
                            <hr/>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-mail Address')</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autocomplete="email" />
                                </div>
                            </div><!--form-group-->
                            
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('Mobile Phone')</label>

                                <div class="col-md-6">
                                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="{{ __('Mobile Phone') }}" maxlength="100" required autocomplete="phone" />
                                </div>
                            </div><!--form-group-->
                            
                            <div class="form-group row d-none">
                                <label for="company" class="col-md-4 col-form-label text-md-right">@lang('Company')</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="company_id" id="company">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    @lang('Password')
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="The password must be at least 16 characters."></i>
                                </label>
                                
                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password"
                                        passwordrules="minlength: 16; required: upper; required: lower; required: digit; required: special" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">@lang('Password Confirmation')</label>

                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                                </div>
                            </div><!--form-group-->

                            @if(config('boilerplate.access.captcha.registration'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        <input type="hidden" name="captcha_status" value="true" />
                                    </div><!--col-->
                                </div><!--row-->
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Register')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
