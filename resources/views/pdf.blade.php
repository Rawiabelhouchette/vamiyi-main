
{{-- @section('content_class') --}}

@section('css')
    <!-- Common Style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="wrapper">
        <!-- Start Navigation -->
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <!-- ================ Start Page Title ======================= -->

        <section class="title-transparent page-title" style="background-image:url(/assets_client/img/bibioteque_1200x680_bibl.jpg);" data-overlay="8" style="padding-bottom: 0px;">
            <div class="container">
                <div class="banner-caption">
                    <div class="col-md-12 col-sm-12 banner-text">

                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="clearfix"></div>
    <!-- ================ End Page Title ======================= -->

    <!-- ================ Listing In Vertical style with Sidebar ======================= -->
    <section class="show-case">
        <div class="container">
            <div class="row">
                <!-- Start Sidebar -->

                <!-- End Start Sidebar -->
                <div class="col-md-8 col-sm-12">
                    <div class="card">

                        <div class="card-body" style="padding-right: 0px;">
                            <div class="table-responsive">
                                <table class="" id="datatable">
                                    <style>
                                        .custom-checkbox-1 input[type="checkbox"]:checked+label:after {
                                            left: 11px;
                                        }

                                        .custom-checkbox-2 input[type="checkbox"]:checked+label:after {
                                            top: 5px;
                                        }

                                        .facette-color {
                                            background-color: #DFF3FE;
                                        }
                                    </style>
                                    <tbody id="filtered-results">
                                        <h1>faaaaaaaaaaaaa</h1>
                                        {{-- @foreach ($data as $document)
                                            <tr id="row-{{ $document->id }}">
                                                <td style="background-color: white; padding: 0px;" data-titre="{{ $document->titre }}" data-auteur="{{ $document->auteur }}" data-date="{{ $document->memoire->date_soutenance }}">
                                                    <div class="verticleilist listing-shot facette-color" style="margin: 0px; margin-bottom: 15px; border-color: #BDD8DC;">
                                                        <a class="listing-item" href="{{ route('detailMemoire', ['id' => $document->id]) }}">
                                                            <div class="listing-shot-img">
                                                                @if ($document->image_id)
                                                                    <img src="{{ asset($document->image->chemin) }}" width="200" height="200" class="img-responsive" height="90%" alt="">
                                                                @else
                                                                    <img src="http://via.placeholder.com/800x850" class="img-responsive" height="90%" alt="">
                                                                @endif
                                                            </div>
                                                        </a>
                                                        <div class="verticle-listing-caption">
                                                            <div class="listing-shot-caption">
                                                                <a href="{{ route('detailMemoire', ['id' => $document->id]) }}">
                                                                    <h4>{{ $document->titre }}</h4>
                                                                </a>
                                                                <span>
                                                                    <strong>Par </strong>: {{ $document->auteur }}
                                                                </span>
                                                            </div>
                                                            <div class="listing-shot-info">
                                                                <div class="row extra">
                                                                    <div class="col-md-12">
                                                                        <div class="listing-detail-info">
                                                                            <span style="font-weight: bold;">
                                                                                @if ($document->memoire->niveau_etude)
                                                                                    {{ $document->memoire->ref_niveau_etude->valeur }}
                                                                                @endif
                                                                            </span>
                                                                            <span>
                                                                                <p class="listing-description">
                                                                                    {{ substr($document->resume, 0, 100) }}...
                                                                                </p>
                                                                            </span>
                                                                            <span>
                                                                                @if ($document->type == 'Mémoire')
                                                                                    <strong>Date de soutenance</strong>: {{ date('d/m/Y', strtotime($document->memoire->date_soutenance)) }}
                                                                                @endif
                                                                            </span>
                                                                            <span>
                                                                                <strong>Sujet</strong>:
                                                                                @foreach ($document->ref_sujet as $sujet)
                                                                                    {{ $sujet->sujet->valeur }} ,
                                                                                @endforeach
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle; padding: 0px;">
                                                    <span class="custom-checkbox custom-checkbox-1" style="width: 5px; margin: 0px;">
                                                        <input type="checkbox" class="checkbox_table text-right" name="options[]" value="1" style=" margin-left: 5px;">
                                                        <label class="text-center" for="checkbox1" style="margin: 0px; margin-left: 5px;"></label>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach--}}

                                       {{--  @if ($data == [])
                                            <h5 class="text-center">Aucun résultat trouvé</h5>
                                        @endif --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- <div class="col-md-6">
                    {{ $documents->appends(['type_document' => $type, 'mot_cle' => $cle])->links(null, ['onEachSide' => 1, 'paginatorRange' => 2]) }}
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ================ End Listing In Vertical style with Sidebar ======================= -->

    </div>
@endsection

