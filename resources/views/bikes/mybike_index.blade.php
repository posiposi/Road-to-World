@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1 class="font-weight-bold">{{ Word::PAGE_TITLE['mybike'] }}</h1>
    </div>
    <div id="app">
        <my-bike v-bind:user_bikes="{{ $user_bikes }}"></my-bike>
    </div>
</div>

@endsection