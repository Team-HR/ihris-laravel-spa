<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}

</head>
<body>
<div id="app">
<v-app>
<app-layout appbar-bg-url="{{asset('images/circuitboardbg.gif')}}">
  <template v-slot:logo>
    <img src="{{asset('favicon.ico')}}" width="30" class="mr-2">
  </template>
  <plantilla-permanent></plantilla-permanent>
</app-layout>
</v-app>
</div>





</body>
</html>