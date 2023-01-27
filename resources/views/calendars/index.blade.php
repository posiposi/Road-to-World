@extends('layouts.app')

@section('content')

<head>
    <style>
        html {
            font-family: sans-serif;
        }

        table {
            border-collapse: collapse;
            border: 2px solid rgb(200, 200, 200);
            letter-spacing: 1px;
            font-size: 0.8rem;
        }

        td,
        th {
            border: 1px solid rgb(190, 190, 190);
            padding: 10px 20px;
            text-align: center;
        }

        td {
            text-align: center;
        }

        th.saturday {
            color: blue;
        }

        th.sunday {
            color: red;
        }

        caption {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1 class='ms-3'>予約状況カレンダー</h1>

    <div class="cotainer">
        <a class="ms-4" href="{{ route('bikes.calendar', ['bikeId' => $bike->id, 'week' => 'last_week', 'now' => $dt]) }}">先週へ</a>
        <a class="ms-2" href="{{ route('bikes.calendar', ['bikeId' => $bike->id, 'week' => 'next_week', 'now' => $dt]) }}">翌週へ</a>
        <div class="row mx-4">
            <table>
                <tr>
                    <th></th>
                    <th></th>
                    @foreach($days as $day)
                    <th>{{ $day }}</th>
                    @endforeach
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="text-center">月</th>
                    <th class="text-center">火</th>
                    <th class="text-center">水</th>
                    <th class="text-center">木</th>
                    <th class="text-center">金</th>
                    <th class="text-center text-primary">土</th>
                    <th class="text-center text-danger">日</th>
                </tr>
                @foreach($times as $time)
                <tr>
                    <td rowspan="2">{{ $time. "時" }}</td>
                    <td>00分</td>
                    @for($i = 0; $i < 7; $i++) @if ($bike->is_reservations($days[0], $time, '00', $i))
                        <th>予約あり</th>
                        @else
                        <th></th>
                        @endif
                    @endfor
                </tr>

                <tr>
                    <td>30分</td>
                    @for($i = 0; $i < 7; $i++) @if ($bike->is_reservations($days[0], $time, '30', $i))
                        <th>予約あり</th>
                        @else
                        <th></th>
                        @endif
                    @endfor
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
@endsection