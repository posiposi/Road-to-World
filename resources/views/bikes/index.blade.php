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
                            @include('bikes.index_auth')
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