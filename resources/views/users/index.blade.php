@extends('layouts.app')

@section('content')
    <div class="row text-warning">
        <h1>My Page</h1>
    </div>
    <div class='container'>
        <div class="border border-dark card mt-3 mb-3" style="max-width: 1080px">
            <div class="row no-gutters ml-3">
                {{-- アバター画像 --}}
                <div class="col-md-6 mt-3">
                    
                </div>
            </div>
            
            {{-- ユーザ情報表示カード --}}
            <div class="col-md-6">
                <div class="card-body">
                    <ul class="list-group list-unstyled border border-dark">
                        <li class="list-group-item"> 氏名：{{ $auth->name }} <li>
                        <li class="list-group-item"> メールアドレス：{{ $auth->email }} </li>
                        <li class="list-group-item"> 電話番号：{{ $auth->tel }} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection