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
                <input class="form-control my-2 mr-5" type="search" placeholder="車種名を入力して下さい。" name="search" value="@if (isset($search)) {{ $search }} @endif">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary my-2" type="submit">検索</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-sm-6 offset-sm-3">
            @foreach($bikes as $bike)
                <ul>{{ $bike->name }}</ul>
            @endforeach
        </div>
    </div>
</div>
@endsection