<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{!! @$title?$title.' | ':'' !!}EOBlend</title>
    <meta name="description" content="{!! @$description !!}">
    <meta property="image" content="https://eoblend.ru/img/poster.png"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}?v={{ $version }}">

    <meta property="og:title" content="{!! @$title?$title.' | ':'' !!}EOBlend">
    <meta property="og:description" content="{!! @$description !!}">
    <meta property="og:image" content="http://eoblend.ru/img/poster.png">
    <meta property="og:site_name" content="EOBlend"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}?v={{ $version }}">

    @include('metrics')
</head>

<body>

@yield('content')

<script src="{{ asset('js/app.min.js') }}?v={{ $version }}"></script>
<script>
    vueApp.currentPage      = '{!! $currentPage !!}';
    vueApp.oils             = JSON.parse('@json((object)@$oils)');
    vueApp.oil              = JSON.parse('@json((object)@$oil)');
    vueApp.compatibility    = JSON.parse('@json((object)@$compatibility)');
    vueApp.properties       = JSON.parse('@json((object)@$properties)');
    vueApp.oilProperties    = JSON.parse('@json((object)@$oilProperties)');
</script>

</body>
</html>