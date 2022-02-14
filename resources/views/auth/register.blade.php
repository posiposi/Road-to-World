@extends ('layouts.app')

@section('content')
    <div class="text-center my-4">
        <h1>ユーザ登録</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {{ Form::open(['route' => 'signup.post']) }}
                <div class="form-group">
                    {{ Form::label('name', '氏名') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {{ Form::label('nickname', 'ニックネーム') }}
                    {{ Form::text('nickname', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'メールアドレス') }}
                    {{ Form::email('email', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {{ Form::label('tel', '電話番号') }}
                    {{ Form::text('tel', null, ['class' => 'form-control', 'placeholder' => '半角、ハイフン無しで入力して下さい。 例：09012345678'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('password', 'パスワード') }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '8文字以上で入力して下さい。']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password_confirmation', 'パスワード確認') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                </div>

                {{ Form::submit('登録', ['class' => 'btn btn-success btn-block']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection