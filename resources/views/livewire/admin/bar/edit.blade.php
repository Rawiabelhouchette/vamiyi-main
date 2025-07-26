<div>
    <div class="card">

        <div class="card-header">
            <h4>Modifier un Bar & Rooftop</h4>
        </div>

        <div class="card-body">
            <form wire:submit="update()">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Entreprise
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="select2" wire:model.defer='entreprise_id' required data-nom="entreprise_id">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                    @endforeach
                                </select>
                                @error('entreprise_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nom
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control" placeholder="" required wire:model.defer='nom' required>
                                @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Type de bar
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="text" class="form-control" placeholder="" wire:model.defer='type_bar'>
                                @error('type_bar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Type de musique
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="text" class="form-control" placeholder="" wire:model.defer='type_musique'>
                                @error('type_musique')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Capacité d'accueil
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" value="0" wire:model.defer='capacite_accueil' min="0">
                                @error('capacite_accueil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Prix minimum
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="number" class="form-control" value="0" wire:model.defer='prix_min' min="0">
                                @error('prix_min')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Prix maximum
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="number" class="form-control" value="0" placeholder="" wire:model.defer='prix_max' min="{{ $this->prix_max }}">
                                @error('prix_max')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Date de validité
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="date" class="form-control" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                                @error('date_validite')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Statut
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="form-control" wire:model.defer='is_active' data-nom="is_active">
                                    <option value="1">Activé</option>
                                    <option value="0">Désactivé</option>
                                </select>
                                @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Description
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <textarea id="description" class="form-control height-100" placeholder="" wire:model.defer='description'></textarea>
                    </div>
                </div>

                <div class="row" style="padding-left: 10px; padding-right: 10px;">
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements',
                        'name' => 'equipements_vie_nocturne',
                        'options' => $list_equipements_vie_nocturne,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Commodités',
                        'name' => 'commodites_vie_nocturne',
                        'options' => $list_commodites_vie_nocturne,
                    ])

                </div>

                @include('admin.annonce.edit-galery-component', [
                    'galery' => $galerie,
                    'old_galerie' => $old_galerie,
                ])

                <div class="row">
                    <div class="form-group" style="margin-top: 15px;">
                        <div class="col-md-12 col-sm-12 text-right">
                            <button wire:target='update' wire:loading.attr='disabled' type="submit" class="btn theme-btn" style="margin-right: 30px;">
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                height: '25px',
                width: '100%',
            });
            $('.select2').on('change', function(e) {
                var data = $(this).val();
                var nom = $(this).data('nom');
                @this.set(nom, data);
            });
        });
    </script>
@endpush
