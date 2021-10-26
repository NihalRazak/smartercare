@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update User'))

@section('content')
    <x-forms.patch :action="route('admin.auth.user.update', $user)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update User')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $user->type }}'}">
                    @if (!$user->isMasterAdmin())
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                            <div class="col-md-10">
                                <select name="type" class="form-control" required x-on:change="userType = $event.target.value">
                                    <option value="{{ $model::TYPE_USER }}" {{ $user->type === $model::TYPE_USER ? 'selected' : '' }}>@lang('User')</option>
                                    <option value="{{ $model::TYPE_COMPANY_ADMIN }}" {{ $user->type === $model::TYPE_COMPANY_ADMIN ? 'selected' : '' }}>@lang('Company Administrator')</option>
                                    <option value="{{ $model::TYPE_ADMIN }}" {{ $user->type === $model::TYPE_ADMIN ? 'selected' : '' }}>@lang('Administrator')</option>
                                </select>
                            </div>
                        </div><!--form-group-->
                    @endif

                    <div class="form-group row">
                        <label for="first_name" class="col-md-2 col-form-label">@lang('First Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="first_name" class="form-control" placeholder="{{ __('First Name') }}" value="{{ old('first_name') ?? $user->first_name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="middle_name" class="col-md-2 col-form-label">@lang('Middle Name')(Optional)</label>

                        <div class="col-md-10">
                            <input type="text" name="middle_name" class="form-control" placeholder="{{ __('Middle Name') }}" value="{{ old('middle_name') ?? $user->middle_name }}" maxlength="100" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="last_name" class="col-md-2 col-form-label">@lang('Last Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="last_name" class="form-control" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') ?? $user->last_name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label">@lang('Address')</label>

                        <div class="col-md-10 row">
                            <div class="form-group col-md-4">
                                <label for="address_number">Number</label>
                                <input type="text" name="address_number" id="address_number" class="form-control" placeholder="{{ __('Street Number') }}" value="{{ isset($user->address) ? $user->address->number : '' }}" maxlength="255" required />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="address_street_name">Street Name</label>
                                <input type="text" name="address_street_name" id="address_street_name" class="form-control" placeholder="{{ __('Street Name') }}" value="{{ isset($user->address) ? $user->address->street_name : '' }}" maxlength="255" required />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="apt_or_unit">Apt or Unit (Optional)</label>
                                <input type="text" name="apt_or_unit" id="apt_or_unit" class="form-control" placeholder="{{ __('Apt or Unit') }}" value="{{ isset($user->address) ? $user->address->apt_or_unit : '' }}" maxlength="255" />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="zip_code">Zip Code</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="{{ __('Zip Code') }}" value="{{ isset($user->address) ? $user->address->zip_code : '' }}" maxlength="255" />
                            </div>
                        
                            <div class="form-group col-md-4">
                                <label for="address_city">City</label>
                                <input type="text" name="address_city" id="address_city" class="form-control" placeholder="{{ __('City') }}" maxlength="255" value="{{ isset($user->address) ? $user->address->city : '' }}" required />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="address_state">State</label>
                                @php
                                    $countries = [
                                        ["value" => "AL", "name" => "Alabama"], 
                                        ["value" => "AK", "name" => "Alaska"], 
                                        ["value" => "AZ", "name" => "Arizona"], 
                                        ["value" => "AR", "name" => "Arkansas"], 
                                        ["value" => "CA", "name" => "California"], 
                                        ["value" => "CO", "name" => "Colorado"], 
                                        ["value" => "CT", "name" => "Connecticut"], 
                                        ["value" => "DE", "name" => "Delaware"], 
                                        ["value" => "FL", "name" => "Florida"], 
                                        ["value" => "GA", "name" => "Georgia"], 
                                        ["value" => "HI", "name" => "Hawaii"], 
                                        ["value" => "ID", "name" => "Idaho"], 
                                        ["value" => "IL", "name" => "Illinois"], 
                                        ["value" => "IN", "name" => "Indiana"], 
                                        ["value" => "IA", "name" => "Iowa"], 
                                        ["value" => "KS", "name" => "Kansas"], 
                                        ["value" => "KY", "name" => "Kentucky"], 
                                        ["value" => "LA", "name" => "Louisiana"], 
                                        ["value" => "ME", "name" => "Maine"], 
                                        ["value" => "MD", "name" => "Maryland"], 
                                        ["value" => "MA", "name" => "Massachusetts"], 
                                        ["value" => "MI", "name" => "Michigan"], 
                                        ["value" => "MN", "name" => "Minnesota"], 
                                        ["value" => "MS", "name" => "Mississippi"], 
                                        ["value" => "MO", "name" => "Missouri"], 
                                        ["value" => "MT", "name" => "Montana"], 
                                        ["value" => "NE", "name" => "Nebraska"], 
                                        ["value" => "NV", "name" => "Nevada"], 
                                        ["value" => "NH", "name" => "New Hampshire"], 
                                        ["value" => "NJ", "name" => "New Jersey"], 
                                        ["value" => "NM", "name" => "New Mexico"], 
                                        ["value" => "NY", "name" => "New York"], 
                                        ["value" => "NC", "name" => "North Carolina"], 
                                        ["value" => "ND", "name" => "North Dakota"], 
                                        ["value" => "OH", "name" => "Ohio"], 
                                        ["value" => "OK", "name" => "Oklahoma"], 
                                        ["value" => "OR", "name" => "Oregon"], 
                                        ["value" => "PA", "name" => "Pennsylvania"], 
                                        ["value" => "RI", "name" => "Rhode Island"], 
                                        ["value" => "SC", "name" => "South Carolina"], 
                                        ["value" => "SD", "name" => "South Dakota"], 
                                        ["value" => "TN", "name" => "Tennessee"], 
                                        ["value" => "TX", "name" => "Texas"], 
                                        ["value" => "UT", "name" => "Utah"], 
                                        ["value" => "VT", "name" => "Vermont"], 
                                        ["value" => "VA", "name" => "Virginia"], 
                                        ["value" => "WA", "name" => "Washington"], 
                                        ["value" => "WV", "name" => "West Virginia"], 
                                        ["value" => "WI", "name" => "Wisconsin"], 
                                        ["value" => "WY", "name" => "Wyoming"]
                                    ];
                                @endphp
                                <select class="form-control" id="address_state" name="address_state">
                                    @for($i = 0; $i < count($countries); $i++)
                                        @php
                                            $country = $countries[$i];
                                        @endphp
                                        <option value="{{ $country['value'] }}" {{ isset($user->address) && $country['value'] == $user->address->state ? "selected" : "" }}>{{ $country['name'] }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('E-mail Address')</label>

                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') ?? $user->email }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                            
                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label">@lang('Mobile Phone')</label>

                        <div class="col-md-10">
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="{{ __('Mobile Phone') }}" value="{{ old('phone') ?? $user->phone }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
        

                    <div class="form-group row">
                        <label for="company" class="col-md-2 col-form-label">@lang('Company')</label>

                        <div class="col-md-10">
                            <select name="company_id" class="form-control" required>
                                <option value="0" {{ $user->company_id == 0 ? 'selected' : '' }}>Guest</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $company->id == $user->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update User')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection

@push("after-scripts")
<script src="{{ mix('js/user.js') }}"></script>
@endpush
