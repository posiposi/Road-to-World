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
                <input class="form-control mb-3" type="search" placeholder="モデル名を入力して下さい。" name="search_name" value="@if (isset($search_name)) {{ $search_name }} @endif">
                <input class="form-control mb-3" type="search" placeholder="ブランドを入力して下さい。" name="search_brand" value="@if (isset($search_brand)) {{ $search_brand }} @endif">
                <input class="form-control mb-3" type="search" placeholder="受け渡し場所を入力して下さい。" name="search_address" value="@if (isset($search_address)) {{ $search_address }} @endif">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">検索</button>
                </div>
            </form>
            <p class="text-center my-4">※部分検索、複数項目でのand検索になっています。</p>
            <p class="text-center my-4">※全項目未入力の場合は全自転車が表示されます。</p>
        </div>
    </div>
@endsection