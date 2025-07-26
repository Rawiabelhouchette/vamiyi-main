<div>
    <div class="card">

        <div class="card-header">
            <h4>Enregistrer une ville</h4>
        </div>

        <div class="card-body">
            <form wire:submit="store()">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Pays :
                                <b style="color: red;">*</b>
                            </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <select class="form-control" required wire:model.defer='pays_id'>
                                    <option value="">-- {{ __('Choisir un pays') }} --</option>
                                    @foreach ($pays as $item)
                                        <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                    @endforeach
                                    @error('pays_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Nom :
                                <b style="color: red;">*</b>
                            </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="{{ __('Nom de la ville') }}" required wire:model.defer='nom'>
                                @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 col-sm-12  col-xl-2 text-right">
                    <div class="form-group" style="">
                        <button wire:target='store' wire:loading.attr='disabled' type="submit" class="btn theme-btn" style="margin-right: 15px;">
                            <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
