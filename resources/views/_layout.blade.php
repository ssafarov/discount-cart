<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coupons constructor</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="content">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-laravel">
        <a class="navbar-brand" href="/">Mega Shopping</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/coupons">Coupon constructor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cart">Shop</a>
            </li>
        </ul>
    </nav>

    @if(session()->get('success'))
        <div class="col-sm-12">
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        </div>
    @endif

    <div class="container">
        @yield('main')
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>

