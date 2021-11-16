@extends('layouts.app')

@section('content')
    <div class="row text-warning">
        <h1>貸し出し可能自転車一覧</h1>
    </div>
    <div class="container">
        @if (count($bikes) > 0)
            <div class="border border-dark card mt-3 mb-3" style="max-width: 1080px">
                <div class="row no-gutters ml-3">
                    @foreach ($bikes as $bike)
                        <div class="col-md-6 mt-3 mb-3">
                            <img class="card-img img-fluid" src="{{ $bike->image_path }}" alt="自転車画像">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <ul class="list-group list-unstyled border border-dark">
                                    <li class='list-group-item'> 所有者：{{ $bike->user->name }}</li>
                                    <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                    <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                    <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                                    <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                                    <li class="list-group-item"> 料金：¥{{ number_format($bike->price) }}/30分 </li>
                                    <li class="list-group-item"> 説明・備考：{{ $bike->remark }} </li>
                                </ul>
                                <ul class="list-group list-unstyled border border-dark mt-3">
                                    {!! Form::open(['route' => ['bikes.reservation', $bike->id]]) !!}
                                        <li class="list-group-item">開始時間　<input type="date" name="start_date">
                                        <select name="start_time">
                                            @foreach($time as $times)
                                                <option value ="time">{{ $times }}</option>
                                            @endforeach
                                        </select>
                                        </li>
                                        <li class="list-group-item">終了時間　<input type="date" name="end_date">
                                        <select name="end_time">
                                            @foreach($time as $times)
                                                <option value ="time">{{ $times }}</option>
                                            @endforeach
                                        </select>
                                        </li>
                                        {!! Form::submit('予約', ['class' => 'btn btn-success btn-block']) !!}
                                    {!! Form::close() !!}
                                </ul>
                                <ul class="list-group list-unstyled mt-3">
                                    {!! link_to_route('comments.index', 'コメントルーム一覧へ', ['bikeId' => $bike->id, 'senderId' => $users->id,], ['class' => 'btn btn-success']) !!}
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <h4>現在貸し出し可能な自転車はありません。</h4>
        @endif
    </div>
@endsection