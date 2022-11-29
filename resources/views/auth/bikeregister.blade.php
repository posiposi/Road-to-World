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
                
                <div>
                    {{ Form::label('status', '保管状態') }}
                    {{ Form::select('status', ['良い' => '良い', '普通' => '普通', '悪い' => '悪い'], '普通', ['class' => 'form-control']) }}
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