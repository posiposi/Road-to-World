@extends('layouts.app')

@section('content')
    <div class="text-center my-4">
        <h1>バイク登録情報変更</h1>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-sm-6 offset-sm-3">
                {{ Form::open(['route' => ['bikes.update', 'id'=>$bikes->id], 'files' => true, 'method' => 'put',]) }}
                    <div class="form-group">
                        {{ Form::label('brand', 'ブランド') }}
                        {{ Form::text('brand', old('brand', $bikes->brand), ['class' => 'form-control']) }}
                    </div>
    
                    <div class="form-group">
                        {{ Form::label('name', 'モデル名') }}
                        {{ Form::text('name', old('name', $bikes->name), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('status', '保管状態') }}
                        {{Form::select('status', ['良い' => '良い', '普通' => '普通', '悪い' => '悪い'], null, ['class' => 'form-control', 'placeholder' => old('status', $bikes->status)])}}
                    </div>
    
                    <div class="form-group">
                        {{ Form::label('bike_address', '受け渡し場所') }}
                        {{ Form::text('bike_address', old('bike_address', $bikes->bike_address), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('price', '料金(30分あたり)') }}
                        {{ Form::text('price', old('price', $bikes->price), ['class' => 'form-control', 'placeholder' => '価格はコンマなしで記入してください。']) }}
                    </div>
                
                    <div class="form-group">
                        {{ Form::label('remark', '説明・備考') }}
                        {{ Form::textarea('remark', old('textarea', $bikes->remark), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::file('image_path', ['class' => 'form-contorol-file']) }}
                    </div>
                    {{ Form::submit('変更', ['class' => 'btn btn-success btn-block']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection