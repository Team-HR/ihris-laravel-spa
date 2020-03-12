<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body>
<div id="app">
<!-- App.vue start -->
<v-app>

  <v-navigation-drawer app>
    <!-- -->
  </v-navigation-drawer>

  <v-app-bar app>
    <!-- -->
  </v-app-bar>  

  <!-- Sizes your content based upon application components -->
  <v-content>

    <!-- Provides the application the proper gutter -->
    <v-container fluid>

        <data-tablefy
            fetch-url="{{ route('plantilla_permanents.table') }}"
        ></data-tablefy>

    </v-container>
  </v-content>

  <v-footer app>
    <!-- -->
  </v-footer>
</v-app>
<!-- App.vue end -->
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>