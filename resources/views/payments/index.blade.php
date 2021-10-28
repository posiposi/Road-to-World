@extends('layouts.app')

@section('content')
    <form action="{{ asset('payment') }}" method="POST" class="text-center mt-5">
        {{ csrf_field() }}
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="1000"
            data-name="Stripe Demo"
            data-label="決済をする"
            data-description="これはStripeのデモです。"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
        </script>
    </form>
@endsection