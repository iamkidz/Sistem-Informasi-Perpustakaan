<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header')

    <title>@yield('title')</title>
    @notifyCss

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}" />
    @yield('css')

</head>

<body>
    <div id="app">
        @include('layouts.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <x:notify-messages />

    @notifyJs

    @if ($errors->any())
        @php
            $ernof = '';

            notify()->error(implode('', $errors->all()));

            header('Refresh:0');
        @endphp
    @endif


    <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    @yield('js')
</body>

</html>
