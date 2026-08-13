<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


@include('partials.header.header')
@yield('navbars')

@yield('sidebars')

@yield('content')

@include('partials.footer.footer')


</body>
</html>

