<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buksu Comelec: Admin Organizations</title>
    <link rel="icon" href="{{ asset('images/tab_Icon.png') }}" type="image/x-icon" style="border-radius: 50%;">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <header>
        @include('components.navbar')
    </header>

    @include('components.sidebar')

    @include('home.body.organization')

    @include('home.modal.organization')
</body>
</html>

@if(Session::has('success'))
    <script>
        alert("{{ Session::get('success') }}");
    </script>
@endif

@if(Session::has('error'))
    <script>
        alert("{{ Session::get('error') }}");
    </script>
@endif