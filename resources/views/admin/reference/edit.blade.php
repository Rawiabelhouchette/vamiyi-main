@extends('layout.admin.app')

@section('reference', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Référence</a></li>
                <li class="active">Modifier une référence</li>
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
                        <h4>Modifier une Référence</h4>
                    </div>

                    <div class="card-body">
                        <br>
                        <form class="form-horizontal" action="{{ route('references.update', $reference_valeur->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <label class="col-md-2 col-sm-3">Type : </label>
                                        <div class="col-md-8 col-sm-9">
                                            <select id="type" class="form-control" name="type" required>
                                                <option value="{{ $reference_valeur->reference->type }}" selected>{{ $reference_valeur->reference->type }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <label class="col-md-2 col-sm-3">Nom : </label>
                                        <div class="col-md-8 col-sm-9">
                                            <select id="nom" class="form-control" name="nom" required>
                                                <option value="{{ $reference_valeur->reference->nom }}" selected>{{ $reference_valeur->reference->nom }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <div class="col-md-2"></div>
                                        <label class="col-md-2 col-sm-3">Valeur ajoutée : </label>
                                        <div class="col-md-4 col-sm-4">
                                            <input type="text" name="valeur" value="{{ $reference_valeur->valeur }}" class="form-control" placeholder="Ajouter une valeur" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <button type="submit" class="btn theme-btn">
                                            <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i> Modifier
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
