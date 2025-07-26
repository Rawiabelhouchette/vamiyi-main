@extends('layout.public.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <!-- ================ Listing Detail Basic Information ======================= -->
    <section class="detail-section" style="background:url({{ asset('assets_client/img/company_display.jpg') }})" data-overlay="6">
        <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
        <div class="profile-cover-content">
            <div class="container">
                <div class="center">
                    <h3 style="color: white;">Détail d'une entreprise</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <!-- ================ Listing Detail Full Information ======================= -->
    <section class="list-detail">
        <div class="container">
            <div class="row">
                <!-- Start: Listing Detail Wrapper -->
                <div class="col-md-8 col-sm-8">
                    <div class="detail-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">
                                <h3> {{ $entreprise->nom }} <span class="mrg-l-5 category-tag">{{ $entreprise->quartier->ville->pays->nom }}</span></h3>
                                <div>
                                    <a href="javascript:void(0)" class="listing-address">
                                        <i class="ti-location-pin mrg-r-5"></i>
                                        {{ $entreprise->adresse_complete }}
                                    </a>
                                    <br>
                                    @if ($entreprise->telephone)
                                        <a href="tel:{{ $entreprise->telephone }}">
                                            <i class="ti-mobile"></i>&nbsp;
                                            {{ $entreprise->telephone }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->email)
                                        <a href="mailto:{{ $entreprise->email }}">
                                            <i class="ti-email"></i>&nbsp;
                                            {{ $entreprise->email }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->whatsapp)
                                        <a href="https://api.whatsapp.com/send?phone={{ $entreprise->quartier->ville->pays->indicatif }}{{ str_replace(' ', '', $entreprise->whatsapp) }}" target="_blank">
                                            <i class="fa-brands fa-whatsapp"></i>&nbsp;
                                            {{ $entreprise->whatsapp }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->instagram)
                                        <a href="https://www.instagram.com/{{ $entreprise->instagram }}" target="_blank">
                                            <i class="fa-brands fa-instagram"></i>&nbsp;
                                            {{ $entreprise->instagram }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->facebook)
                                        <a href="https://www.facebook.com/{{ $entreprise->facebook }}" target="_blank">
                                            <i class="fa-brands fa-facebook"></i>&nbsp;
                                            {{ $entreprise->facebook }}
                                        </a>
                                        <br>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="detail-wrapper">
                        <div class="detail-wrapper-header">
                            <h4>Description</h4>
                        </div>
                        <div class="detail-wrapper-body">
                            @if ($entreprise->description)
                                <p>{{ $entreprise->description }}</p>
                            @else
                                <p>Aucune description n'est disponible pour cette entreprise.</p>
                            @endif
                        </div>
                    </div>

                    <div class="detail-wrapper">
                        <div class="detail-wrapper-header">
                            <h4>Localisation</h4>
                        </div>
                        <div class="detail-wrapper-body">
                            <div id="map" class="full-width" style="height:400px;"></div>
                        </div>
                    </div>
                </div>
                <!-- End: Listing Detail Wrapper -->

                <!-- Sidebar Start -->
                <div class="col-md-4 col-sm-12">
                    <div class="sidebar">

                        <!-- Start: Opening hour -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-time padd-r-10"></i>Heures d'ouverture</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="side-list">
                                    <ul>
                                        @foreach ($entreprise->heure_ouvertures as $key => $ouverture)
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

                        <!-- Start: Listing Gallery -->
                        {{-- <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-gallery padd-r-10"></i>Image</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="side-list no-border gallery-box">
                                    <ul class="gallery-list-unique">
                                        <li>
                                            <a data-fancybox="gallery" href="http://via.placeholder.com/1200x850">
                                                <img src="http://via.placeholder.com/100x80" class="img-responsive" alt="" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End: Listing Gallery -->

                        <!-- Start: Latest Listing -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-check-box padd-r-10"></i>Derniéres annonces</h4>
                            </div>
                            <div class="widget-boxed-body padd-top-5">
                                <div class="side-list">
                                    <ul class="listing-list">
                                        @foreach ($annonces as $annonce)
                                            <li>
                                                <a href="{{ route('show', $annonce->slug) }}" title="Listing">
                                                    <div class="listing-list-img">
                                                        @if ($annonce->image)
                                                            <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" class="img-responsive" alt="">
                                                        @else
                                                            <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                                        @endif
                                                    </div>
                                                </a>
                                                <div class="listing-list-info">
                                                    <h5><a href="{{ route('show', $annonce->slug) }}" title="Listing">{{ $annonce->titre }}</a></h5>
                                                    <div class="listing-post-meta">
                                                        <span class="updated">{{ date('d-m-Y', strtotime($annonce->created_at)) }}</span> | <a href="{{ route('entreprise.show', $annonce->entreprise->slug) }}" rel="tag">{{ $annonce->type }}</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        @empty($annonces)
                                            <p>
                                                Aucune annonce n'est disponible pour cette entreprise.
                                            </p>
                                        @endempty
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End: Latest Listing -->
                    </div>
                </div>
                <!-- End: Sidebar Start -->
            </div>
        </div>
    </section>
    <!-- ================ Listing Detail Full Information ======================= -->
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var mymap = L.map('map').setView([8.6195, 0.8248], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(mymap);

        var marker;

        var lon = {{ $entreprise->longitude }};
        var lat = {{ $entreprise->latitude }};
        if (marker) {
            mymap.removeLayer(marker);
        }

        marker = L.marker([lat, lon]).addTo(mymap);
        mymap.setView([lat, lon], 12);
    </script>
@endsection
