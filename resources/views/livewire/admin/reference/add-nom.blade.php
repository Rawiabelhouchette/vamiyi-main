<div>
    <div class="card">

        <div class="card-header">
            <h4>{{ $libelle }}</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <form wire:submit="store()">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-2 col-sm-3 col-xl-2 required">Type </label>
                            <div class="col-md-8 col-sm-9 col-xl-3">
                                <select class="form-control" name="type" required wire:model.lazy='type' @if ($isEdit) disabled @endif>
                                    <option value="" selected disabled>Type de référence</option>
                                    @foreach ($typeList as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Nom de référence </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="nom de référence" required wire:model.defer='nom'>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12  col-xl-2 text-right">
                        <div class="form-group" style="">
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
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
