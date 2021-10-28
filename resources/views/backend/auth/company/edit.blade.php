@inject('model', '\App\Domains\Auth\Models\Company')

@extends('backend.layouts.app')

@section('title', __('Update Company'))

@section('content')
    <x-forms.patch :action="route('admin.auth.company.update', $company)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Company')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.company.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $company->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="avatar" class="col-md-2 col-form-label">@lang('Logo')</label>

                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="avatar" data-show-preview="false">
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="default_provider" class="col-md-2 col-form-label">@lang('Network Provider')</label>

                        <div class="col-md-10">
                            @php
                                $providers = [
                                    'All Providers' => 'All Providers',
                                    'Aetna' => 'Aetna', 
                                    'Blue Shield' => 'Blue Shield',
                                    'Cigna' => 'Cigna',
                                    'Cofinity' => 'Cofinity',
                                    'Humana' => 'Humana',
                                    'Mecosta' => 'Mecosta',
                                    'PHCS' => 'PHCS',
                                    'United' => 'United',
                                    'UMPC' => 'UMPC'
                                ];
                            @endphp
                            <select class="form-control" name="default_provider" id="default_provider">
                                @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $company->default_provider ? "selected" : "" }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Company')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection

@push("after-scripts")
<script src="{{ mix('js/company.js') }}"></script>
@endpush