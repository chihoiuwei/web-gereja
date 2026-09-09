<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


    <title>@yield('title', 'GPIJS Jakpus')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800">

    @include('components.public.navbar')

    @yield('content')

</body>
</html>