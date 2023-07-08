@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('/assets/css/bikes_index.css') }}">
@endpush

@section('content')
<div class="row text-dark ms-4">
    <h1 class="font-weight-bold">{{ Word::PAGE_TITLE['bike_index'] }}</h1>
</div>
<div class="container">
    @if (count($all_bikes) > 0)
    <div class="row">
        <div class="card-group">
            @foreach ($all_bikes as $bike)
            <div class="col-md-4">
                <div class="card mb-3 border border-0">
                    <div class="bd-placeholder-img card-img-top">
                        <img class="card-img img-fluid mt-4" src="{{ $bike->image_path }}" alt="自転車画像">
                        <div class="card-body">
                            <ul class="list-group list-unstyled">
                                <li class='list-group-item'> {{ Word::BIKE_INDEX_LABEL['owner'] }}{{
                                    $bike->user->nickname }}</li>
                                <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['brand'] }}{{ $bike->brand }}
                                <li>
                                <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['bike_name'] }}{{ $bike->name }}
                                </li>
                                <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['bike_status'] }}{{
                                    $bike->getBikeStatusLogicalName($bike->status) }} </li>
                                <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['bike_address'] }}{{
                                    $bike->bike_address }} </li>
                                <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['price_yen'] }}{{
                                    number_format($bike->price) }}{{ Word::BIKE_INDEX_LABEL['per_thirty_minutes'] }}
                                </li>
                                <li class="list-group-item card-remark">{{ Word::BIKE_INDEX_LABEL['remark'] }}</br>
                                    <p class="mt-2">{{ $bike->remark }}</p>
                                </li>
                            </ul>
                            @auth
                            {{-- 予約リクエストフォーム --}}
                            <ul class="list-group list-unstyled mt-3">
                                <form class="reservation-form"
                                    action="{{ route('bikes.reservation', ['bikeId' => $bike->id]) }}" method="post">
                                    @csrf
                                    <li class="list-group-item">{{ Word::BIKE_INDEX_LABEL['start_date'] }}<input
                                            type="date" name="start_date"><br>
                                        {{ Word::BIKE_INDEX_LABEL['start_time'] }}
                                        <select name="start_time">
                                            @foreach($times as $time)
                                            <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li class="list-group-item">{{ Word::BIKE_INDEX_LABEL['end_date'] }}<input
                                            type="date" name="end_date"><br>
                                        {{ Word::BIKE_INDEX_LABEL['end_time'] }}
                                        <select name="end_time">
                                            @foreach($times as $time)
                                            <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <button type="submit" id="reservation-btn"
                                        class="btn btn-primary rounded-pill d-block mt-2 mx-auto">
                                        予約
                                    </button>
                                </form>
                            </ul>
                            <ul class="list-group list-unstyled mt-3">
                                {{-- ログインユーザがバイク所有者の場合 --}}
                                @if($user->id == $bike->user_id)
                                <a href="{{ route('comments.index', [
                                        'bikeId' => $bike->id,
                                        'lenderId' => $user->id
                                    ]) }}" class="btn btn-success">コメントルーム一覧へ</a>
                                @else
                                <a href="{{ route('comments.show', [
                                        'bikeId' => $bike->id,
                                        'senderId' => $user->id,
                                        'receiverId' => $bike->user_id
                                    ]) }}" class="btn btn-success">コメントルームへ</a>
                                @endif
                            </ul>
                            <ul class="list-group list-unstyled mt-3">
                                <a href="{{ route('bikes.calendar', [
                                        'bikeId' => $bike->id,
                                        'week' => 'this_week',
                                        'now' => 'today'
                                    ]) }}" class="btn btn-success">予約状況カレンダー</a>
                            </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">{{ $all_bikes->links() }}</div>
    </div>
    @else
    <h4 class="font-weight-bold">{{ Message::NOT_AVAILABLE_RENTAL_BIKE_MESSAGE }}</h4>
    @endif
</div>
@endsection