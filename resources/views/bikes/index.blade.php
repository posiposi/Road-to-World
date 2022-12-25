@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/bikes_index.css') }}">
@endpush

@section('content')
<div class="row text-dark ms-4">
    <h1 class="font-weight-bold">{{ Word::PAGE_TITLE['bike_index'] }}</h1>
</div>
<div class="container">
    @if (count($bikes) > 0)
    <div class="row">
        <div class="card-group">
            @foreach ($bikes as $bike)
                @if(count($bikes) == 1)
                    <div class="col-md-12">
                @elseif(count($bikes) == 2)
                    <div class="col-md-6">
                @else
                    <div class="col-md-4">
                @endif
                    <div class="card mb-3 border border-0">
                        <div class="bd-placeholder-img card-img-top">
                            <img class="card-img img-fluid mt-4" src="{{ $bike->image_path }}" alt="自転車画像">
                            <div class="card-body">
                                <ul class="list-group list-unstyled">
                                    <li class='list-group-item'> 所有者：{{ $bike->user->nickname }}</li>
                                    <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                    <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                    <li class="list-group-item"> 保管状態：{{ $bike->getBikeStatusLogicalName($bike->status) }} </li>
                                    <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                                    <li class="list-group-item"> 料金：¥{{ number_format($bike->price) }}/30分 </li>
                                    <li class="list-group-item card-remark"> 説明・備考</br>
                                        <p class="mt-2">{{ $bike->remark }}</p>
                                    </li>
                                </ul>
                                @auth
                                    {{-- 予約リクエストフォーム --}}
                                    <ul class="list-group list-unstyled mt-3">
                                        {{ Form::open(['route' => ['bikes.reservation', $bike->id]]) }}
                                            <li class="list-group-item">開始日<input type="date" name="start_date"><br>
                                            開始時間
                                            <select name="start_time">
                                                @foreach($times as $time)
                                                    <option value ="{{ $time }}">{{ $time }}</option>
                                                @endforeach
                                            </select>
                                            </li>
                                            <li class="list-group-item">終了日<input type="date" name="end_date"><br>
                                            終了時間
                                            <select name="end_time">
                                                @foreach($times as $time)
                                                    <option value ="{{ $time }}">{{ $time }}</option>
                                                @endforeach
                                            </select>
                                            </li>
                                            {{ Form::submit('予約', ['class' => 'btn btn-primary rounded-pill d-block mt-2 mx-auto']) }}
                                        {{ Form::close() }}
                                    </ul>
                                    <ul class="list-group list-unstyled mt-3">
                                        {{-- ログインユーザがバイク所有者の場合 --}}
                                        @if($user->id == $bike->user_id)
                                            {{ link_to_route('comments.index', 'コメントルーム一覧へ', ['bikeId' => $bike->id, 'lenderId' => $user->id,], ['class' => 'btn btn-success']) }}
                                        {{-- ログインユーザが借り手側の場合 --}}
                                        @else
                                            {{ link_to_route('comments.show', 'コメントルームへ', ['bikeId' => $bike->id, 'senderId' => $user->id, 'receiverId' => $bike->user_id], ['class' => 'btn btn-success']) }}
                                        @endif
                                    </ul>
                                    <ul class="list-group list-unstyled mt-3">
                                        {{ link_to_route('bikes.calendar', '予約状況カレンダー', ['bikeId' => $bike->id, 'week' => 'this_week', 'now' => 'today'], ['class' => 'btn btn-success']) }}
                                    </ul>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $bikes->links() }}
    @else
        <h4 class="font-weight-bold">現在貸し出し可能な自転車はありません。</h4>
    @endif
</div>
@endsection