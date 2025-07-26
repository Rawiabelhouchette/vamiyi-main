@extends('layout.admin.app')

@section('entreprise', 'active')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Entreprise</a></li>
                <li class="active">Détails</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Détails de l'entreprise</h4>
                        <a href="{{ route('entreprises.edit', $entreprise->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>
                                    {{-- nom --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">NOM</td>
                                        <td>{{ $entreprise->nom }}</td>
                                    </tr>

                                    {{-- Description --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">DESCRIPTION</td>
                                        <td>{{ $entreprise->description }}</td>
                                    </tr>

                                    {{-- Téléphone --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">TELEPHONE</td>
                                        <td>{{ $entreprise->telephone }}</td>
                                    </tr>

                                    {{-- Email --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">EMAIL</td>
                                        <td>{{ $entreprise->email }}</td>
                                    </tr>

                                    {{-- WhatsApp --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">WHATSAPP</td>
                                        <td>{{ $entreprise->whatsapp }}</td>
                                    </tr>

                                    {{-- Facebook --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">FACEBOOK</td>
                                        <td>
                                            <a href="{{ $entreprise->facebook ?? 'javascript:void(0)' }}" target="_blank">{{ $entreprise->facebook ?? '-' }}</a>
                                        </td>
                                    </tr>

                                    {{-- Twitter --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">TWITTER</td>
                                        <td>
                                            <a href="{{ $entreprise->twitter ?? 'javascript:void(0)' }}" target="_blank">{{ $entreprise->twitter ?? '-' }}</a>
                                        </td>
                                    </tr>

                                    {{-- Instagram --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">INSTAGRAM</td>
                                        <td>
                                            <a href="{{ $entreprise->instagram ?? 'javascript:void(0)' }}" target="_blank">{{ $entreprise->instagram ?? '-' }}</a>
                                        </td>
                                    </tr>

                                    {{-- Site web --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">SITE WEB</td>
                                        <td>
                                            <a href="{{ $entreprise->site_web ?? 'javascript:void(0)' }}" target="_blank">{{ $entreprise->site_web ?? '-' }}</a>
                                        </td>
                                    </tr>

                                    {{-- Pays --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">PAYS</td>
                                        <td>{{ $entreprise->quartier->ville->pays->nom ?? '-' }}</td>
                                    </tr>

                                    {{-- Ville --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">VILLE</td>
                                        <td>{{ $entreprise->quartier->ville->nom ?? '-' }}</td>
                                    </tr>

                                    {{-- Quartier --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">QUARTIER</td>
                                        <td>{{ $entreprise->quartier->nom ?? '-' }}</td>
                                    </tr>

                                    {{-- Heure d'ouverture --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">HEURE D'OUVERTURE</td>
                                        <td>
                                            @foreach ($entreprise->heure_ouverture as $ouverture)
                                                {{ $ouverture->jour }} : {{ $ouverture->heure_debut }} - {{ $ouverture->heure_fin }}<br>
                                            @endforeach
                                        </td>
                                    </tr>

                                    {{-- Longitude & latitude --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">LOCALISATION</td>
                                        <td>Longitude : {{ $entreprise->longitude }} - Latitude : {{ $entreprise->latitude }}</td>
                                    </tr>

                                    {{-- Localisation --}}
                                    <tr>
                                        <td colspan="2">
                                            <div id="map" style="width: 100%; height: 400px; z-index: 1;"></div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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
