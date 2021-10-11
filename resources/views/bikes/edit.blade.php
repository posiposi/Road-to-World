@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>バイク登録情報変更</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                {!! Form::open(['route' => ['bikes.update', 'id'=>$bikes->id], 'files' => true, 'method' => 'put',]) !!}
                    <div class="form-group">
                        {!! Form::label('brand', 'ブランド') !!}
                        {!! Form::text('brand', null, ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('name', 'バイク名') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('status', '保管状態') !!}
                        {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('bike_address', '受け渡し場所') !!}
                        {!! Form::text('bike_address', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::file('image_path', ['class' => 'form-contorol-file']) !!}
                    </div>
                    {!! Form::submit('登録', ['class' => 'btn btn-success btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection('content')