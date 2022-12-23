@extends('layouts.app')

@section('content')
    <div class="text-center my-4">
        <h1>バイク登録</h1>
    </div>

    <div class="row mb-4">
        <div class="col-sm-6 offset-sm-3">

            {{ Form::open(['route' => 'bikes.store', 'files' => true]) }}
                <div>
                    {{ Form::label('brand', 'ブランド') }}
                    {{ Form::text('brand', null, ['class' => 'form-control']) }}
                </div>

                <div>
                    {{ Form::label('name', 'モデル名') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="良好" name="status">
                    <label class="form-check-label">
                        良好
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" value="普通" name="status">
                    <label class="form-check-label">
                        普通
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" value="悪い" name="status">
                    <label class="form-check-label">
                        悪い
                    </label>
                </div>

                <div>
                    {{ Form::label('bike_address', '受け渡し場所') }}
                    {{ Form::text('bike_address', null, ['class' => 'form-control']) }}
                </div>
                
                <div>
                    {{ Form::label('price', '料金(30分あたり)') }}
                    {{ Form::text('price', null, ['class' => 'form-control', 'placeholder' => '価格はコンマなしで記入してください。']) }}
                </div>
                
                <div>
                    {{ Form::label('remark', '説明・備考') }}
                    {{ Form::textarea('remark', null, ['class' => 'form-control']) }}
                </div>
                
                <div>
                    {{ Form::file('image_path', ['class' => 'mt-3']) }}
                </div>
                {{ Form::submit('登録', ['class' => 'd-grid mx-auto mt-3 btn btn-success rounded-pill']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection