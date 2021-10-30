@extends('layouts.app')

@section('content')
    <p class="text-center mt-5">決済が完了しました！</p>
    <div class="container">
        <div class="row">
            <div class="mx-auto">
                {!! link_to_route('bikes.index', '貸出中バイク一覧へ戻る', [], ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
@endsection