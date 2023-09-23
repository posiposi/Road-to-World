@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('/assets/css/bikes_index.css') }}">
@endpush

@section('content')
<div class="row my-5">
    {{-- 自転車画像 --}}
    @include('bikes.image')
    {{-- 自転車情報表示、予約ページリンクボタン --}}
    @include('bikes.information')
    {{-- コメント欄 --}}
    @include('components.comments.form')
</div>
@endsection