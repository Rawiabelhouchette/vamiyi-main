@extends('layout.admin.app')

@section('dashboard', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px; margin-bottom: 10px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li class="active"><a href="#">Tableau de bord</a></li>
            </ol>
        </div>
    </div>
    <div class="mrg-top-0 padd-top-0" id="page-inner" style="margin-top: 0px !important; padding-top: 0px !important;">
        <div class="bott-wid mrg-top-20">
            {{-- <div class="listing-shot mrg-bot-20">
                <div class="listing-shot-info">
                    <span class="text-center font-16 text-justify">
                        Bonjour {{ auth()->user()->username }}, bienvenue sur votre tableau de bord. Retrouvez ici les statistiques sur le nombre d'élèments crées et les taux de consultation de la recherche et connexion
                    </span>
                </div>
            </div> --}}
            @foreach ($elements as $element)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="listing-shot grid-style">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($element['lien'] != '')
                                    <a href="{{ $element['lien'] }}">
                                        <i class="{{ $element['icon'] }}"></i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)">
                                        <i class="{{ $element['icon'] }}"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                        <div class="listing-shot-info">
                            <div class="extra">
                                <div class="listing-detail-info">
                                    <a class="" href="{{ $element['lien'] ?? 'javascript:void(0)' }}">
                                        <span>
                                            {{ $element['nom'] }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <h5 id="{{ $element['id'] }}">{!! $element['nombre'] !!}</h5>
                            </div>
                        </div>
                        {{-- <div class="listing-shot-info rating">
                            <div class="row">
                                <a class="" href="#">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        Voir le detail &nbsp;&nbsp;
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                    </div>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- <input type="hidden" id="metaData" data-connexion="{{ route('staff.active-users.get')}}" data-consultation="{{ route('staff.consultation.get')}}"> --}}
@endsection

@section('js')
    <script>
        // $(document).ready(function() {
        //     setInterval(function() {
        //         // Active users
        //         $.ajax({
        //             url: $('#metaData').data('connexion'),
        //             type: "GET",
        //             success: function(data) {
        //                 $('#connexions').html(data);
        //             }
        //         });

        //         // Consultations
        //         $.ajax({
        //             url: $('#metaData').data('consultation'),
        //             type: "GET",
        //             success: function(data) {
        //                 $('#consultations').html(data);
        //             }
        //         });
        //     }, 10000);
        // } );
    </script>
@endsection
