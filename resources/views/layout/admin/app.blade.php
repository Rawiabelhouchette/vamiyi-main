<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="description" content="Best Responsive job portal template build on Latest Bootstrap.">
    <meta name="keywords" content="job, nob board, job portal, job listing">
    <meta name="robots" content="index,follow">' --}}

    <link type="image/x-icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" rel="icon">
    <link type="image/x-icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" rel="shortcut icon">

    <title>Vamiyi</title>

    @livewireStyles

    <!-- BOOTSTRAP STYLES-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />

    <!-- FONTAWESOME STYLES-->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />

    <!-- Line Font STYLES-->
    <link href="{{ asset('assets/css/line-font.css') }}" rel="stylesheet" />

    <!-- Dropzone Style-->
    <link href="{{ asset('assets/css/dropzone.css') }}" rel="stylesheet" />

    <!-- Bootstrap Editor-->
    <link href="{{ asset('assets/css/bootstrap-wysihtml5.css') }}" rel="stylesheet" />

    <!-- Common Style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <!-- CUSTOM STYLES-->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/perso.css') }}" rel="stylesheet" />

    <!-- DATATABLE -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.css') }}"> --}}

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" rel="stylesheet" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    {{-- Dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css" rel="stylesheet">

    <style>
        #map {
            height: 160px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background-color: #fff;
            /* background-color: #333; */
            color: #333;
            /* color: #fff; */
            line-height: 5px;
            text-align: right;
        }

        .card-body {
           /* background-color: #e0e0e0;*/
        }

        input::-webkit-input-placeholder {
            font-style: italic;
        }

        input::-moz-placeholder {
            font-style: italic;
        }

        input:-ms-input-placeholder {
            font-style: italic;
        }

        input::-ms-input-placeholder {
            font-style: italic;
        }

        input::-webkit-input-placeholder {
            color: #C0C0C0;
        }

        input::-moz-placeholder {
            color: #C0C0C0;
        }

        input:-ms-input-placeholder {
            color: #C0C0C0;
        }

        input::-ms-input-placeholder {
            color: #C0C0C0;
        }
    </style>

    <style>
        #dataTable tfoot {
            position: fixed;
            bottom: 0;
            width: 100%;
            max-height: 20vh;
            margin-top: calc(100vh - 20vh);
        }

        #dataTable .dataTables_paginate {
            bottom: 5000px;
            position: fixed;
        }

        #dataTable {
            width: 100% !important;
        }

        #dataTable td {
            height: 35px;
        }
        
        #dataTable th {
            background: #203769 !important;
            height: 35px;
            border: none !important;
            color: #fff;
            font-weight: 400;
        }
    </style>

    <style>
        /* SELECT 2 : CUSTOM */
        .select2-container .select2-selection--single {
            height: 40px !important;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }

        .select2-selection__arrow {
            height: 35px !important;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #ff3a72 !important;
        }
    </style>

    @yield('css')

    @include('components.default-value')

    @php
        $defaultColor = '#ff3a72';
    @endphp

</head>

<body>

    <div id="wrapper">

        @include('layout.admin.navbar')

        @include('layout.admin.sidebar')

        {{-- @include('sweetalert::alert') --}}

        <div id="page-wrapper">

            @yield('content')

            @include('layout.admin.footer')
        </div>

        <!-- FOOT -->
    </div>
    <!-- /. WRAPPER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>
    <!-- Bootstrap Editor Js -->
    <script src="{{ asset('assets/js/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-wysihtml5.js') }}"></script>
    <!-- Scrollbar Js -->
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <!-- Dropzone Js -->
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js" integrity="sha512-6DC1eE3AWg1bgitkoaRM1lhY98PxbMIbhgYCGV107aZlyzzvaWCW1nJW2vDuYQm06hXrW0As6OGKcIaAVWnHJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

    <!-- FONTAWSOME -->
    {{-- <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- fancybox -->
    <script src="{{ asset('assets_client/plugins/js/jquery.fancybox.js') }}"></script>

    {{-- Default color --}}

    <script>
        window.addEventListener('alert:modal', event => {
            alert(event.detail[0].message);
        });

        window.addEventListener('swal:modal', event => {
            Swal.fire({
                icon: event.detail[0].icon,
                title: event.detail[0].title,
                timerProgressBar: true,
                confirmButtonColor: defaultColor,
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                timer: 4000,
                width: '40%',
                height: '40%',
                html: "<p style='font-size: 17px'>" + event.detail[0].message + "</p>",
            });
        });
    </script>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Opération réussie',
                timerProgressBar: true,
                confirmButtonColor: defaultColor,
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                timer: 4000,
                width: '40%',
                height: '40%',
                html: "<p style='font-size: 17px'>{{ session()->get('success') }}</p>",
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                timerProgressBar: true,
                confirmButtonColor: defaultColor,
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                timer: 5000,
                width: '40%',
                height: '40%',
                html: "<p style='font-size: 17px'>{{ session()->get('error') }}</p>",
            });
        </script>
    @endif

    @if (session()->has('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Information',
                timerProgressBar: true,
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                timer: 5000,
                width: '40%',
                height: '40%',
                html: "<p style='font-size: 17px'>{{ session()->get('info') }}</p>",
            });
        </script>
    @endif

    <script>
        // Mettre une etoile pour les champs requis
        // $(document).ready(function() {
        //     $("label").each(function() {
        //         if ($(this).hasClass("required")) {
        //             $(this).append(' <b style="color: red; font-size: 100%;">*</b>');
        //         }
        //         $(this).append(' :');
        //     });
        // });
    </script>

    {{-- Datatable --}}
    <script>
        let headers = document.querySelectorAll("#example th");
        headers.forEach(header => {
            header.style.border = "1px solid black";
            header.style.backgroundColor = "lightblue";
        });
    </script>

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" rel="stylesheet" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://unpkg.com/imask"></script>

    {{-- <script>
        let elements = document.getElementsByClassName('telephone');
        let maskOptions = {
            mask: '00 00 00 00'
        };
        for (let i = 0; i < elements.length; i++) {
            let mask = IMask(elements[i], maskOptions);
        }
    </script> --}}
    <script>
        // take cpuntry name as parameter
        function applyMask(country = 'Togo') {
            $('.telephone').each(function() {
                let maskOptions;

                switch (country) {
                    case 'Togo':
                        maskOptions = {
                            mask: '00 00 00 00'
                        }; // Format for Togo
                        break;
                    default:
                        maskOptions = {
                            mask: '00 00 00 00'
                        }; // Default format (TOGO)
                }

                let mask = IMask(this, maskOptions);
            });
        }
    </script>

    @livewireScripts

    @stack('scripts')

    @yield('js')

</body>

</html>
