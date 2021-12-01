@extends('layouts.app')

@section('content')
    <head>
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
        <div class="cotainer">
            <div class="row">
                <div class="col-sm-12">
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            @foreach($tests as $test)
                            <th>{{ $test }}</th>
                            @endforeach
                            <th>火</th>
                            <th>水</th>
                            <th>木</th>
                            <th>金</th>
                            <th class="saturday">土</th>
                            <th class="sunday">日</th>
                        </tr>
                        @foreach($times as $time)
                        <tr>
                            <td rowspan="2">{{ $time. "時" }}</td>
                            <td>00分</td>
                            @for($i = 0; $i < 7; $i++)
                                <th></th>
                            @endfor
                        </tr>
                        
                        <tr>
                            <td>30分</td>
                            @for($i = 0; $i < 7; $i++)
                                <th></th>
                            @endfor
                        </tr>
                        @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
@endsection