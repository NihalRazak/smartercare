@inject('model', '\App\Domains\Auth\Models\Company')

@extends('backend.layouts.app')

@section('title', __('Create Company'))

@section('content')
    <x-forms.post :action="route('admin.auth.company.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Company')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.company.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
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
                            <select class="form-control" name="default_provider">
                                <option value="Aetna">Aetna</option>
                                <option value="Blue_Shield">Blue Shield</option>
                                <option value="Cigna">Cigna</option>
                                <option value="Cofinity">Cofinity</option>
                                <option value="Humana">Humana</option>
                                <option value="Mecosta">Mecosta</option>
                                <option value="PHCS">PHCS</option>
                                <option value="United">United</option>
                                <option value="UMPC">UMPC</option>
                            </select>
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Company')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@push("after-scripts")
<script src="{{ mix('js/company.js') }}"></script>
@endpush
