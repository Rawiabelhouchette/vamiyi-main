<div>
    <div class="card">

        <div class="card-header">
            <h4>Modifier une auberge</h4>
        </div>

        <div class="card-body">
            <form wire:submit="update()">
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
                                <label class="">Nom de la boite
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

                    {{-- <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Type d'hébergement
                                </label> <br>
                                <input type="text" class="form-control" placeholder="" wire:model.defer='types_hebergement'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div> --}}

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

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipement',
                    'name' => 'types_musique',
                    'options' => $list_types_musique,
                ])
                
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Commodités',
                    'name' => 'commodites',
                    'options' => $list_commodites,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Services',
                    'name' => 'services',
                    'options' => $list_services,
                ])


                @include('admin.annonce.reference-select-component', [
                    'title' => 'Types de musique',
                    'name' => 'equipements_vie_nocturne',
                    'options' => $list_equipements_vie_nocturne,
                ])

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
