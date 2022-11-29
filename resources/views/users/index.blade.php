@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/mypage.css') }}">
@endpush

@section('content')
    <div class="row my-4">
        <h1 class="text-dark font-weight-bold">My Page</h1>
    </div>
    <div class='container'>
        <div class="row no-gutters ms-3">
            {{-- ユーザアバター --}}
            <div class="col-md-6">
                <div class="card-body shadow-sm contents-avatar">
                    @if($login_user->image != null)
                    <img class="card-img img-fluid avatar-img" style="max-height:1080px" src="{{ $login_user->image }}" alt="ユーザアバター画像">
                    @else
                    <img class="card-img img-fluid avatar-img" style="max-height:1080px" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/avatars/nc96424.jpg" alt="デフォルトアバター画像">
                    @endif
                    <div class="form-group">
                        {{ Form::open(['route' => 'users.store', 'files' => true]) }}
                            {{ Form::file('image', ['class' => 'form-contorol-file my-2']) }}
                            {{ Form::submit('アバター登録', ['class' => 'btn btn-success btn-block']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
    
            {{-- ユーザ情報表示カード --}}
            <div class="col-md-6">
                <div class="card-body">
                    <ul class="list-group list-unstyled">
                        <li class="list-group-item"> 氏名：{{ $login_user->name }} <li>
                        <li class="list-group-item"> ニックネーム：{{ $login_user->nickname }}</li>
                        <li class="list-group-item"> メールアドレス：{{ $login_user->email }} </li>
                        <li class="list-group-item"> 電話番号：{{ $login_user->tel }} </li>
                    </ul>
                </div>
                <div class='card-body'>
                    {{ link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) }}
                    {{ link_to_route('users.edit', 'ユーザ登録内容変更', [], ['class' => 'btn btn-success'],) }}
                </div>
            </div>
        </div>
    </div>

    {{-- ユーザの貸出中自転車の一覧表示 --}}
    <div class="container">
        <div class="row my-4">
            <h2 class="text-dark">あなたが貸し出し中の自転車</h2>
        </div>
        <div class="row no-gutters ms-3">
            @foreach ($bikes as $bike)
                @if($bike->user_id == $login_user->id)
                    <div class="col-md-6 mt-3 mb-3">
                        <img class="card-img img-fluid user-bike-img" src="{{ $bike->image_path }}" alt="自転車画像">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <ul class="list-group list-unstyled">
                                <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                                <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                                <li class="list-group-item user-bike-card-remark"> 説明・備考</br>
                                    <p class="mt-2">{{ $bike->remark }}</p>
                                </li>
                            </ul>    
                            <ul class="list-group list-unstyled">
                                <li class="list-group-item">
                                    {{ link_to_route('bikes.edit', '登録内容変更', ['bike_id' => $bike->id], ['class' => 'btn btn-success'],) }}
                                    <script>
                                        function confirm_delete() {
                                            var select = confirm("削除してもよろしいですか？");
                                            return select;
                                        }
                                    </script>
                                    <form action="{{ route('bikes.delete', $bike->id)}}" method="post" onsubmit="return confirm_delete()">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger mt-2">削除</button>
                                    </form>
                                </li>
                            </ul>
                        </div> 
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- ユーザの予約一覧表 --}}
    <div class="container">
        <div class="row my-2">
            <h2 class="text-dark">予約表</h2>
        </div>
        <div class="row">
            <div class="col-sm-12 mt-2 mb-4">
                <table>
                    <tr>
                        <th>モデル名</th>
                        <th>貸出者</th>
                        <th>受け渡し場所</th>
                        <th>開始日時</th>
                        <th>終了日時</th>
                    </tr>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td> {{ $reservation->bike->name }} </td>
                        <td> {{ $reservation->bike->user->nickname }} </td>
                        <td> {{ $reservation->bike->bike_address }} </td>
                        <td> {{ $reservation->start_at }} </td>
                        <td> {{ $reservation->end_at }} </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection