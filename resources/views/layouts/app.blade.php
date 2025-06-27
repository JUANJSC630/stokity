<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Charset & Viewport -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title & Meta -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta
        name="keywords"
        content="Stokity" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">


    @if(Auth::user())
    <div class="app-wrapper">
        @include('layouts.components.navbar')
        @include('layouts.components.sidebar')

        @yield('content')
    </div>
    @else

    @yield('login')

    @endif



</body>

</script>

</html>



@vite(['resources/css/app.css', 'resources/js/adminlte.js'])