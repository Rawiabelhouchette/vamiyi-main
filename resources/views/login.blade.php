<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" type="image/x-icon">

    <title>Vamiyi - Login</title>

    <!-- All plugins -->
    <link href="{{ asset('assets_client/plugins/css/plugins.css') }}" rel="stylesheet">

    <!-- Custom style -->
    <link href="{{ asset('assets_client/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_client/css/responsiveness.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js') }} for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js') }}"></script>
      <script src="js/respond.min.js') }}"></script>
    <![endif]-->

    @livewireStyles

</head>

<body>
    <div class="wrapper">
        <!-- Start Navigation -->
        @include('layout.public.navbar', ['active' => 'login'])
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <!-- Start Login Section -->
        <section class="log-wrapper">
            <div class="container">
                <div class="col-md-6 col-sm-10 col-md-offset-3 col-sm-offset-1">
                    <div class="log-box padd-bot-25">
                        <h2>Connexion <span class="theme-cl">!</span></h2>

                        @error('email')
                            <div class="alert-group">
                                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Identifiant" required autocomplete="email" autofocus>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de Passe" required autocomplete="current-password">
                            </div>

                            @if (Route::has('password.reset'))
                                <div class="text-right">
                                    <a class="btn-link theme-cl" href="{{ route('password.reset') }}">
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                </div>
                            @endif

                            <span class="custom-checkbox d-block">
                                <input id="remember" type="checkbox" name="remember">
                                <label for="remember"></label>
                                {{ __('Se souvenir de moi') }}
                            </span>

                            <div class="text-center mrg-bot-20">
                                <button type="submit" class="btn theme-btn width-200 btn-radius">
                                    {{ __('Connexion') }}
                                </button>
                            </div>

                            <div class="center mrg-top-5">
                                <div class="bottom-login text-center"> {{ __("Vous n'avez pas de compte ?") }}</div>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#register" class="theme-cl">{{ __('Créer un compte') }}</a>
                            </div>
                        </form>
                         <a href="{{ route('google.login') }}" class="btn btn-danger">
            <img src="https://developers.google.com/identity/images/g-logo.png" width="20" class="me-2">
            Login with Google
        </a>

                    </div>
                </div>
            </div>
        </section>
        <!-- End Login Section -->

        <!-- ================ Start Footer ======================= -->
        @include('layout.public.footer')
        <!-- ================ End Footer Section ======================= -->

        <!-- ================== Login & Sign Up Window ================== -->
        @include('layout.public.connexion')
        <!-- ===================== End Login & Sign Up Window =========================== -->

        <!-- START JAVASCRIPT -->
        <script src="{{ asset('assets_client/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/bootsnav.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/bootstrap-touch-slider-min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery.touchSwipe.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/chosen.jquery.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/datedropper.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/dropzone.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery.fancybox.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery.nice-select.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jqueryadd-count.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery-rating.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/slick.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/timedropper.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/bootstrap-slider.js') }}"></script>

        <!-- Custom Js -->
        <script src="{{ asset('assets_client/js/custom.js') }}"></script>

        <script>
            window.addEventListener('page:reload', event => {
                location.reload();
            });
        </script>

        @livewireScripts

        @stack('scripts')

    </div>
</body>

</html>
