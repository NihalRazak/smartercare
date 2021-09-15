@extends('frontend.layouts.app')

@section('title', __('Subscribe'))

@section('content')

@include('frontend.includes.nav2')
@php
    $subscription = $logged_in_user->subscriptions()->active()->first();
@endphp
    <div class="container mt-4">
        <form action="/subscribe" method="POST" id="subscribe-form">
            <div class="form-group">
                <div class="row">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($plans as $plan)
                        @if ($plan->active)
                            <div class="col-md-3">
                                <div class="subscription-option">
                                    <input type="radio" id="plan-{{$plan->product->name}}" name="plan" value='{{$plan->id}}' {{ $subscription && $plan->id == $subscription->stripe_price ? 'checked' : '' }}>
                                    <label for="plan-{{$plan->product->name}}">
                                        <span class="plan-price">$<span class="plan-price-number">{{$plan->product->description}}</span><small> /{{$plan->interval}}</small></span>
                                        <span class="plan-name">{{$plan->product->name}}</span>
                                    </label>
                                </div>
                            </div>
                            @if ($i == 0)
                            <p class="col-md-2 mb-0" style="font-size: 17px; font-weight: bold; color: #02026d; line-height: 1.2;">Upgrade to</p>
                            @endif
                            @php
                                $i = 1;
                            @endphp
                        @endif
                    @endforeach
                    <div class="form-group col-md-4">
                        <a href="#" id="add_dependent">+ Add a dependent</a><span style="color: #02026d;"> to 360 Smarter Care</span>
                    </div>
                </div>
            </div>
            <p class="notify-msg alert-danger p-2" style="display: none;">Please fill all fields.</p>
            <div class="row new-dependent" style="display: none;">
                <div class="form-group col-md-4">
                    <label for="name">First Name</label>
                    <input class="form-control" id="first_name" type="text">
                </div>
                <div class="form-group col-md-4">
                    <label for="name">Middle Name</label>
                    <input class="form-control" id="middle_name" type="text">
                </div>
                <div class="form-group col-md-4">
                    <label for="name">Last Name</label>
                    <input class="form-control" id="last_name" type="text">
                </div>
                <div class="form-group col-md-3">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="email">
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">Mobile Phone</label>
                    <input class="form-control" id="phone" type="tel">
                </div>
                <div class="form-group col-md-3">
                    <label for="age">Age</label>
                    <input class="form-control" id="age" type="number" min="18" max="150">
                </div>
                <div class="form-group col-md-3">
                    <label for="sex">Sex</label>
                    <select class="form-control" id="sex">
                        <option value="Female">Female</option>
                        <option value="Female in Transition to Male">Female in Transition to Male</option>
                        <option value="Male">Male</option>
                        <option value="Male in Transition to Female">Male in Transition to Female</option>
                    </select>
                </div>
                <div class="form-group col text-right">
                    <button type="button" class="btn btn-sm btn-primary" id="btn-save">Save</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="btn-cancel">Cancel</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-striped" id="table-dependent">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile Phone</th>
                            <th scope="col">Age</th>
                            <th scope="col">Sex</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            
            <div class="form-group">
                <label for="card-holder-name">Card Holder Name</label>
                <input class="form-control" id="card-holder-name" type="text">
            </div>
            @csrf
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element" class="form-control">
                </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="stripe-errors"></div>
            <div class="form-group text-center">
                <button type="button" id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block">SUBMIT</button>
            </div>
        </form>
    </div>
@endsection

@push("after-scripts")
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ mix('js/subscribe.js') }}"></script>
@endpush