@extends('layouts.app')

@section('content')
    <div class="text-center my-4">
        <h1>バイク登録情報変更</h1>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-sm-6 offset-sm-3">
                {{ Form::open(['route' => ['bikes.update', 'id'=>$bike->id], 'files' => true, 'method' => 'put',]) }}
                    <div class="mb-3">
                        {{ Form::label('brand', 'ブランド') }}
                        {{ Form::text('brand', old('brand', $bike->brand), ['class' => 'form-control']) }}
                    </div>
    
                    <div class="mb-3">
                        {{ Form::label('name', 'モデル名') }}
                        {{ Form::text('name', old('name', $bike->name), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="mb-3">
                        {{ Form::label('status', '保管状態') }}
                        {{ Form::select('status', ['良い' => '良い', '普通' => '普通', '悪い' => '悪い'], old('status', $bike->status), ['class' => 'form-control'])}}
                    </div>
    
                    <div class="mb-3">
                        {{ Form::label('bike_address', '受け渡し場所') }}
                        {{ Form::text('bike_address', old('bike_address', $bike->bike_address), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="mb-3">
                        {{ Form::label('price', '料金(30分あたり)') }}
                        {{ Form::text('price', old('price', $bike->price), ['class' => 'form-control', 'placeholder' => '価格はコンマなしで記入してください。']) }}
                    </div>
                
                    <div class="mb-3">
                        {{ Form::label('remark', '説明・備考') }}
                        {{ Form::textarea('remark', old('textarea', $bike->remark), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="mb-3">
                        {{ Form::file('image_path', ['class' => 'form-contorol-file']) }}
                    </div>
                    {{ Form::submit('変更', ['class' => 'btn btn-success btn-block']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection