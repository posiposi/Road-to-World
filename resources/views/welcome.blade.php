@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/welcomepage.css') }}">
@endpush

@section('content')
    {{-- メインコンテンツ --}}
    <main id="app">
        <main-page-visual welcome_logo_path="{{ $welcome_logo_path }}"></main-page-visual>
    </main>
@endsection