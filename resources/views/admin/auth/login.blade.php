<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/admin/favicon/favicon.ico') }}" type="image/x-icon"/>

    <!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/theme.bundle.css') }}" id="stylesheetLight" />
    <link rel="stylesheet" href="{{ asset('/admin/css/theme-dark.bundle.css') }}" id="stylesheetDark" />

    <style>body { display: none; }</style>

    <!-- Title -->
    <title>Авторизация</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156446909-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag("js", new Date());gtag("config", "UA-156446909-1");</script>
</head>
<body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">

            <!-- Image -->
            <div class="text-center">
                <img src="{{ asset('/admin/img/illustrations/happiness.svg')}}" alt="..." class="img-fluid">
            </div>
        </div>
        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">
            <x-admin.error/>
            <h1 class="display-4 text-center mb-3">
                Вход
            </h1>
            <!-- Form -->
            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                @method('POST')

                <!-- Email address -->
                <div class="form-group">

                    <!-- Label -->
                    <label class="form-label">
                        Почта
                    </label>

                    <!-- Input -->
                    <input type="email" name="email" class="form-control" placeholder="Введите почту">

                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="row">
                        <div class="col">

                            <!-- Label -->
                            <label class="form-label">
                                Пароль
                            </label>

                        </div>
{{--                        <div class="col-auto">--}}

{{--                            <!-- Help text -->--}}
{{--                            <a href="password-reset-cover.html" class="form-text small text-muted">--}}
{{--                                Forgot password?--}}
{{--                            </a>--}}

{{--                        </div>--}}
                    </div> <!-- / .row -->

                    <!-- Input group -->
                    <div class="input-group input-group-merge">

                        <!-- Input -->
                        <input class="form-control" name="password" type="password" placeholder="Введите пароль">

                        <!-- Icon -->
                        <span class="input-group-text">
                  <i class="fe fe-eye"></i>
                </span>

                    </div>
                </div>

                <!-- Submit -->
                <button class="btn btn-lg w-100 btn-primary mb-3">
                    ВОЙТИ
                </button>

                <!-- Link -->
{{--                <div class="text-center">--}}
{{--                    <small class="text-muted text-center">--}}
{{--                        Don't have an account yet? <a href="sign-up-illustration.html">Sign up</a>.--}}
{{--                    </small>--}}
{{--                </div>--}}

            </form>

        </div>
    </div> <!-- / .row -->
</div> <!-- / .container -->

<!-- JAVASCRIPT -->
<!-- Map JS -->
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

<!-- Vendor JS -->
<script src="{{ asset('/admin/js/vendor.bundle.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('/admin/js/theme.bundle.js') }}"></script>

</body>
</html>
