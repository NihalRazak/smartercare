@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View User')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.auth.company.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-hover">
                <tr>
                    <th>@lang('Avatar')</th>
                    <td><img src="{{ $company->avatar }}" class="company-profile-image" /></td>
                </tr>

                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $company->name }}</td>
                </tr>

                <tr>
                    <th>@lang('Status')</th>
                    <td>@include('backend.auth.company.includes.status', ['company' => $company])</td>
                </tr>
            </table>
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Account Created'):</strong> @displayDate($company->created_at) ({{ $company->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($company->updated_at) ({{ $company->updated_at->diffForHumans() }})
            </small>
        </x-slot>
    </x-backend.card>
@endsection
