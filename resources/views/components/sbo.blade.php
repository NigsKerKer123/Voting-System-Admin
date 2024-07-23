<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Generate PDF Example - fundaofwebit.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        @page {
            margin: 1cm;
            @bottom-center {
                content: element(footer);
            }
        }

        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #ccc; /* Optional: Add a border at the top of the footer */
        }

        .footer p {
            margin: 5px;
            padding: 0;
        }

        .custom-table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }
        
        .custom-table th, 
        .custom-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
            font-family: Arial, sans-serif;
        }
        
        .custom-table th {
            background-color: #f2f2f2;
        }

        .custom-table tr, th {
        border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <div style="display: inline-block; position: absolute; left: 50%; transform: translateX(-50%);">
            <h1>{{$message}}</h1>
            <h2>STUDENT BODY ORGANIZATION ({{$college}})</h2>
        </div>
    </div>
        <div style="position: absolute; top: 12%; left: 50%; transform: translate(-50%, -50%);">
            <h3>{{$casted}} VOTED OVER {{$voter}}</h3>
        </div>

        <br><br><br><br><br><br><br><br>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>STUDENT ID</th>
                    <th>NAME</th>
                    <th>POSITION</th>
                    <th>PARTY LIST</th>
                    <th>VOTES</th>
                    <th>PERCENTAGE</th>
                    <th>RANK</th>
                </tr>
            </thead>

            <tbody>
            @foreach($gov as $govData)
                <tr>
                    <td>{{ $govData['student_id'] }}</td>
                    <td>{{ $govData['name'] }}</td>
                    <td>{{ $govData['position'] }}</td>
                    <td>{{ $govData['party'] }}</td>
                    <td>{{ $govData['votes'] }}</td>
                    <td>{{ $govData['percentage'] }}</td>
                    <td>{{ $govData['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>

            @foreach($vice_gov as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>

            @foreach($sec as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @if($ass_sec)
                @foreach($ass_sec as $data)
                    @if($data['student_id'] && $data['name'] && $data['position'] && $data['party'] && $data['votes'] && $data['percentage'] && $data['rank'])
                        <tr>
                            <td>{{ $data['student_id'] }}</td>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['position'] }}</td>
                            <td>{{ $data['party'] }}</td>
                            <td>{{ $data['votes'] }}</td>
                            <td>{{ $data['percentage'] }}</td>
                            <td>{{ $data['rank'] }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @foreach($tres as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @foreach($ass_tres as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @foreach($audit as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @foreach($pro as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @foreach($second as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @foreach($third as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            
            @foreach($fourth as $data)
                <tr>
                    <td>{{ $data['student_id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['position'] }}</td>
                    <td>{{ $data['party'] }}</td>
                    <td>{{ $data['votes'] }}</td>
                    <td>{{ $data['percentage'] }}</td>
                    <td>{{ $data['rank'] }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div style="margin-top: 1cm;">
            <p>Reviewed by</p>
            <p>Head Comelec: </p>
            <p>Administor: </p>
            <p>System and Database Administor: </p>
        </div>

        <div class="footer">
            <p>
                Date and Time of Generation: {{ date('Y-m-d H:i:s') }}
            </p>

            <p>
                Generated By: Buksu Comelec 2024
            </p>
        </div>
    </body>
</html>