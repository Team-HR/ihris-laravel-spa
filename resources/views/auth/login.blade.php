
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <style type="text/css">
    @font-face {
        font-family: Abel;
        src: url('{{ asset('fonts/Abel-Regular.ttf') }}');
    }
    </style>
    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/fontawesome-free-5.12.0-web/css/all.min.css') }}" rel="stylesheet">

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

</head>
<style type="text/css">
    
    .form-group .form-control:focus
    {
        border: 2px solid royalblue;
    }

    .form-group .form-control:valid + .form-label
    {
        top: -10px;
        /*color: royalblue;*/
        font-size: 11px;
        background-color: white;
        padding-left: 2px;
        padding-right: 2px;
    }

    .form-group .form-control:focus + .form-label
    {
        top: -10px;
        color: royalblue;
        font-size: 11px;
        background-color: white;
        padding-left: 2px;
        padding-right: 2px;
    }

    .form-group .form-label
    {
        position: absolute;
        top: 8px;
        left: 25px;
        color: grey;
        transition: .1s;
    }

    /*        
        .form-group .form-label {
            position: absolute;
            bottom: 18px;
            left: 25px;
            background-color: white;
        }
    */
</style>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                <div class="card-body">

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="text-center p-5">
                        <img src="{{ asset('favicon.ico') }}" width="100" height="100">
                        <h3>Integrated HRIS</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}" novalidate="">
                        @csrf

                        <div class="form-group row justify-content-center ">
                            
                            <div class="col-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                <label for="username" class="form-label">Username</label>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6">
                                
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <label for="password" class="form-label">Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body> 
</html>
