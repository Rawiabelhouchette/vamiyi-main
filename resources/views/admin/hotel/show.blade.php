@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Hôtel</li>
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
                        <h4>Détails de l'hôtel</h4>
                        <a href="{{ route('hotels.edit', $hotel->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>

                                    @include('admin.annonce.annonce-component', ['annonce' => $hotel->annonce])

                                    {{-- Nombre de chambre --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de chambre</td>
                                        <td>{{ $hotel->nombre_chambre }}</td>
                                    </tr>

                                    {{-- Nombre de personne --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de personne</td>
                                        <td>{{ $hotel->nombre_personne }}</td>
                                    </tr>

                                    {{-- Superficie --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Superficie (m²)</td>
                                        <td>{{ $hotel->superficie }}</td>
                                    </tr>

                                    {{-- Prix minimum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix minimum</td>
                                        <td>{{ $hotel->prix_min }}</td>
                                    </tr>

                                    {{-- Prix maximum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix maximum</td>
                                        <td>{{ $hotel->prix_max }}</td>
                                    </tr>

                                    @include('admin.annonce.reference-component', ['annonce' => $hotel->annonce])

                                    @include('admin.annonce.galery-component', ['annonce' => $hotel->annonce])

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.annonce.preview-component', ['annonce' => $hotel->annonce])

    </div>
@endsection
