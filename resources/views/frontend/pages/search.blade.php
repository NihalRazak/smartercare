@extends('frontend.layouts.app')

@section('title', __('Search'))

@section('content')
    @include('frontend.includes.nav2')
    
    @php
        $linkURL = $logged_in_user ? "/subscribe/" : "/register/?url=subscribe";
    @endphp
    <div id="app" class="flex-center position-ref full-height">
        <div class="content">
            <div class="container">
                <div class="header text-center">
                    @if (isset($logged_in_user) && isset($logged_in_user->company) && !$logged_in_user->isMasterAdmin())
                        <img class="logo-image" src="{{ $logged_in_user->company->avatar }}" id="{{ $logged_in_user->company->name }}" />
                    @endif
                    <img class="logo-image" id="logo" src="/img/logo.png" />
                    <!-- <p class="header-title"><b>Welcome to 360 Smarter Search</b></p> -->
                    <p class="sub-header-title"><b>The Smarter Way to Choose Your Outpatient Care</b></p>
                </div>
                <div class="content">
                    <div class="row tab justify-content-center" id="alert" style="display: none;">
                        <div class="col-md-6 form-group row align-items-center">
                            <div class="alert-message"></div>
                        </div>
                    </div>
                    <div class="row tab justify-content-center" id="tab-zipCode">
                        <div class="col-md-6 form-group row align-items-center">
                            <div class="col-md-6">
                                <label>Is this Zip Code Correct?</label>
                                <label>If not, enter the correct Zip Code here.</label>
                            </div>
                            <input class="col-md-6 form-control" type="text" id="zipCode" placeholder="12345" />
                        </div>
                    </div>
                    <div class="row tab justify-content-center" id="tab-network" style="display: none;">
                        <div class="col-md-6 form-group row align-items-center">
                            <div class="col-md-6">
                                <label>Is this your Healthcare Network?</label>
                                <label>If not, select the correct Healthcare Network from the drop down menu.</label>
                            </div>
                            <div class="col-md-6">
                                @php
                                    $providers = [
                                        'Aetna' => 'Aetna', 
                                        'Blue_Shield' => 'Blue Cross',
                                        'Cigna' => 'Cigna',
                                        'Cofinity' => 'Cofinity',
                                        'Humana' => 'Humana',
                                        'Mecosta' => 'Mecosta',
                                        'PHCS' => 'PHCS',
                                        'United' => 'United Healthcare',
                                        'UMPC' => 'UMPC'
                                    ];
                                    $company = $logged_in_user->company;
                                @endphp
                                <select class="form-control" id="network" style="display: inline-block; width: calc(100% - 50px);">
                                    @if ($logged_in_user->isMasterAdmin() || (isset($company) && $company->default_provider == 'Any'))
                                        @foreach($providers as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                        <option value="All_Providers">All Providers</option>
                                    @else
                                        @if ($isSubscribed)
                                            @if (isset($company) && $company->default_provider == '')
                                                <option value="All_Providers">All Providers</option>
                                                @foreach($providers as $key => $value)
                                                    <option value="{{ $key }}" {{ isset($company) && $key == $company->default_provider ? "selected" : "" }}>{{ $value }}</option>
                                                @endforeach
                                            @elseif (isset($company) && $company->default_provider != 'All_Providers')
                                                <option value="All_Providers">All Providers</option>
                                                @foreach($providers as $key => $value)
                                                    @if ($company->default_provider == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @else
                                            @if (isset($company) && $company->default_provider != 'All_Providers')
                                                @foreach($providers as $key => $value)
                                                    @if ($company->default_provider == $key)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="All_Providers" selected>All Providers</option>
                                            @endif
                                        @endif
                                    @endif
                                </select>
                                @if (!$isSubscribed || !(isset($company) && $company->default_provider == 'Any'))
                                    <a href="{{$linkURL}}" id="unlock">Unlock</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row tab flex-column" id="tab-careCategory" style="display: none;">
                        <div class="col-md-6 form-group row mx-auto align-items-center">
                            <input type="radio" class="col-md-1" name="category_cpt" id="category" value="category" checked />
                            <div class="col-md-5">
                                <label for="category">Select a Care Category from the drop down menu.</label>
                            </div>
                            <select class="col-md-6" id="careCategory">
                                <option value="Bloodwork">Bloodwork</option>
                                <option value="Imaging Center">Imaging</option>
                                <option value="Surgery Center">Surgery</option>
                                <option value="Urgent Care" selected>Urgent Care</option>
                                <option value="All">All</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group row mx-auto align-items-center">
                            <input type="radio" class="col-md-1" name="category_cpt" id="cpt" value="cpt" />
                            <div class="col-md-5">
                                <label for="cpt">Search for a service provider by CPT Code as prescribed by your
                                    physician.</label>
                            </div>
                            <input class="col-md-6 form-control" type="text" id="CPTCode" disabled />
                        </div>
                    </div>
                    <div class="tab" id="tab-result" style="display: none;">
                    </div>
                </div>
                <div class="footer">
                    <div class="row justify-content-center button-group mb-4">
                        <div class="col-md-8">
                            <div class="float-right">
                                <button class="btn btn-primary" id="prev" style="display: none;">Prev</button>
                                <button class="btn btn-primary" id="next">Next</button>
                                <button class="btn btn-primary" id="search" style="display: none;">Search</button>
                                <button class="btn btn-primary" id="expand" style="display: none;"
                                    title="Get all providers in 2 miles radius.">Expand</button>
                                <button class="btn btn-primary" id="back" style="display: none;">Back</button>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p>
                                As important as it is to be an educated medical care consumer, it is equally important to make
                                your decisions in conjunction with your personal physician. Show them the results of your
                                Smarter Search and confirm there are no comorbidities or conditions that warrant a procedure
                                being done in a hospital setting at multiple times the cost of an outpatient facility. If in
                                your physician's professional opinion, you are best served at a higher-priced facility that is
                                exactly where your procedure should take place.
                            </p>
                            <p>
                                For all other outpatient care needs, use <a href="/search/">Smarter Search</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--content-->
    </div><!--app-->
@endsection

@push("after-scripts")
<script src="{{ mix('js/search.js') }}"></script>
@endpush


<!-- 
https://vimeo.com/562223440 -->