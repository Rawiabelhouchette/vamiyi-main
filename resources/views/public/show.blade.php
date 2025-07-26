@extends('layout.public.app')

@section('css')
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    @include('components.default-value')

    @php
        $defaultColor = '#ff3a72';
    @endphp

    <style>
        .social-network {
            color: #fff;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
            padding: 6px 15px;
            border-radius: 4px;
            margin-right: 3px;
            margin-bottom: 15px;
            border: 1px solid transparent;
        }

        .social-network:hover {
            color: #fff;
        }

        .social-network:visited {
            color: #fff;
        }

        .li-btn {
            background: white;
            color: grey;
            border: 1px solid grey;
            border-radius: 4px;
            -webkit-user-select: none;
        }

        .li-btn.view:hover {
            color: gray;
        }

        .li-btn:hover {
            color: {{ $defaultColor }};
        }

        .share-button:hover {
            background: {{ $defaultColor }} !important;
            color: white !important;
            border: 1px solid {{ $defaultColor }} !important;
            border-radius: 4px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse {
            animation: pulse 1s infinite;
        }

        /* if not mobile */
        @media (min-width: 768px) {
            #banner-alt {
                min-height: 320px !important;
                height: 320px !important;
                /* min-height: 10% !important; */
                /* height: 10% !important; */
            }
        }

        @media (max-width: 768px) {
            .nav-div {
                text-align: center !important;
            }

            .nav-div-1 {
                padding-bottom: 20px !important;
            }
        }
    </style>

    <!-- ================ Listing Detail Basic Information ======================= -->
    <div class="banner dark-opacity" id="banner-alt" data-overlay="8" style="background-image:url({{ asset('storage/' . $annonce->imagePrincipale->chemin) }});">
        <div class="container">
            <div class="banner-caption">
                <form class="form-verticle" method="GET" action="{{ route('search') }}">
                    <input name="form_request" type="hidden" value="1">
                    <div class="col-md-4 col-sm-4 no-padd">
                        <i class="banner-icon icon-pencil"></i>
                        <input class="form-control left-radius right-br" name="key" type="text" placeholder="Mot clé...">
                    </div>
                    <div class="col-md-3 col-sm-3 no-padd">
                        <div class="form-box">
                            <i class="banner-icon icon-map-pin"></i>
                            <input class="form-control right-br" id="myInput" name="location" type="text" placeholder="Localisation...">
                            <div class="autocomplete-items" id="autocomplete-results"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 no-padd">
                        <div class="form-box">
                            <i class="banner-icon icon-layers"></i>
                            <select class="form-control" name="type[]">
                                <option class="chosen-select" data-placeholder="{{ __('Tous les types d\'annonce') }}" value="" selected>{{ __('Tous les type d\'annonce') }}</option>
                                @foreach ($typeAnnonce as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-3 no-padd">
                        <div class="form-box">
                            <button class="btn theme-btn btn-default" type="submit">
                                {{-- <i class="ti-search"></i> --}}
                                {{ __('Rechercher') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <!-- ================ Listing Detail Full Information ======================= -->
    <section class="list-detail padd-bot-10 padd-top-30">
        <div class="container">
            <div class="row mrg-bot-40">
                <div class="col-md-6 col-sm-12 nav-div nav-div-1">
                    <h5>
                        <a href="{{ route('search') }}" title="Revenir à la recherche">
                            <i class="fa fa-fw fa-arrow-left" aria-hidden="true"></i>
                            Revenir à la recherche
                        </a>
                    </h5>
                </div>
                <div class="col-md-6 col-sm-12 nav-div" style="text-align: right">
                    <h5>
                        <a class="" href="{{ $pagination->previous }}">
                            <i class="fa fa-fw fa-angle-left"></i>
                            Précédent
                        </a>
                        <span class="padd-l-10 padd-r-10 theme-cl">
                            {{ $pagination->position }}
                        </span>
                        <a class="" href="{{ $pagination->next }}">
                            Suivant
                            <i class="fa fa-fw fa-angle-right"></i>
                        </a>
                    </h5>
                </div>
            </div>

            <div class="row">
                <!-- Start: Listing Detail Wrapper -->
                <div class="col-md-8 col-sm-8">
                    <div class="detail-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">
                                {{-- <h3> {{ $annonce->entreprise->nom }} <span class="mrg-l-5 category-tag">{{ $annonce->type }}</span></h3> --}}
                                <h3> {{ $annonce->titre }} <span class="mrg-l-5 category-tag">{{ $annonce->type }}</span></h3>
                                <div>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-building fa-lg" style="color: #ff3a72;"></i>&nbsp;&nbsp;
                                        {{ $annonce->entreprise->nom }}
                                    </a><br>
                                    @if ($annonce->entreprise->site_web)
                                        <a href="{{ $annonce->entreprise->site_web }}" target="_blank">
                                            <i class="ti-world" style="color: #ff3a72;"></i>&nbsp;
                                            {{ $annonce->entreprise->site_web }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($annonce->entreprise->email)
                                        {{-- <a href="mailto:{{ $annonce->entreprise->email }}"> --}}
                                        <a href="javascript:void(0)">
                                            <i class="ti-email" style="color: #ff3a72;"></i>&nbsp;
                                            {{ $annonce->entreprise->email }}
                                        </a>
                                        <br>
                                    @endif

                                    <div class="cover-buttons mrg-top-15" style="float: left;">
                                        <ul>
                                            <li class="mrg-r-10" style="padding-left: 0;">
                                                <span class="buttons li-btn view padd-10">
                                                    <i class="fa fa-eye hidden-xs"></i>
                                                    <span class="">{{ $annonce->view_count }} vue(s)</span>
                                                </span>
                                            </li>
                                            <li class="mrg-r-10" style="padding-left: 0;">
                                                <span class="buttons li-btn view padd-10">
                                                    <i class="fa fa-comment-o hidden-xs"></i>
                                                    <span class="" id="annonce-commentaire">{{ $annonce->comment_count }}</span> commentaire(s)
                                                </span>
                                            </li>
                                            <li class="mrg-r-10" style="padding-left: 0;">
                                                <div class="inside-rating buttons listing-rating theme-btn button-plain" style="padd-0 !important; line-height: 0.5; -webkit-user-select: none;">
                                                    <span class="value" id="annonce-note">{{ $annonce->note }}</span> <sup class="out-of">/ 5</sup>
                                                </div>
                                            </li>
                                            <li class="mrg-r-10" style="padding-left: 0;">
                                                @livewire('public.favoris', [$annonce])
                                            </li>
                                            <li class="mrg-r-10" style="padding-left: 0;">
                                                <button class="buttons padd-10 share-button" data-toggle="modal" data-target="#share" style="background: white; border: 1px solid grey; color: grey;">
                                                    <i class="fa fa-share"></i>
                                                    <span class="hidden-xs">Partager</span>
                                                </button>
                                            </li>
                                            <br><br>
                                            @if ($annonce->entreprise->instagram)
                                                <li style="padding-left: 0; padding-right: 5px;">
                                                    <a class="social-network" href="{{ $annonce->entreprise->instagram }}" style="background-color: #FF3A72" target="_blank"><i class="fa-brands fa-instagram" style="font-size: 17px;"></i> &nbsp;Instagram</a>
                                                </li>
                                            @endif
                                            @if ($annonce->entreprise->facebook)
                                                <li style="padding-left: 0; padding-right: 5px;">
                                                    <a class="social-network" href="{{ $annonce->entreprise->facebook }}" style="background-color: #0866FF" target="_blank"><i class="fa-brands fa-facebook" style="font-size: 17px;"></i> &nbsp;Facebook</a>
                                                </li>
                                            @endif
                                            @if ($annonce->entreprise->whatsapp)
                                                <li style="padding-left: 0; padding-right: 5px;">
                                                    <a class="social-network" href="https://wa.me/{{ $annonce->entreprise->quartier->ville->pays->indicatif ?? '' }}{{ str_replace(' ', '', $annonce->entreprise->whatsapp) }}" style="background-color: #00A884" target="_blank"><i class="fa-brands fa-whatsapp" style="font-size: 17px;"></i> &nbsp;Whatsapp</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start: Listing Gallery -->
                    <div class="widget-boxed padd-bot-10">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-gallery padd-r-10"></i>Galérie</h4>
                        </div>
                        <div class="widget-boxed-body padd-top-0">
                            <div class="side-list no-border gallery-box">
                                <div class="row mrg-l-5 mrg-r-10 mrg-bot-5">
                                    <div class="col-xs-12 col-md-12 padd-0 image-preview" data-toggle="modal" data-id="{{ $annonce->imagePrincipale->id }}" data-target="#modal-gallery" style="margin-bottom: -20px !important; margin-top: -10px !important; padding-left : 3px; padding-right : 3px;">
                                        <div class="listing-shot grid-style">
                                            <div class="" style="display: flex; justify-content: center; align-items: center; height: 220px; background:url({{ asset('storage/' . $annonce->imagePrincipale->chemin) }}); background-size: cover; background-position: center;">
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($annonce->galerie as $key => $image)
                                        @if ($key < 3)
                                            <div class="col-xs-12 col-md-3 padd-0 padd-3 image-preview" data-toggle="modal" data-id="{{ $image->id }}" data-target="#modal-gallery">
                                                <div class="listing-shot grid-style">
                                                    <div class="" style="display: flex; justify-content: center; align-items: center; height: 120px; background:url({{ asset('storage/' . $image->chemin) }}); background-size: cover; background-position: center;">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($key == 3)
                                            <div class="col-xs-12 col-md-3 padd-0 padd-3 image-preview" data-toggle="modal" data-id="{{ $image->id }}" data-target="#modal-gallery">
                                                <div class="listing-shot grid-style">
                                                    <div style="position: relative; display: flex; justify-content: center; align-items: center; height: 120px; background:url({{ asset('storage/' . $image->chemin) }}); background-size: cover; background-position: center;">
                                                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
                                                            {{-- <div class="" style="display: flex; justify-content: center; align-items: center; height: 120px; background:url({{ asset('storage/' . $image->chemin) }}); background-size: cover; background-position: center;"> --}}
                                                            <div style="color: white; font-size: 20px;">
                                                                +{{ count($annonce->galerie) - 4 }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                        @break
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Listing Gallery -->

                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4><i class="ti-info-alt padd-r-10"></i>Description
                        </h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <p>
                            {{ $annonce->description ?? 'Aucune description disponible' }}
                        </p>
                    </div>
                </div>

                <div class="tab style-1 mrg-bot-40" role="tabpanel">
                    <!-- Nav tabs -->
                    {{-- <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#information" aria-controls="information" role="tab" data-toggle="tab">Information</a></li>
                        <li role="presentation"><a href="#equipement" aria-controls="equipement" role="tab" data-toggle="tab">Equipements</a></li>
                    </ul> --}}
                    {{-- @include('components.public.show.information-header') --}}
                    {{ $annonce->annonceable->getShowInformationHeader() }}

                    <!-- Tab panes -->
                    {{-- <div class="tab-content tabs">
                        <div role="tabpanel" class="tab-pane fade in active" id="information">
                            {{ $annonce->annonceable->caracteristiques }}
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="equipement">
                            @forelse ($annonce->referenceDisplay() as $key => $value)
                                @if (count($value) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong class="" style="text-transform: uppercase;">{{ $key }}</strong>
                                        </div>
                                        <div class="detail-wrapper-body padd-bot-10">
                                            <ul class="detail-check">
                                                @forelse ($value as $equipement)
                                                    <div class="col-xs-12 col-md-4 padd-l-0">
                                                        <li style="width: 100%;">{{ $equipement }}</li>
                                                    </div>
                                                @empty
                                                    <span class="text-center">
                                                        Aucun équipement disponible
                                                    </span>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="col-md-12">
                                    Aucun équipement disponible
                                </div>
                            @endforelse
                        </div>
                    </div> --}}
                    {{-- @include('components.public.show.information-body', ['annonce' => $annonce]) --}}
                    {{ $annonce->annonceable->getShowInformationBody() }}
                </div>

                @livewire('public.comment', [$annonce])

            </div>
            <!-- End: Listing Detail Wrapper -->

            <!-- Sidebar Start -->
            <div class="col-md-4 col-sm-12">
                <div class="sidebar">
                    <!-- Start: Listing Location -->
                    <div class="widget-boxed padd-bot-10">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-location-pin padd-r-10"></i>Localisation</h4>
                        </div>
                        <div class="widget-boxed-body padd-top-5">
                            <div class="side-list no-border">
                                <ul>
                                    <li>Pays : <strong>{{ $annonce->entreprise->quartier->ville->pays->nom ?? '-' }} </strong></li>
                                    <li>Ville : <strong>{{ $annonce->entreprise->quartier->ville->nom ?? '-' }} </strong></li>
                                    <li>Quartier : <strong>{{ $annonce->entreprise->quartier->nom ?? '-' }} </strong></li>
                                    <li>
                                        <div class="full-width" id="map" style="height:200px;"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End: Listing Location -->

                    <!-- Start: Opening hour -->
                    <div class="widget-boxed padd-bot-10">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-time padd-r-10"></i>Heures d'ouverture</h4>
                        </div>
                        <div class="widget-boxed-body">
                            <div class="side-list">
                                <ul>
                                    @foreach ($annonce->entreprise->heure_ouvertures as $key => $ouverture)
                                        @if ($ouverture == 'Fermé')
                                            <li>{{ $key }} <span class="text-danger">{{ $ouverture }}</span></li>
                                        @else
                                            <li>{{ $key }} <span>{{ $ouverture }}</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End: Opening hour -->
                </div>
            </div>
            <!-- End: Sidebar Start -->
        </div>
    </div>

</section>
<!-- ================ Listing Detail Full Information ======================= -->

@include('public.gallery', [
    'galerie' => $annonce->galerie,
    'couverture' => $annonce->imagePrincipale,
])

@include('components.public.share-modal-alt', [
    'title' => 'Partager cette annonce',
    'annonce' => $annonce,
])
@endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    var mymap = L.map('map').setView([8.6195, 0.8248], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(mymap);

    var marker;

    var lon = {{ $annonce->entreprise->longitude }};
    var lat = {{ $annonce->entreprise->latitude }};
    if (marker) {
        mymap.removeLayer(marker);
    }

    marker = L.marker([lat, lon]).addTo(mymap);
    mymap.setView([lat, lon], 12);
</script>

<script>
    $(document).ready(function() {
        $('.image-preview').click(function() {
            $('#share').hide();
            var id = $(this).data('id');
            $('#image-' + id).addClass('pulse');
            setTimeout(() => {
                $('#image-' + id).removeClass('pulse');
            }, 2000);
        });
    });
</script>
@endsection
