<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> ETSB :: Employee's CRUD Application </title>
    {{ HTML::style('asset/css/bootstrap.min.css') }}
    {{ HTML::style('asset/css/template.css') }}

    {{-- Start Scripts --}}
    {{ HTML::script('asset/js/jquery.min.js')}}
    {{ HTML::script('asset/js/bootstrap.min.js')}}
    {{-- End Scripts --}}

</head>

<body>
<div class="container">
    @yield('content')
</div>

</body>
</html>