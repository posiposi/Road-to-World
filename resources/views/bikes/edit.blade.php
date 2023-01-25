@extends('layouts.app')

@section('content')
<div class="text-center my-4">
    <h1>{{ Word::PAGE_TITLE['bike_info_change'] }}</h1>
</div>

<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <form action="{{ route('bikes.update', ['id' => $bike->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <i class="fas fa-exclamation-circle"></i>{{ Word::WORD_LIST['required_content'] }}
            </div>

            <div class="mt-3">
                <i class="fas fa-exclamation-circle"></i>
                <label for="brand">{{ $bike_form_label['brand'] }}</label>
                <input type="text" class="form-control" name="brand" value="{{ old('brand', $bike->brand) }}">
            </div>

            <div class="mt-3">
                <i class="fas fa-exclamation-circle"></i>
                <label for="name">{{ $bike_form_label['bike_name'] }}</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $bike->name) }}">
            </div>

            <div class="mt-3">
                <i class="fas fa-exclamation-circle"></i>
                <label for="status">{{ $bike_form_label['bike_status'] }}</label>
            </div>

            @foreach ($bike_status_cases as $bike_status)
            <div class="form-check">
                <input type="radio" class="form-check-input" value="{{ $bike_status->value }}" name="status" @if ($bike->status == $bike_status->value) checked @endif>
                <label class="form-check-label">
                    {{ $bike_status->label_BikeStatus() }}
                </label>
            </div>
            @endforeach

            <div class="mt-3">
                <i class="fas fa-exclamation-circle"></i>
                <label for="bike_address">{{ $bike_form_label['bike_address'] }}</label>
                <input type="text" class="form-control" value="{{ old('bike_address', $bike->bike_address) }}"
                    name="bike_address">
            </div>

            <div class="mt-3">
                <i class="fas fa-exclamation-circle"></i>
                <label for="price">{{ $bike_form_label['price'] }}</label>
                <input type="text" class="form-control" value="{{ old('price', $bike->price) }}" name="price"
                    placeholder="{{ Word::WORD_LIST['not_comma'] }}">
            </div>

            <div class="mt-3">
                <label for="remark">{{ $bike_form_label['remark'] }}</label>
                <textarea class="form-control" name="remark" cols="50" rows="2"
                    placeholder="{{ Word::WORD_LIST['within_150words'] }}"
                    maxlength="150">{{ $bike->remark }}</textarea>
            </div>

            <div class="mt-3">
                <i class="fas fa-exclamation-circle"></i>
                <input type="file" name="image_path">
            </div>
            <input class="d-grid mx-auto mt-2 btn btn-success rounded-pill" type="submit"
                value="{{ $bike_form_label['btn_bike_info_change'] }}">
        </form>
    </div>
</div>
@endsection