<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.svg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/app.css">


    @hasSection('title')
        <title>{{config('app.name')}} - @yield('title')</title>
    @else
        <title>{{config('app.name')}}</title>
    @endif

</head>
<body class="px-1 maxWidth mx-auto">
@include('master.navbar')

    <div class="container-fluid">

        @include('includes.jswarning')
        <div class="mt-4">
            @yield('content')
        </div>


</div>
@include('master.footer')
</body>
</html>
