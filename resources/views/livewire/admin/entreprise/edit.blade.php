<div>
    <div class="card">

        <div class="card-header">
            <h4>Modifier une entreprise</h4>
        </div>

        <div class="card-body">
            <form wire:submit="update()">
                @csrf
                <div class="row">
                    {{-- Nom --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nom
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control" required wire:model.defer='nom'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- telephone --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Téléphone
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control telephone" wire:model.defer='telephone' required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Email
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="email" class="form-control" required wire:model.defer='email'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Description : textarea --}}
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Description
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <textarea class="form-control height-100" wire:model.defer='description'>{{ $description }}</textarea>
                    </div>
                </div>

                <div class="row">
                    {{-- Pays : dropdown --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Pays
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="form-control" required wire:model.lazy='pays_id'>
                                    <option value="">-- Pays --</option>
                                    @foreach ($pays as $p)
                                        <option value="{{ $p->id }}">{{ $p->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Ville : dropdown --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Ville
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="form-control" required wire:model.lazy='ville_id'>
                                    <option value="">-- Ville --</option>
                                    @foreach ($villes as $v)
                                        <option value="{{ $v->id }}">{{ $v->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Quartier : dropdown --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Quartier
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="form-control" required wire:model.lazy='quartier_id'>
                                    <option value="">-- Quartier --</option>
                                    @foreach ($quartiers as $q)
                                        <option value="{{ $q->id }}">{{ $q->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Whatsapp : text --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Whatsapp
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control telephone" required wire:model.defer='whatsapp'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Facebook : text --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Facebook
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="text" class="form-control" wire:model.defer='facebook'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Instagram : text --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Instagram
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="text" class="form-control" wire:model.defer='instagram'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Site web --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Site web
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input type="text" class="form-control" wire:model.defer='site_web'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Longitude --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Longitude
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input id="longitude" type="text" class="form-control" required wire:model.defer='longitude'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Latitude --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Latitude
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input id="latitude" type="text" class="form-control" required wire:model.defer='latitude'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row" wire:ignore>
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <div id="map" style="width: 100%; height: 400px; z-index: 1;"></div>
                    </div>
                </div>

                <br>
                <h5 class="text-center">
                    <label class="">Heure d'ouverture et de fermeture</label>
                </h5>
                <br>

                @foreach ($plannings as $key => $planning)
                    <div class="row">
                        {{-- Jour : dropdown --}}
                        <div class="col-md-4 col-sm-4 col-xl-3">
                            <div class="row">
                                <div class="col-md-1">
                                    @if ($key == 0)
                                        <br>
                                        @if ($autreJour)
                                            <a href="javascrip:void(0)" style="color: blue;" wire:click='addPlanning'>
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        @endif
                                    @else
                                        <br>
                                        <a href="javascrip:void(0)" style="color: red;" wire:click="removePlanning({{ $key }})">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="">Jour
                                        <b style="color: red; font-size: 100%;">*</b>
                                    </label> <br>
                                    <select class="form-control jour" required wire:model.defer='plannings.{{ $key }}.jour'>
                                        <option value="">-- Jour --</option>
                                        <option value="Lundi">Lundi</option>
                                        <option value="Mardi">Mardi</option>
                                        <option value="Mercredi">Mercredi</option>
                                        <option value="Jeudi">Jeudi</option>
                                        <option value="Vendredi">Vendredi</option>
                                        <option value="Samedi">Samedi</option>
                                        <option value="Dimanche">Dimanche</option>
                                        @if ($key == 0)
                                            <option value="Tous les jours">Tous les jours</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>

                        {{-- Heure ouverture : time --}}
                        <div class="col-md-4 col-sm-4 col-xl-3">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label class="">Heure ouverture
                                        <b style="color: red; font-size: 100%;">*</b>
                                    </label> <br>
                                    <input type="time" class="form-control" required wire:model.defer='plannings.{{ $key }}.heure_debut'>
                                </div>
                                <div class="col-md-1"></div>

                            </div>
                        </div>

                        {{-- Heure fermeture : time --}}
                        <div class="col-md-4 col-sm-4 col-xl-3">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label class="">Heure fermeture
                                        <b style="color: red; font-size: 100%;">*</b>
                                    </label> <br>
                                    <input type="time" class="form-control" required wire:model.defer='plannings.{{ $key }}.heure_fin'>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
            if ($('.jour').val() == 'Tous les jours') {
                Livewire.dispatch('changerJour', [false]);
            }

            $('.jour').on('change', function() {
                var jour = $(this).val();
                if (jour == 'Tous les jours') {
                    Livewire.dispatch('changerJour', [false]);
                } else {
                    Livewire.dispatch('changerJour', [true]);
                }
            });
        });
    </script>
@endpush
