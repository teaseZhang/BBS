<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','BBS')</title>
</head>
<link rel="stylesheet" href="/css/app.css">
<body>
@include('layouts._header')
<div class="container">
    <div class="col-lg-10">
    @yield('content')
    @include('layouts._footer')
    </div>
</div>
</body>
</html>