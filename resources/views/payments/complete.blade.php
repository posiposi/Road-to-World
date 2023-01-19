@extends('layouts.app')

@section('content')
    <p class="text-center mt-5">{{ Word::PAYMENT_LABEL['payment_completed'] }}</p>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 mx-auto">
                <a href="{{ route('bikes.index') }}" class="btn btn-primary d-block">{{ Word::PAYMENT_LABEL['back_to_bikes_index'] }}</a>
            </div>
        </div>
    </div>
@endsection