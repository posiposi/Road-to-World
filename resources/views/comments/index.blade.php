@extends('layouts.app')

@section('content')
    <div class="row text-warning">
        <h1 class="mt-4">{{ $bikes->name }}の予約コメントルーム一覧</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>レンタル希望者氏名</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tbl">
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nickname }}</td>
                    <td class="text-nowrap">
                        {{ link_to_route(
                            'comments.show', 'コメント画面へ', 
                            ['bikeId' => $bikes->id, 'receiverId' => $user->id, 'senderId' => $bikes->user_id],
                            ['class' => 'btn btn-info btn-sm']
                        )}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection