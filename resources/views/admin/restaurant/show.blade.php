@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Restaurant</li>
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
                        <h4>Détails du restaurant</h4>
                        <a class="btn theme-btn text-right" type="button" href="{{ route('restaurants.edit', $restaurant->id) }}">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>

                                    @include('admin.annonce.annonce-component', ['annonce' => $restaurant->annonce])

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Entrée</td>
                                        <td>
                                            <table class="text-center table table-bordered table-striped table-hover table-reponsive" style="width: 100%;">
                                                <tr>
                                                    <td></td>
                                                    <td>Nom</td>
                                                    <td>Ingrédients</td>
                                                    <td>Prix minimum</td>
                                                    <td>Prix maximum</td>
                                                </tr>
                                                @forelse ($restaurant->entrees as $entree)
                                                    <tr>
                                                        <td>
                                                            <strong class="">{{ $loop->iteration }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $entree['nom'] }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $entree['ingredients'] }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $entree['prix_min'] }} FCFA</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $entree['prix_max'] }} FCFA</strong>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">
                                                            Aucune information disponible
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Plat</td>
                                        <td>
                                            <table class="text-center table table-bordered table-striped table-hover table-reponsive" style="width: 100%;">
                                                <tr>
                                                    <td></td>
                                                    <td>Nom</td>
                                                    <td>Ingrédients</td>
                                                    <td>Accompagnements</td>
                                                    <td>Prix minimum</td>
                                                    <td>Prix maximum</td>
                                                </tr>
                                                @forelse ($restaurant->plats as $plat)
                                                    <tr>
                                                        <td>
                                                            <strong class="">{{ $loop->iteration }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $plat['nom'] }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $plat['ingredients'] }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $plat['accompagnements'] }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $plat['prix_min'] }} FCFA</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $plat['prix_max'] }} FCFA</strong>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">
                                                            Aucune information disponible
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Dessert</td>
                                        <td>
                                            <table class="text-center table table-bordered table-striped table-hover table-reponsive" style="width: 100%;">
                                                <tr>
                                                    <td></td>
                                                    <td>Nom</td>
                                                    <td>Ingrédients</td>
                                                    <td>Prix minimum</td>
                                                    <td>Prix maximum</td>
                                                </tr>
                                                @forelse ($restaurant->desserts as $dessert)
                                                    <tr>
                                                        <td>
                                                            <strong class="">{{ $loop->iteration }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $dessert['nom'] }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $dessert['ingredients'] }}</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $dessert['prix_min'] }} FCFA</strong>
                                                        </td>
                                                        <td>
                                                            <strong class="theme-cl">{{ $dessert['prix_max'] }} FCFA</strong>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">
                                                            Aucune information disponible
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </td>
                                    </tr>

                                    @include('admin.annonce.reference-component', ['annonce' => $restaurant->annonce])

                                    @include('admin.annonce.galery-component', ['annonce' => $restaurant->annonce])

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.annonce.preview-component', ['annonce' => $restaurant->annonce])

    </div>
@endsection
