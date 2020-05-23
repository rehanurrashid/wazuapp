<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') | {{ \Config::get('app.name') }}</title>

<link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.png')}}">

@include("user.templates.styles")
@include("user.templates.scripts")
