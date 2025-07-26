@extends('layout.admin.app')

@section('comment', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Mes commentaires</a></li>
            </ol>
        </div>
    </div>

    <div id="page-inner">
        @livewire('admin.comment')
    </div>
@endsection
