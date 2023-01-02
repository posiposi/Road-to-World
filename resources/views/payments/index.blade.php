@extends('layouts.app')

@section('content')
<form action="{{ route('payment', ['amount' => $amount, 'bikeId' => $bikeId, 'startTime' => $startTime, 'endTime' => $endTime]) }}" method="POST" class="text-center mt-5">
    @csrf
    {{ csrf_field() }}
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="{{ $amount }}"
        data-name="決済情報入力"
        data-label="決済をする"
        data-description="1時間以内の決済をお願いします。"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="JPY">
    </script>
</form>
@endsection