@extends('layouts.app')

@section('content')
    {{--<p>仮予約が完了しました。決済完了後に予約が確定しますので、1時間以内の決済をお願い致します。</p>--}}
    <form action="{{ asset('payment') }}" method="POST" class="text-center mt-5">
        @csrf
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