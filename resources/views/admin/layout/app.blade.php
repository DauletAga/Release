<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/admin/logo/logo.png') }}" type="image/x-icon"/>

    <!-- Map CSS -->
    <link rel="stylesheet" href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/theme.bundle.css') }}" id="stylesheetLight" />
    <link rel="stylesheet" href="{{ asset('/admin/css/theme-dark.bundle.css') }}" id="stylesheetDark" />

    <link href="{{asset('/custom/css/admin.css')}}" rel="stylesheet">

    <style>body { display: none; }</style>

    <!-- Title -->
    <title>Admin</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src='https://www.googletagmanager.com/gtag/js?id=UA-156446909-1'></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag("js", new Date());gtag("config", "UA-156446909-1");</script>

    @yield('css')

</head>