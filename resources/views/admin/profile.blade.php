@extends('layout.admin.app')

@section('profil', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Mon Profil</a></li>
            </ol>
        </div>
    </div>

    <div id="page-inner">
        @livewire('admin.profile')
    </div>
@endsection
