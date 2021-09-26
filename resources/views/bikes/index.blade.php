@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-3 mb-3" style="max-width: 1080px">
            <div class="row no-gutters">
                <div class="col-md-6 my-auto">
                    @foreach ($bikes as $bike)
                        <img class="card-img" src="{{ $bike->image_path }}" alt="自転車画像">
                    @endforeach
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">カード右側テストテキスト</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection