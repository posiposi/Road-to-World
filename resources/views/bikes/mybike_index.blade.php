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
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
                <a href="{{ route('bikes.delete', ['bikeId' => $bike['id']]) }}" class="btn btn-primary">削除</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
