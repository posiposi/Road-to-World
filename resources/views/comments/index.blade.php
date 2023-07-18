@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-warning">
        <h1 class="mt-4">{{ $bike->name }}の予約コメントルーム一覧</h1>
    </div>
    <div class="row">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>レンタル希望者氏名</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nickname }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('comments.show', [
                                'bikeId' => $bike->id,
                                'receiverId' => $user->id,
                                'senderId' => $bike->user_id
                            ]) }}" class="btn btn-info btn-sm">コメント画面へ</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection