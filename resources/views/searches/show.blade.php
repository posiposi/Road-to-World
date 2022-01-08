@extends('layouts.app')

@section('content')
<div class="text-center my-4">
    <h1>検索</h1>
</div>
<div class="container">
    <div class="row my-4">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(['route' => 'search.index']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'バイク名') !!}
                    {!! Form::text('name', '@if (isset($search)) {{ $search }} @endif', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('検索', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection