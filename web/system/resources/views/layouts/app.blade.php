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
	<style>
        .loading {
            background: lightgoldenrodyellow url('{{asset('images/processing.gif')}}') no-repeat center 65%;
            height: 80px;
            width: 100px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }
        html, body {
            height: 100%;
            font-family: gotham, verdana;
            font-size: 1em;
        }
        .wrap {
            min-height: 514px;
        }
    </style>
</head>
<body>
    <header>@include('layouts.header')</header>
    <div class="wrap" style="min-height: 531px;">
        <div id="main" class="container-fluid clear-top">
            <section>@yield('content')</section>
            <div class="loading"></div>
        </div>
    </div>
    <footer class="footer">@include('layouts.footer')</footer>
</body>
<script>
function ajaxLoad(filename, content) {
	content = typeof content !== 'undefined' ? content : 'content';
	$('.loading').show();
	$.ajax({
		type: "GET",
		url: filename,
		contentType: false,
		success: function (data) {
			$("#" + content).html(data);
			$('.loading').hide();
		},
		error: function (xhr, status, error) {
			alert(error);
		}
	});
}
</script>
</html>
