@extends('backend.layouts.app')

@section('title', __('User Management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

    <x-forms.post :action="route('admin.auth.user.import')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Import Users')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link
                    class="card-header-action"
                    icon="c-icon cil-cloud-download"
                    :href="route('admin.auth.user.download_template')"
                    :text="__('Download Template')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-row">
                    <div class="col-md-9 file-input-group">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="census" data-show-preview="false">
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Submit')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
    
    <x-backend.card>
        <x-slot name="header">
            @lang('User Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.user.create')"
                    :text="__('Create User')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.users-table />
        </x-slot>
    </x-backend.card>
@endsection

@push("after-scripts")
<script src="{{ mix('js/user.js') }}"></script>
@endpush