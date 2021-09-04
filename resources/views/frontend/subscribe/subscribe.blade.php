@extends('backend.layouts.app')

@section('title', __('Company Management'))

@section('content')

@php
    $subscription = $logged_in_user->subscriptions()->active()->first();
@endphp
<form action="/subscribe" method="POST" id="subscribe-form">
    <div class="form-group">
        <div class="row">
            @foreach ($plans as $plan)
                @if ($plan->active)
                    <div class="col-md-4">
                        <div class="subscription-option">
                            <input type="radio" id="plan-{{$plan->product->name}}" name="plan" value='{{$plan->id}}' {{ $subscription && $plan->id == $subscription->stripe_price ? 'checked' : '' }}>
                            <label for="plan-{{$plan->product->name}}">
                                <span class="plan-price">${{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>
                                <span class="plan-name">{{$plan->product->name}}</span>
                            </label>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Ads</label>
            <select class="form-control" name="ads">
                <option>Marriage Counselor</option>
                <option>Soccer Moms</option>
                <option>Stunt Man</option>
                <option>Tough Guy</option>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label>Are you a dependent</label>
        <input type="checkbox" name="isDependent">
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
@endsection

@push("after-scripts")
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ mix('js/subscribe.js') }}"></script>
@endpush