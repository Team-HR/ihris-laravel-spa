@extends('sys_admin.layouts.app')

@section('content')
<div class="container-fluid">

<div class="jumbotron">
  {{-- <div class="container-fluid text-center">
    <img src="{{ asset('favicon.ico') }}" width="100" height="100"> 
    <h1 class="display-4">Integrated Human Resource Information System</h1>    
  </div> --}}

  <h1 class="display-4">Hello, {{auth::user()->name}}!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="cores/" role="button">Go to the Cores</a>
</div>

</div>
@endsection
