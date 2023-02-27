<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body id="page-top">
    @include('includes.header')
   
    @yield('content')
    
    @include('includes.footer')
</body>
</html>