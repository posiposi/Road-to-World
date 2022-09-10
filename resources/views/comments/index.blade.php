@extends('layouts.app')

@section('content')
    <div class="row text-warning">
        <h1 class="mt-4">{{ $bike->name }}の予約コメントルーム一覧</h1>
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
            @foreach ($user as $user_info)
                <tr>
                    <td>{{ $user_info->nickname }}</td>
                    <td class="text-nowrap">
                        {{ link_to_route(
                            'comments.show', 'コメント画面へ', 
                            ['bikeId' => $bike->id, 'receiverId' => $user_info->id, 'senderId' => $bike->user_id],
                            ['class' => 'btn btn-info btn-sm']
                        )}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection