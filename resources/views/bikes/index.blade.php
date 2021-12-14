@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/picture.css') }}">
@endpush

@section('content')
    <div class="row text-warning">
        <h1>貸し出し可能自転車一覧</h1>
    </div>
    <div class="container">
        @if (count($bikes) > 0)
        <div class="row">
            <div class="card-group">
                @foreach ($bikes as $bike)
                <div class="col-sm-4">
                    <div class="card mb-3">
                        <div class="bd-placeholder-img card-img-top">
                            <img class="card-img img-fluid" src="{{ $bike->image_path }}" alt="自転車画像">
                            <div class="card-body shadow-sm">
                                <ul class="list-group list-unstyled">
                                    <li class='list-group-item'> 所有者：{{ $bike->user->name }}</li>
                                    <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                    <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                    <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                                    <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                                    <li class="list-group-item"> 料金：¥{{ number_format($bike->price) }}/30分 </li>
                                    <li class="list-group-item"> 説明・備考：{{ $bike->remark }} </li>
                                </ul>
                                <ul class="list-group list-unstyled mt-3">
                                    {!! Form::open(['route' => ['bikes.reservation', $bike->id]]) !!}
                                        <li class="list-group-item">開始日　<input type="date" name="start_date"><br>
                                        開始時間
                                        <select name="start_time">
                                            @foreach($times as $time)
                                                <option value ="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                        </li>
                                        <li class="list-group-item">終了日　<input type="date" name="end_date"><br>
                                        終了時間
                                        <select name="end_time">
                                            @foreach($times as $time)
                                                <option value ="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                        </li>
                                        {!! Form::submit('予約', ['class' => 'btn btn-success btn-block']) !!}
                                    {!! Form::close() !!}
                                </ul>
                                <ul class="list-group list-unstyled mt-3">
                                    {{-- ログインユーザがバイク所有者の場合 --}}
                                    @if($users->id == $bike->user_id)
                                        {!! link_to_route('comments.index', 'コメントルーム一覧へ', ['bikeId' => $bike->id, 'senderId' => $users->id,], ['class' => 'btn btn-success']) !!}
                                    {{-- ログインユーザが借り手側の場合 --}}
                                    @else
                                        {!! link_to_route('comments.show', 'コメントルームへ', ['bikeId' => $bike->id, 'senderId' => $users->id,], ['class' => 'btn btn-success']) !!}
                                    @endif
                                </ul>
                                <ul class="list-group list-unstyled mt-3">
                                    {!! link_to_route('bikes.calendar', '予約状況カレンダー', ['bikeId' => $bike->id, 'week' => 'this_week', 'now' => 'today'], ['class' => 'btn btn-success']) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{ $bikes->links() }}
        @else
            <h4>現在貸し出し可能な自転車はありません。</h4>
        @endif
    </div>
@endsection