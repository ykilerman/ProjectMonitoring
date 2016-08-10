<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')Project Monitoring App</title>
    {{ Html::style(asset('css/bootstrap.min.css')) }}
    {{ Html::style(asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.css')) }}
    {{ Html::script(asset('js/jquery-2.2.3.min.js')) }}
    {{ Html::script(asset('js/bootstrap.min.js')) }}
    {{ Html::script(asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.js')) }}
</head>
<body>
	<header>@include('layouts.header')</header>
    @yield('content')
    <footer>@include('layouts.footer')</footer>
</body>
</html>
