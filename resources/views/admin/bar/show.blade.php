@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Bar & Rooftop</li>
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
                        <h4>Détails du bar & Rooftop</h4>
                        <a href="{{ route('bars.edit', $bar->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>

                                    @include('admin.annonce.annonce-component', ['annonce' => $bar->annonce])

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Type de bar</td>
                                        <td>{{ $bar->type_bar ?? '-'}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Type de musique</td>
                                        <td>{{ $bar->type_musique ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Capacité d'accueil</td>
                                        <td>{{ $bar->capacite_accueil ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix minimum</td>
                                        <td>{{ $bar->prix_min }}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix maximum</td>
                                        <td>{{ $bar->prix_max }}</td>
                                    </tr>

                                    @include('admin.annonce.reference-component', ['annonce' => $bar->annonce])

                                    @include('admin.annonce.galery-component', ['annonce' => $bar->annonce])

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.annonce.preview-component', ['annonce' => $bar->annonce])

    </div>
@endsection
