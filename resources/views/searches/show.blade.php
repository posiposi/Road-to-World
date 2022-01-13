@extends('layouts.app')

@section('content')
<div class="text-center my-4">
    <h1>検索</h1>
</div>
<div class="container">
    <div class="row my-4">
        <div class="col-sm-6 offset-sm-3">
            <form method='GET' action="{{ route('search.index') }}">
                @csrf
                <input class="form-control my-2 mr-5" type="search" placeholder="車種名を入力して下さい。" name="search_name" value="@if (isset($search_name)) {{ $search_name }} @endif">
                <input class="form-control my-2 mr-5" type="search" placeholder="ブランドを入力して下さい。" name="search_brand" value="@if (isset($search_brand)) {{ $search_brand }} @endif">
                <input class="form-control my-2 mr-5" type="search" placeholder="受け渡し場所を入力して下さい。" name="search_address" value="@if (isset($search_address)) {{ $search_address }} @endif">
                <input class="form-control my-2 mr-5" type="search" placeholder="料金を入力して下さい。" name="search_price" value="@if (isset($search_price)) {{ $search_price }} @endif">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary my-2" type="submit">検索</button>
                </div>
            </form>
        </div>
    </div>
@endsection