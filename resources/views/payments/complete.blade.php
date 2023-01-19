@extends('layouts.app')

@section('content')
    <p class="text-center mt-5">決済が完了しました！</p>
    <div class="container">
        <div class="row">
            <div class="mx-auto">
                <a href="{{ route('bikes.index') }}" class="btn btn-primary d-block"></a>
            </div>
        </div>
    </div>
@endsection