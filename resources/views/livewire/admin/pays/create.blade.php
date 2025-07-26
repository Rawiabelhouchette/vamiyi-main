<div>
    <div class="card">

        {{-- 
            // TODO : Ajouter les etoiles du required
        --}}
        <div class="card-header">
            <h4>Enregistrer un pays</h4>
        </div>

        <div class="card-body">
            <form wire:submit="store()">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Indicatif </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="{{ __('Indicatif du pays (ex: +228)') }}" required wire:model.defer='indicatif'>
                                @error('indicatif') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Nom </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="{{ __('Nom du pays')}}" required wire:model.defer='nom'>
                                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Code </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="{{ __('Coed du pays (ex: TG)') }}" required wire:model.defer='code'>
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Langue </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="{{ __('Langue du pays') }}" required wire:model.defer='langue'>
                                @error('langue') <span class="text-danger">{{ $message }}</span> @enderror
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
                </div>
            </form>
        </div>
    </div>
</div>
