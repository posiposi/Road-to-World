<div class="bd-placeholder-img card-img-top">
    <div class="card-body">
        <ul class="list-group list-unstyled">
            <li class='list-group-item'> {{ Word::BIKE_INDEX_LABEL['owner'] }}{{ $bike['bikeOwner'] }}</li>
            <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['brand'] }}{{ $bike['brand'] }}</li>
            <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['bike_name'] }}{{ $bike['name'] }}</li>
            <li class="list-group-item">
                {{ Word::BIKE_INDEX_LABEL['bike_status'] }}
                {{ BikeStatus::label_BikeStatus(BikeStatus::from($bike['status'])) }}
            </li>
            <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['bike_address'] }}{{ $bike['address'] }} </li>
            <li class="list-group-item"> {{ Word::BIKE_INDEX_LABEL['price_yen'] }}
                {{ number_format($bike['price']) }}{{ Word::BIKE_INDEX_LABEL['per_thirty_minutes'] }}</li>
            <li class="list-group-item card-remark">{{ Word::BIKE_INDEX_LABEL['remark'] }}</br>
                <p class="mt-2">{{ $bike['remark'] }}</p>
            </li>
        </ul>
        {{-- 予約セレクトボックス、ボタン --}}
        {{-- @include('bikes.index_auth') --}}
    </div>
</div>