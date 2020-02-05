<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
    
      @include('components.user.styles')
      @stack('addon-style')
      
      <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css')}}" />

  </head>
  <body>

      @include('components.user.navbar')

        @yield('content')    
    
      @include('components.user.footer')
      
      @include('components.user.scripts') 
      @stack('addon-script')
      
  </body>
</html>
