<div>
    <div class="card">

        <div class="card-header">
            <h4>Ajouter une location meublée</h4>
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
                                <label class="">Nom de la location
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
                                <label class="">Superficie (m²)
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='superficie'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- </div>

                <div class="row"> --}}
                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nombre de personne
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_personne'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nombre de chambre
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_chambre' required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Prix minimum
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='prix_min'>
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
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='prix_max'>
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
                                <label class="">Nombre de salle de bain
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_salles_bain'>
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

                    {{-- <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Heure de validité
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="time" class="form-control" placeholder="" wire:model.defer='heure_validite' required>
                                @error('heure_validite')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Description
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <textarea id="description" class="form-control height-100" placeholder="" wire:model.defer='description'></textarea>
                    </div>
                </div>

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Type de lit',
                    'name' => 'types_lit',
                    'options' => $list_types_lit,
                    'required' => true,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Commodités',
                    'name' => 'commodites',
                    'options' => $list_commodites,
                ])

                {{-- service --}}
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Services',
                    'name' => 'services',
                    'options' => $list_services,
                ])

                {{-- equipements_herbegement --}}
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipements d\'hébergement',
                    'name' => 'equipements_herbegement',
                    'options' => $list_equipements_herbegement,
                ])

                {{-- equipements_cuisine --}}
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipements de cuisine',
                    'name' => 'equipements_cuisine',
                    'options' => $list_equipements_cuisine,
                    'required' => true,
                ])

                {{-- equipements_salle_bain --}}
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipements de salle de bain',
                    'name' => 'equipements_salle_bain',
                    'options' => $list_equipements_salle_bain,
                ])

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
