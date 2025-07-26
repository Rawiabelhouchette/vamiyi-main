@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Location véhicule</li>
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
                        <h4>Détails d'un location de véhicule</h4>
                        <a href="{{ route('location-vehicules.edit', $locationVehicule->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>

                                    @include('admin.annonce.annonce-component', ['annonce' => $locationVehicule->annonce])

                                    {{-- marque --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Marque</td>
                                        <td>{{ $locationVehicule->marque }}</td>
                                    </tr>

                                    {{-- modele --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Modèle</td>
                                        <td>{{ $locationVehicule->modele }}</td>
                                    </tr>

                                    {{-- annee --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Année</td>
                                        <td>{{ $locationVehicule->annee }}</td>
                                    </tr>

                                    {{-- kilometrage --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Kilométrage (km)</td>
                                        <td>{{ $locationVehicule->kilometrage }}</td>
                                    </tr>

                                    {{-- carburant --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Carburant</td>
                                        <td>{{ $locationVehicule->carburant }}</td>
                                    </tr>

                                    {{-- boite_vitesse --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Boite de vitesse</td>
                                        <td>{{ $locationVehicule->boite_vitesse }}</td>
                                    </tr>

                                    {{-- nombre de porte --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de porte</td>
                                        <td>{{ $locationVehicule->nombre_portes }}</td>
                                    </tr>

                                    {{-- nombre de places --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de places</td>
                                        <td>{{ $locationVehicule->nombre_places }}</td>
                                    </tr>

                                    @include('admin.annonce.reference-component', ['annonce' => $locationVehicule->annonce])

                                    @include('admin.annonce.galery-component', ['annonce' => $locationVehicule->annonce])

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.annonce.preview-component', ['annonce' => $locationVehicule->annonce])

    </div>
@endsection
