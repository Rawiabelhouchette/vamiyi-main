<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}') }}" type="image/x-icon">

    <title>Vamiyi</title> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="description" content="Best Responsive job portal template build on Latest Bootstrap.">
    <meta name="keywords" content="job, nob board, job portal, job listing">
    <meta name="robots" content="index,follow">' --}}

    <link rel="icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" type="image/x-icon">
    <title>Vamiyi - 500 Server Error</title>

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

        <!-- Start Login Section -->
        <section class="detail-section" style="background:url({{ asset('assets_client/img/banner/image-4.jpg') }});" data-overlay="6">
            <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
            <div class="profile-cover-content">
                <div class="container">
                    <div class="center">
                        <h3 style="color: white;">500</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Login Section -->

        <div class="clearfix"></div>

        <section>
            <div class="container">
                <div class="booking-confirm padd-top-10 padd-bot-10">
                    <h1 class="mrg-top-15 mrg-bot-0 cl-danger font-100 font-bold">500</h1>
                    <h2 class="mrg-top-15" style="color: #f21136;">Une erreur s'est produite</h2>
                    <p>Veuillez réessayer plus tard</p>
                    <a href="{{ route('accueil') }}" class="btn theme-btn-trans mrg-top-20">Retourner à l'accueil</a>
                </div>
            </div>
        </section>

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

        <!-- Custom Js -->
        <script src="{{ asset('assets_client/js/custom.js') }}"></script>

        <script>
            window.addEventListener('page:reload', event => {
                location.reload();
            });
        </script>

        <script>
            // refresh url
            window.addEventListener('refresh:url', event => {
                window.history.replaceState({}, '', event.detail[0].url);
            });
        </script>

        @livewireScripts

        @stack('scripts')

    </div>
</body>

</html>
