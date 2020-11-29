<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vue Project</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}" defer></script>
</head>

<body class="antialiased" style="background-color: rgba(231, 231, 231, 0.699)">
    <div id="app">
        <index></index>   
    </div>
</body>

</html>

<style>
    .bg-primary {
        background-color: rgba(10, 10, 187, 0.678) !important;
    }
    .text-primary {
        color:  rgba(10, 10, 187, 0.678) !important;
    }
    .btn-primary {
        background-color:  rgba(10, 10, 187, 0.678) !important;
        border-color: rgba(10, 10, 187, 0.678) !important;
    }
    .btn-primary:hover {
        background-color:  rgba(43, 43, 185, 0.603) !important;
    }
</style>
