@extends('layouts.app')

@section('content')
<div class="text-center my-4">
    <h1>{{ Word::PAGE_TITLE['bike_register'] }}</h1>
</div>

<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <form action="{{ route('bikes.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="brand">{{ $bike_form_label['brand'] }}</label>
                <input class="form-control" type="text" name="brand" value="">
            </div>

            <div class="mt-3">
                <label for="name">{{ $bike_form_label['bike_name'] }}</label>
                <input class="form-control" type="text" name="name" value="">
            </div>

            <div class="mt-3">
                <label for="status">{{ $bike_form_label['bike_status'] }}</label>
            </div>
            
            @foreach ($bike_status_cases as $bike_status)
                <div class="form-check">
                    <input type="radio" class="form-check-input" value="{{ $bike_status->value }}" name="status">
                    <label class="form-check-label">
                        {{ $bike_status->label_BikeStatus() }}
                    </label>
                </div>
            @endforeach

            <div class="mt-3">
                <label for="bike_address">{{ $bike_form_label['bike_address'] }}</label>
                <input class="form-control" type="text" name="bike_address" value="">
            </div>

            <div class="mt-3">
                <label for="price">{{ $bike_form_label['price'] }}</label>
                <input class="form-control" type="text" name="price" value="" placeholder="{{ Word::WORD_LIST['not_comma'] }}">
            </div>

            <div class="mt-3">
                <label for="remark">{{ $bike_form_label['remark'] }}</label>
                <textarea class="form-control" name="remark" cols="50" rows="2" placeholder="{{ Word::WORD_LIST['within_150words'] }}"
                    maxlength="150"></textarea>
            </div>

            <div class="mt-3">
                <input type="file" name="image_path">
            </div>
            <input class="d-grid mx-auto mt-2 btn btn-success rounded-pill" type="submit" value="{{ $bike_form_label['btn_bike_info_register'] }}">
        </form>
    </div>
</div>
@endsection