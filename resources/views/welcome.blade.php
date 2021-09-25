@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Ride</h1>
                {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                {!! link_to_route('bikes.index', '貸出中バイク一覧', [], ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>未ログインテスト</h1>
            </div>
    @endif
@endsection