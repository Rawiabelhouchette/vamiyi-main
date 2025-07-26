<div>
    <div class="card">

        <div class="card-header">
            <h4>Modifier un pays</h4>
        </div>

        <div class="card-body">
            <form wire:submit="update()">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Indicatif </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="" required wire:model.defer='indicatif'>
                                @error('indicatif') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Nom </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="" required wire:model.defer='nom'>
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
                                <input type="text" class="form-control" placeholder="" required wire:model.defer='code'>
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 col-sm-3 col-xl-2 required">Langue </label>
                            <div class="col-md-8 col-sm-4 col-xl-3">
                                <input type="text" class="form-control" placeholder="" required wire:model.defer='langue'>
                                @error('langue') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-md-12 col-sm-12  col-xl-2 text-right">
                        <div class="form-group" style="">
                            <button wire:target='update' wire:loading.attr='disabled' type="submit" class="btn theme-btn" style="margin-right: 15px;">
                                <i class="fa fa-pencil fa-lg" style="margin-right: 10px;"></i>
                                Modifier
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
