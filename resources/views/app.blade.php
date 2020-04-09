<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}

</head>
<body>
<div id="app">
    <app-layout>
        <template v-slot:user>
            {{Auth::user()->name}}
        </template>
        <template v-slot:csrf>
            @csrf
        </template>
        @yield('content')
    </app-layout>
</div>

{{-- @yield('script') --}}

</body>
</html>