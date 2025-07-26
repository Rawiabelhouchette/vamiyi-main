@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Fast-Food</li>
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
                        <h4>Détails de l'annonce</h4>
                        <a href="{{ route('fast-foods.edit', $fastFood->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>

                                    @include('admin.annonce.annonce-component', ['annonce' => $fastFood->annonce])

                                    {{-- Prix minimum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix minimum</td>
                                        <td>{{ $fastFood->prix_min }}</td>
                                    </tr>

                                    {{-- Prix maximum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix maximum</td>
                                        <td>{{ $fastFood->prix_max }}</td>
                                    </tr>

                                    @include('admin.annonce.reference-component', ['annonce' => $fastFood->annonce])

                                    @include('admin.annonce.galery-component', ['annonce' => $fastFood->annonce])

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.annonce.preview-component', ['annonce' => $fastFood->annonce])

    </div>
@endsection
