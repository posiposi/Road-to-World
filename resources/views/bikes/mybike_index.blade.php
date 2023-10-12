@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="font-weight-bold">{{ Word::PAGE_TITLE['mybike'] }}</h1>
    </div>
    <div class="row">
        @foreach ($bikeList->items() as $bike)
        <div class="card col-sm-4">
            <img src="{{ $bike['image_path'] }}" class="card-img-top" alt="Fissure in Sandstone" />
            <div class="card-body">
                <h4 class="card-title">{{ $bike['brand'] }} / {{ $bike['name'] }}</h4>
                <p class="card-text">受け渡し場所：{{ $bike['bike_address'] }}</p>
                <p class="card-text">金額：¥{{ $bike['price'] }} / 30分</p>
                <p class="card-text">状態：{{ BikeStatus::label_BikeStatus(BikeStatus::from($bike['status'])) }}</p>
                <p class="card-text">備考：{{ $bike['remark'] }}</p>
                <a href="{{ route('bikes.edit', ['bikeId' => $bike['id']]) }}" class="btn btn-primary">編集</a>
                <a href="{{ route('bikes.delete', ['bikeId' => $bike['id']]) }}" class="btn btn-danger">削除</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection