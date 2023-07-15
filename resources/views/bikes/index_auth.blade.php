@auth
@if ($user->id !== $bike->user_id)
<ul class="list-group list-unstyled mt-3">
    <form class="reservation-form" action="{{ route('bikes.reservation', ['bikeId' => $bike->id]) }}" method="post">
        @csrf
        <li class="list-group-item">{{ Word::BIKE_INDEX_LABEL['start_date'] }}<input type="date" name="start_date"><br>
            {{ Word::BIKE_INDEX_LABEL['start_time'] }}
            <select name="start_time">
                @foreach($times as $time)
                <option value="{{ $time }}">{{ $time }}</option>
                @endforeach
            </select>
        </li>
        <li class="list-group-item">{{ Word::BIKE_INDEX_LABEL['end_date'] }}<input type="date" name="end_date"><br>
            {{ Word::BIKE_INDEX_LABEL['end_time'] }}
            <select name="end_time">
                @foreach($times as $time)
                <option value="{{ $time }}">{{ $time }}</option>
                @endforeach
            </select>
        </li>
        <button type="submit" id="reservation-btn" class="btn btn-primary rounded-pill d-block mt-2 mx-auto">
            予約
        </button>
    </form>
</ul>
@endif
<ul class="list-group list-unstyled mt-3">
    @if($user->id == $bike->user_id)
    <a href="{{ route('comments.index', [
            'bikeId' => $bike->id,
            'lenderId' => $user->id
        ]) }}" class="btn btn-success">コメントルーム一覧へ</a>
    @else
    <a href="{{ route('comments.show', [
            'bikeId' => $bike->id,
            'senderId' => $user->id,
            'receiverId' => $bike->user_id
        ]) }}" class="btn btn-success">コメントルームへ</a>
    @endif
</ul>
<ul class="list-group list-unstyled mt-3">
    <a href="{{ route('bikes.calendar', [
            'bikeId' => $bike->id,
            'week' => 'this_week',
            'now' => 'today'
        ]) }}" class="btn btn-success">予約状況カレンダー</a>
</ul>
@endauth