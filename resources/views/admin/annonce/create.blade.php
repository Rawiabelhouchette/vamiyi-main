@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Annonce</a></li>
                <li class="active">Nouvelle</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            @foreach ($typeAnnonces as $type)
                <div class="col-md-4 col-sm-6">
                    <div class="widget unique-widget">
                        <div class="row">
                            <div class="widget-caption {{ $type->color }}">
                                <div class="col-xs-4 no-pad">
                                    <i class="icon {{ $type->icon }}"></i>
                                </div>
                                <a href="{{ route($type->route) }}">
                                    <div class="col-xs-8">
                                        <div class="widget-detail">
                                            <h3>{{ $type->nom }}</h3>
                                            <span>{{ $type->nom }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
