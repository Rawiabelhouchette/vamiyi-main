<div>
    <div class="card">

        <div class="card-header">
            <h4>Ajouter un restaurant</h4>
        </div>

        <div class="card-body">
            <form wire:submit="store()">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Entreprise
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="select2" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
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
                                <input class="form-control" type="text" placeholder="" required wire:model.defer='nom' required>
                                @error('nom')
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
                                <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                                @error('date_validite')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <h4 class="text-center">Entrées ({{ count($entrees) }})</h4>

                    @foreach ($entrees as $key => $entree)
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Nom
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <textarea class="form-control" type="text" placeholder="" required wire:model.defer='entrees.{{ $key }}.nom' required></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Ingrédients
                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                            </label> <br>
                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='entrees.{{ $key }}.ingredients'></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Prix minimum
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <input class="form-control" type="number" wire:model.defer='entrees.{{ $key }}.prix_min'>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Prix maximum
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <input class="form-control" type="number" placeholder="" wire:model.defer='entrees.{{ $key }}.prix_max'>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <label class="">&nbsp;</label> <br>
                                    @if ($key == 0)
                                        <button class="btn theme-btn" type="button" style="background-color: green; border-color: green" wire:click="addEntree">
                                            <i class="fa fa-plus fa-lg text-center" style=""></i>
                                        </button>
                                    @else
                                        <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removeEntree({{ $key }})">
                                            <i class="fa fa-minus fa-lg text-center" style=""></i>
                                        </button>
                                    @endif
                                </div>

                                @if ($entrees_error && $key == count($entrees) - 1)
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <span class="text-danger">{{ $entrees_error }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
                <br>

                <div class="row">
                    <h4 class="text-center">Plats ({{ count($plats) }})</h4>

                    @foreach ($plats as $key => $plat)
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Nom
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <textarea class="form-control" type="text" placeholder="" required wire:model.defer='plats.{{ $key }}.nom' required></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Ingrédients
                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                            </label> <br>
                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='plats.{{ $key }}.ingredients'></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Accompagnements
                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                            </label> <br>
                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='plats.{{ $key }}.accompagnements'></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Prix minimum
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <input class="form-control" type="number" wire:model.defer='plats.{{ $key }}.prix_min'>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Prix maximum
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <input class="form-control" type="number" placeholder="" wire:model.defer='plats.{{ $key }}.prix_max'>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-1 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <label class="">&nbsp;</label> <br>
                                    @if ($key == 0)
                                        <button class="btn theme-btn" type="button" style="background-color: green; border-color: green" wire:click="addPlat">
                                            <i class="fa fa-plus fa-lg text-center" style=""></i>
                                        </button>
                                    @else
                                        <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removePlat({{ $key }})">
                                            <i class="fa fa-minus fa-lg text-center" style=""></i>
                                        </button>
                                    @endif
                                </div>

                                @if ($plats_error && $key == count($plats) - 1)
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <span class="text-danger">{{ $plats_error }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <br>

                <div class="row">
                    <h4 class="text-center">Desserts ({{ count($desserts) }})</h4>

                    @foreach ($desserts as $key => $dessert)
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Nom
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <textarea class="form-control" type="text" placeholder="" required wire:model.defer='desserts.{{ $key }}.nom' required></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Ingrédients
                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                            </label> <br>
                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='desserts.{{ $key }}.ingredients'></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Prix minimum
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <input class="form-control" type="number" wire:model.defer='desserts.{{ $key }}.prix_min'>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Prix maximum
                                                <b style="color: red; font-size: 100%;">*</b>
                                            </label> <br>
                                            <input class="form-control" type="number" placeholder="" wire:model.defer='desserts.{{ $key }}.prix_max'>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <label class="">&nbsp;</label> <br>
                                    @if ($key == 0)
                                        <button class="btn theme-btn" type="button" style="background-color: green; border-color: green" wire:click="addDessert">
                                            <i class="fa fa-plus fa-lg text-center" style=""></i>
                                        </button>
                                    @else
                                        <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removeDessert({{ $key }})">
                                            <i class="fa fa-minus fa-lg text-center" style=""></i>
                                        </button>
                                    @endif
                                </div>

                                @if ($desserts_error && $key == count($desserts) - 1)
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <span class="text-danger">{{ $desserts_error }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Description
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <textarea class="form-control height-100" id="description" placeholder="" wire:model.defer='description'></textarea>
                    </div>
                </div>

                <div class="row" style="padding-left: 10px; padding-right: 10px;">
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Spécialités',
                        'name' => 'specialites',
                        'options' => $list_specialites,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements',
                        'name' => 'equipements_restauration',
                        'options' => $list_equipements_restauration,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Carte de consommation',
                        'name' => 'carte_consommation',
                        'options' => $list_carte_consommation,
                    ])

                </div>

                @include('admin.annonce.create-galery-component', [
                    'galery' => $galerie,
                ])

                <div class="row padd-bot-15">
                    <div class="form-group" style="margin-top: 15px;">
                        <div class="col-md-12 col-sm-12 text-right">
                            <button class="btn theme-btn" type="submit" style="margin-right: 30px;" wire:target='store'>
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
