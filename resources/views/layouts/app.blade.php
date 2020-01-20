<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
    
    {{-- Styles --}}
      @include('components.user.styles')
      @stack('addon-style')
      
      <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css')}}" />
    {{-- end styles --}}

  </head>
  <body>

    {{-- Navbar --}}
      @include('components.user.navbar')
    {{-- end Navbar --}}

    {{-- content --}}
        @yield('content')
    {{-- end content --}}
    
    {{-- Footer --}}
      @include('components.user.footer')
      {{-- end footer --}}
      
    {{-- Scripts --}}
      @include('components.user.scripts') 
      @stack('addon-script')
    {{-- end scripts --}}

  </body>
</html>
