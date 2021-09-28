@extends('layouts.app')

@section('content')
   
    <div class="row text-primary">
        <h1>貸し出し可能自転車一覧</h1>
    </div>
    <div class="container">
        @if (count($bikes) > 0)
            <div class="card mt-3 mb-3" style="max-width: 1080px">
                <div class="row no-gutters">
                    @foreach ($bikes as $bike)
                        <div class="col-md-6 mt-3 mb-3 my-auto">
                            <img class="card-img img-fluid" src="{{ $bike->image_path }}" alt="自転車画像">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <ul class="list-group list-unstyled">
                                    <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                    <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                    <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                                    <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
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