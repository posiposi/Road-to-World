@extends('layouts.app')

@section('content')
     <div class="row text-warning">
        <h1>{{ $bikes->name }}の予約コメントルーム一覧</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>レンタル希望者氏名</th>
                {{--<th>コメント更新日時</th>--}}
                <th></th>
            </tr>
            </thead>
            <tbody id="tbl">
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    {{--<td>{{ $user->updated_at->format('Y.m.d') }}</td>--}}
                    <td class="text-nowrap">
                        {!! link_to_route('comments.show', 'コメント画面へ', ['bikeId' => $bikes->id, 'senderId' => $user->id], ['class' => 'btn btn-info btn-sm']) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection