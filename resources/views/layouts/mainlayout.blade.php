<!DOCTYPE html>

<html lang="en">

<head>

    @include('partials.head')

</head>

<body>

<div class="container">

    @include('partials.nav')

    @yield('content')

    @include('partials.footer')

</div>

</body>

</html>