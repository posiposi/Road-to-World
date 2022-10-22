@extends('layouts.app')

@section('content')
    <div id="app" class="mt-5">
        <full-calendar-component></full-calendar-component>
    </div>

    <script src="{{mix('js/app.js')}}"></script>
@endsection