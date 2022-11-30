@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/picture.css') }}">
@endpush

@section('content')
    <div class="text-center my-4">
        <h1>検索</h1>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-sm-6 offset-sm-3">
                <form method='GET' action="{{ route('search.index') }}">
                    @csrf
                    <input class="form-control" type="search" placeholder="モデル名を入力して下さい。" name="search_name" value="@if (isset($search_name)) {{ $search_name }} @endif">
                    <input class="form-control" type="search" placeholder="ブランドを入力して下さい。" name="search_brand" value="@if (isset($search_brand)) {{ $search_brand }} @endif">
                    <input class="form-control" type="search" placeholder="受け渡し場所を入力して下さい。" name="search_address" value="@if (isset($search_address)) {{ $search_address }} @endif">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary my-2" type="submit">検索</button>
                    </div>
                </form>
                <p class="text-center my-4">※部分検索、複数項目でのand検索になっています。</p>
                <p class="text-center my-4">※全項目未入力の場合は全自転車が表示されます。</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="card-group">
                @foreach($bikes as $bike)
                    @if(count($bikes) == 1)
                        <div class="col-md-12">
                    @elseif(count($bikes) == 2)
                        <div class="col-md-6">
                    @else
                        <div class="col-md-4">
                    @endif
                            <div class="card mb-3">
                                <div class="bd-placeholder-img card-img-top">
                                    <img class="card-img img-fluid" src="{{ $bike->image_path }}" alt="自転車画像">
                                    <div class="card-body shadow-sm">
                                        <ul class="list-group list-unstyled">
                                            <li class='list-group-item'> 所有者：{{ $bike->user->nickname }}</li>
                                            <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                            <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                            <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                                            <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                                            <li class="list-group-item"> 料金：¥{{ number_format($bike->price) }}/30分 </li>
                                            <li class="list-group-item"> 説明・備考：{{ $bike->remark }} </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection