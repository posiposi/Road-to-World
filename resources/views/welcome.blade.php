@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/welcomepage.css') }}">
@endpush

@section('content')

@if(!$isMobile)
<main id="app">
    @include('components.main_carousel')
</main>
@endif

@if($isMobile)
<div class="row">
    <div class="col main-visual"></div>
</div>

<div class="row introduction_texts">
    <div class="col text-center">
        <h3>{{ Message::MAINPAGE_TEXT['main_title'] }}</h3>
        <h4 class="mt-3">{{ Message::MAINPAGE_TEXT['sub_title'] }}</h4>
    </div>
</div>
@endif
@endsection