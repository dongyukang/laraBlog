<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('components/bootstrap/dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('components/bootstrap/dist/css/bootstrap-theme.min.css')}}" />
    @yield('header')
</head>
<body>
@include('partials.navbar')
@yield('content')



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

@yield('footer')
</body>
</html>