<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')Project Monitoring App</title>
</head>
<body>
	<header>@include('layouts.header')</header>
    @yield('content')
    <footer>@include('layouts.footer')</footer>
</body>
</html>
