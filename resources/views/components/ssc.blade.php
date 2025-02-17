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
            <h2>SUPREME STUDENT COUNCIL</h2>
        </div>
    </div>
        <div style="position: absolute; top: 9%; left: 50%; transform: translate(-50%, -50%);">
            <h3>{{$casted}} VOTED OVER {{$voter}}</h3>
        </div>

        <br><br><br><br><br><br>

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
            @foreach($pres as $presData)
                <tr>
                    <td>{{ $presData['student_id'] }}</td>
                    <td>{{ $presData['name'] }}</td>
                    <td>{{ $presData['position'] }}</td>
                    <td>{{ $presData['party'] }}</td>
                    <td>{{ $presData['votes'] }}</td>
                    <td>{{ $presData['percentage'] }}</td>
                    <td>{{ $presData['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>

            @foreach($vice_pres as $vice_presData)
                <tr>
                    <td>{{ $vice_presData['student_id'] }}</td>
                    <td>{{ $vice_presData['name'] }}</td>
                    <td>{{ $vice_presData['position'] }}</td>
                    <td>{{ $vice_presData['party'] }}</td>
                    <td>{{ $vice_presData['votes'] }}</td>
                    <td>{{ $vice_presData['percentage'] }}</td>
                    <td>{{ $vice_presData['rank'] }}</td>
                </tr>
            @endforeach

            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>

            @foreach($sen as $senData)
                <tr>
                    <td>{{ $senData['student_id'] }}</td>
                    <td>{{ $senData['name'] }}</td>
                    <td>{{ $senData['position'] }}</td>
                    <td>{{ $senData['party'] }}</td>
                    <td>{{ $senData['votes'] }}</td>
                    <td>{{ $senData['percentage'] }}</td>
                    <td>{{ $senData['rank'] }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div style="margin-top: 3cm;">
            <p>Reviewed by</p>
            <p>Head Commissioner: Jia Lyn A. Idul</p>
            <p>Adviser: Mark Ian M. Mukara</p>
            <p>Database Administrator: Klevie Jun Caseres</p>
            <p>System Administrator: Kirk John L. Sieras, Renz Maverick Q. Fama, Khyle Ivan Khim V. Amacna</p>
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