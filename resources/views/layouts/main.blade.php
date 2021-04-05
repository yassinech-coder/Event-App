<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/ca6e0e7eec.js" crossorigin="anonymous"></script>
    
    <title></title>
    @include('../parts.header')
</head>
<body>
@include('../parts.nav')
@yield('content')

    @include('../parts.footer')
</body>
</html>