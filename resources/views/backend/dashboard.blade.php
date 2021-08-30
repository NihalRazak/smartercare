@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            <div class="container">
                <div class="content">
                    @if ($logged_in_user->isMasterAdmin())
                    <div class="mt-4">
                        <h4>Visitors</h4>
                        <canvas id="visitor_chart" height="20vh" width="70vw"></canvas>
                        <span id="visitor_percentage"></span>
                    </div>
                    @endif
                    <div class="mt-5">
                        <h4>Searches by Network or All Providers</h4>
                        <canvas id="search_chart" height="20vh" width="70vw"></canvas>
                        <span id="search_percentage"></span>
                    </div>
                    <div class="mt-5">
                        <h4>Throughs to directions or phone number</h4>
                        <canvas id="through_chart" height="20vh" width="70vw"></canvas>
                        <span id="through_percentage"></span>
                    </div>
                    <div class="mt-5 mb-4">
                        <h4>Searches by care category or CPT Code</h4>
                        <canvas id="method_chart" height="20vh" width="70vw"></canvas>
                        <span id="method_percentage"></span>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-backend.card>
@endsection

@push("after-scripts")
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endpush