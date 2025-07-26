<div>
    <div class="card add">

        <div class="card-header">
            <h4>{{ $libelle }}</h4>
        </div>

        <div class="card-body">
            <form wire:submit="store()">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Catégorie</label>
                            <div class="col-md-8 col-sm-9 col-xl-3">
                                <select class="form-control" name="type" required wire:model.lazy='type' @if ($isEdit) disabled @endif>
                                    <option value="" selected disabled>Sélectionnez une catégorie</option>
                                    @foreach ($typeList as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Référence</label>
                            <div class="col-md-8 col-sm-9 col-xl-3">
                                <select class="form-control" name="type" required wire:model.lazy='nom' @if ($isEdit) disabled @endif>
                                    <option value="" selected disabled>Sélectionnez une référence</option>
                                    @foreach ($nomList as $nom)
                                        <option value="{{ $nom }}">{{ $nom }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <div class="col-md-3 col-sm-3 col-xl-2 required">
                            <label>Valeur </label></div>
                            <div class="col-md-8 col-sm-9 col-xl-3">
                                <input type="text" class="form-control" placeholder="Saisissez un nom" required wire:model.defer='valeur'>
                            </div>
                        </div>
                    </div>

                </div>


                            @if ($isEdit)
                                <button wire:click='resetForm' class="btn btn-danger" style="margin-right: 15px;">
                                    <i class="fa fa-cancel fa-lg" style="margin-right: 10px;"></i> Annuler
                                </button>
                            @endif
                            <button wire:target='store' wire:loading.attr='disabled' type="submit" class="btn theme-btn" style="margin-right: 15px;">
                                <i class="fa fa-{{ $formIcon }} fa-lg" style="margin-right: 10px;"></i>
                                {{ $buttonLibelle }}
                            </button>
                </div>
            </form>
        </div>
    </div>

</div>