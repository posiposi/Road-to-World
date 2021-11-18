@extends('layouts.app')

@section('content')
    <head>
        <meta charset="utf-8">
        <title>School timetable</title>
        <style>
        html {
        font-family: sans-serif;
        }
        
        table {
        border-collapse: collapse;
        border: 2px solid rgb(200,200,200);
        letter-spacing: 1px;
        font-size: 0.8rem;
        }
        
        td, th {
        border: 1px solid rgb(190,190,190);
        padding: 10px 20px;
        }
        
        td {
        text-align: center;
        }
        
        th.saturday {
        color: blue;
        }
        
        th.sunday {
        color:red;
        } 
        
        caption {
        padding: 10px;
        }
        </style>
    </head>
    
    <body>
        <h1>予約状況カレンダー</h1>
        
        <table>
            <tr>
                <th></th>
                @for($i = 1; $i < 49; $i++)
                    <th>{{ $i }}</th>
                @endfor
                <tr>
                    <th>Mon</th>
                </tr>
                <tr>
                    <th>Tues</th>
                </tr>
                <tr>
                    <th>Wed</th>
                </tr>
                <tr>
                    <th>Thurs</th>
                </tr>
                    <th>Fri</th>
                <tr>
                    <th class="saturday">Sat</th>
                </tr>
                <tr>
                    <th class="sunday">Sun</th>
                </tr>
            </tr>
        @for($i = 0; $i < 20; $i++)
            <tr>
                <th>
                    {{ $i }}
                </th>
            </tr>
        @endfor
        @for($i = 0; $i < 20; $i++)
            <td>{{ $i }}</td>
        @endfor        
        </table>
    </body>
@endsection