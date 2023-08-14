@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('/assets/css/comments_show.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <h1 class="mt-3">{{ $bike->name }} の予約コメントページ</h1>
    </div>
    <div class="mt-3 mb-3" style="max-width: 1080px">
        <div class="row g-0 ms-3">
            <div class="col-md-6 mt-3 mb-3">
                <img class="card-img img-fluid" src="{{ $bike->image_path }}" alt="自転車画像">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <ul class="list-group list-unstyled">
                        <li class='list-group-item'> 所有者：{{ $bike->user->nickname }}</li>
                        <li class="list-group-item"> ブランド：{{ $bike->brand }}</li>
                        <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                        <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                        <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                        <li class="list-group-item card-remark"> 説明・備考</br>
                            <p class="mt-2">{{ $bike->remark }}</p>
                        </li>
                    </ul>
                    <ul class="list-group list-unstyled mt-3">
                        <form action="{{ route('bikes.reservation', ['bikeId' => $bike->id]) }}" method="post">
                            @csrf
                            <li class="list-group-item">開始日 <input type="date" name="start_date"><br>
                                開始時間
                                <select name="start_time">
                                    @foreach($times as $time)
                                    <option value="{{ $time }}">{{ $time }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="list-group-item">終了日 <input type="date" name="end_date"><br>
                                終了時間
                                <select name="end_time">
                                    @foreach($times as $time)
                                    <option value="{{ $time }}">{{ $time }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <input class="btn btn-success btn-block mt-2" type="submit" value="予約">
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h2>コメント</h2>
            <ul id="list-block">
            </ul>
            <input id="input-message" type="text" class="form-control">
            <button id="btn-message-send" class="btn btn-primary mt-2">送信</button>
        </div>
    </div>
</div>
@vite('resources/ts/sendMessage.ts')
@vite('resources/ts/getMessage.ts')
@endsection