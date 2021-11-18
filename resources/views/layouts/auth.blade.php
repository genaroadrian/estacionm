<!DOCTYPE html>
<html lang="ea">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
    @yield('css')
</head>

<body>
    @yield('content')

    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var animating = false,
            submitPhase1 = 1100,
            submitPhase2 = 400,
            logoutPhase1 = 800,
            $login = $(".login"),
            $app = $(".app");
        });
    </script>
</body>

</html>