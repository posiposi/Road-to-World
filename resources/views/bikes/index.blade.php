@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-primary">
            <h1>貸し出し可能自転車一覧</h1>
        </div>
        <div class="card mt-3 mb-3" style="max-width: 1080px">
            <div class="row no-gutters">
                @foreach ($bikes as $bike)
                    <div class="col-md-6 my-auto">
                        <img class="card-img" src="{{ $bike->image_path }}" alt="自転車画像">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h4 class="card-title"> {{ $bike->brand }} <h4>
                            <h4 class="card-text"> {{ $bike->name }} </h4>
                            <h4 class="card-text"> {{ $bike->status }} </h4>
                            <h4 class="card-text"> {{ $bike->bike_address }} </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection