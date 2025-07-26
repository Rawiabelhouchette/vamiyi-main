@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Auberge</li>
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
                        <h4>Détails de l'auberge</h4>
                        <a href="{{ route('auberges.edit', $auberge->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>

                                    @include('admin.annonce.annonce-component', ['annonce' => $auberge->annonce])

                                    {{-- Nombre de chambre --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de chambre</td>
                                        <td>{{ $auberge->nombre_chambre }}</td>
                                    </tr>

                                    {{-- Nombre de personne --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de personne</td>
                                        <td>{{ $auberge->nombre_personne }}</td>
                                    </tr>

                                    {{-- Superficie --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Superficie (m²)</td>
                                        <td>{{ $auberge->superficie }}</td>
                                    </tr>

                                    {{-- Prix minimum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix minimum</td>
                                        <td>{{ $auberge->prix_min }}</td>
                                    </tr>

                                    {{-- Prix maximum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix maximum</td>
                                        <td>{{ $auberge->prix_max }}</td>
                                    </tr>

                                    @include('admin.annonce.reference-component', ['annonce' => $auberge->annonce])

                                    @include('admin.annonce.galery-component', ['annonce' => $auberge->annonce])

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.annonce.preview-component', ['annonce' => $auberge->annonce])

    </div>
@endsection
