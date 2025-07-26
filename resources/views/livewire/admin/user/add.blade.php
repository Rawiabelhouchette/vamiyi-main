<div>
    <div class="card">

        <div class="card-header">
            <h4>Ajouter utilisateur</h4>
        </div>

        <div class="card-body">
            <form wire:submit="store()">
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
                                <input type="text" class="form-control" placeholder="Nom" required wire:model.defer='nom'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Prénom --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Prénom </label> <br>
                                <input type="text" class="form-control" placeholder="Prénom" required wire:model.defer='prenom'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Nom d'utilisateur --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Identifiant
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control" placeholder="Idenitifiant" required wire:model.defer='username'>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    {{-- Téléphone --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Téléphone </label> <br>
                                <input type="text" class="form-control" placeholder="Téléphone" wire:model.defer='telephone'>
                                @error('telephone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Email </label> <br>
                                <input type="email" class="form-control" placeholder="Email" wire:model.defer='email'>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Actif --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Actif
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="form-control" required wire:model.defer='is_active'>
                                    <option value="1" selected>OUI</option>
                                    <option value="0">NON</option>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    {{-- Type de rôle --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Type utilisateur
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select id="type" class="form-control" required wire:model.lazy='role'>
                                    <option value="" selected disabled>Choisir ...</option>
                                    <option value="Administrateur">Administrateur</option>
                                    {{-- @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach --}}

                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Mot de passe --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Mot de passe
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="password" class="form-control" placeholder="Mot de passe" required wire:model.defer='password'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- Confirmer mot de passe --}}
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Confirmer mot de passe
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="password" class="form-control" placeholder="Confirmer mot de passe" required wire:model.defer='password_confirmation'>
                                <p id="error_message" style="color: red;"></p>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                @if ($isProfessionnel)
                    <div class="row" wire:transition wire:ignore>
                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label class="">Entreprise
                                        <b style="color: red; font-size: 100%;">*</b>
                                    </label> <br>
                                    <select class="form-control" required wire:model.lazy='entreprise_id'>
                                        <option value="" selected>Choisir ...</option>
                                        @foreach ($entreprises as $entreprise)
                                            <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                @endif

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
