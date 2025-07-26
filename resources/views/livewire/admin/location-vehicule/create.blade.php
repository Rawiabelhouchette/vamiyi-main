<div>
    <div class="card">

        <div class="card-header">
            <h4>Ajouter une location de véhicule</h4>
        </div>

        <div class="card-body">
            <form wire:submit="store()">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            {{-- 
                             // TODO : Add id form label and link it to input
                            --}}
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
                                <label class="">Titre
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

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="" for="marque">Marque
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select id="marque" class="select2" wire:model.defer='marque' required data-nom="marque">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($list_marques as $marque)
                                        <option value="{{ $marque->valeur }}">{{ $marque->valeur }}</option>
                                    @endforeach
                                </select>
                                @error('marque')
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
                                <label class="">Modèle
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="text" class="form-control" placeholder="" wire:model.defer='modele'>
                                @error('modele')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Annee : number --}}
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Année
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='annee'>
                                @error('annee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Kilometrage : number --}}
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Kilométrage
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='kilometrage'>
                                @error('kilometrage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- nombre places : number --}}
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nombre de places
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_places'>
                                @error('nombre_places')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- nombre portes : number --}}
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nombre de portes
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_portes' value="2" required>
                                @error('nombre_portes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="" for="carburant">Type de carburant
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select id="carburant" class="select2" wire:model.defer='carburant' required data-nom="carburant">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($list_types_carburant as $item)
                                        <option value="{{ $item->valeur }}">{{ $item->valeur }}</option>
                                    @endforeach
                                </select>
                                @error('carburant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="" for="boite_vitesses">Boite de vitesses
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select id="boite_vitesses" class="select2" wire:model.defer='boite_vitesses' required data-nom="boite_vitesses">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($list_boites_vitesse as $item)
                                        <option value="{{ $item->valeur }}">{{ $item->valeur }}</option>
                                    @endforeach
                                </select>
                                @error('boite_vitesses')
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
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;" required>
                        <label class="">Description
                            <b style="color: red; font-size: 100%;">*</b>
                        </label> <br>
                        <textarea id="description" class="form-control height-100" placeholder="" wire:model.defer='description'></textarea>
                    </div>
                </div>

                <div class="row" style="padding-left: 10px; padding-right: 10px;">
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Type de véhicule',
                        'name' => 'types_vehicule',
                        'options' => $list_types_vehicule,
                        'required' => true,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Équipements',
                        'name' => 'equipements_vehicule',
                        'options' => $list_equipements_vehicule,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Conditions de location',
                        'name' => 'conditions_location',
                        'options' => $list_conditions_location,
                    ])

                </div>

                @include('admin.annonce.create-galery-component', [
                    'galery' => $galerie,
                ])

                <div class="row padd-bot-15">
                    <div class="form-group" style="margin-top: 15px;">
                        <div class="col-md-12 col-sm-12 text-right">
                            <button wire:target='store' wire:loading.attr='disabled' type="submit" class="btn theme-btn" style="margin-right: 30px;">
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
