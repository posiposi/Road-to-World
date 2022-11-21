@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/welcomepage.css') }}">
@endpush

@section('content')
    <main id="app">
        <div>
            <main-page-visual welcome_logo_path="{{ $welcome_logo_path }}"></main-page-visual>
        </div>
        @guest
            <section>
                <div class="container">
                    <div class="form-group row">
                        {{ Form::open(['route' => 'login.post']) }}
                            {{ Form::label('email', Word::WORD_LIST['email']), ['class' => 'col-sm-2 col-form-label'] }}
                            {{ Form::email('email', null, ['class' => 'col-sm-10 form-control']) }}
                            <div class="form-group">
                                {{ Form::label('password', Word::WORD_LIST['password']) }}
                                {{ Form::password('password', ['class' => 'form-control']) }}
                            </div>
                            {{ Form::submit(Word::WORD_LIST['login'], ['class' => 'btn btn-primary btn-block']) }}
                        {{ Form::close() }}
                        <div class="text-right mt-2">
                            {{ link_to_route('signup.get', Word::WORD_LIST['signup'], [], ['class' => 'text-dark']) }}
                        </div>
                    </div>
                </div>
            </section>
        @endguest
    </main>
@endsection