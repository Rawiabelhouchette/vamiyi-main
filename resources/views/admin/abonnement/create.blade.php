@extends('layout.admin.app')

@section('abonnement', 'active')

@section('css')
    <style>
        .pricing {
            background: #f4f5f7;
        }

        .package-box {
            background: #ffffff;
            border-radius: 6px;
            overflow: hidden;
            margin-top: 25px;
            text-align: center;
            padding: 0px;
            transition: all ease 0.4s;
            border: 1px solid #f4f5f7;
            -webkit-box-shadow: 0px 0px 10px 0px rgba(107, 121, 124, 0.2);
            box-shadow: 0px 0px 10px 0px rgba(107, 121, 124, 0.2);
        }

        .package-box:hover,
        .package-box:focus {
            -webkit-box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            -moz-box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
        }

        .package-header {
            padding: 25px 0 20px 0;
            background: #2a3646;
            border-radius: 0px;
        }

        .active .package-header {
            background: #ff3a72;
        }

        .package-header i {
            font-size: 3em;
            margin-bottom: 0.5rem;
            color: rgb(133, 148, 169);
        }

        .active .package-header i {
            color: rgba(255, 255, 255, 0.7);
        }

        .package-header h3 {
            /* text-transform: capitalize; */
            font-family: 'Muli', sans-serif;
            color: #7f90a7;
            font-size: 20px;
            font-weight: 500;
        }

        .active .package-header h3 {
            color: #ffffff;
        }

        .package-info ul {
            padding: 0 15px;
            margin: 0;
        }

        .package-info ul li {
            padding: 14px 0;
            font-size: 15px;
            list-style: none;
        }

        .package-info ul {
            padding: 0;
        }

        .package-info ul li:nth-of-type(2n+1) {
            background-color: #f6f8f9;
        }

        .package-price {
            padding: 20px 0;
        }

        .package-price h2 {
            color: #2a3646;
            font-weight: 600;
            font-size: 80px;
        }

        .active .package-price h2 {
            color: #28b15d;
        }

        .package-price h2 sup {
            font-size: 18px;
            font-weight: 500;
            opacity: 0.7;
            vertical-align: super;
        }

        .package-price h2 sub {
            font-size: 14px;
            font-weight: 500;
            opacity: 0.7;
        }

        button.btn.btn-package {
            background: #ff3a72;
            color: #ffffff;
            font-size: 18px;
            width: 100%;
            padding: 23px 45px;
            border-radius: 0px;
            margin-top: 10px;
            border: none;
            text-transform: capitalize;
        }

        button.btn.btn-package:hover,
        button.btn.btn-package:focus {
            background: #2a3646;
        }
    </style>
@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Abonnement</a></li>
                <li class="active">Ajouter</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    @foreach ($offres as $offre)
                        @include('components.pricing-card', ['offre' => $offre])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.pricing-submit-btn').click(function() {
                Swal.fire({
                    title: 'Confirmation',
                    html: "<span style='font-size: 13px;'>Vous êtes sur le point de souscrire à un abonnement!</span>",
                    icon: 'warning',
                    width: '40%',
                    height: '40%',
                    showCancelButton: true,
                    confirmButtonColor: defaultColor,
                    confirmButtonText: '<span style="font-size: 15px;">Oui, souscrire!</span>',
                    cancelButtonText: '<span style="font-size: 15px;">Annuler</span>',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
