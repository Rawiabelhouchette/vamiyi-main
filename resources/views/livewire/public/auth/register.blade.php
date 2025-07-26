<div wire:ignore.self id="register" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modalLabel3" class="modal-title">{{ __('Créer un nouveau compte') }}</h4>
                <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="wel-back">
                    <h3>Bienvenue! <span class="theme-cl">Nouveau compte ?</span></h3>
                </div>

                @if ($error)
                    <div class="alert-group">
                        <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ $message }}
                        </div>
                    </div>
                @endif

                <form wire:submit="register()">
                    @csrf

                    <div class="row">

                        {{-- Nom --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" class="form-control" placeholder="Nom" required wire:model="nom">
                        </div>

                        {{-- Prénom --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" class="form-control" placeholder="Prénom" required wire:model="prenom">
                        </div>

                        {{-- Nom d'utilisateur --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" id="username" class="form-control" placeholder="Nom d'utilisateur" required wire:model="username">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Email" required wire:model="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Type --}}
                        {{-- <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label for="type">Type de compte</label>
                            <select class="form-control" required data-nom="type" wire:model.lazy="type">
                                <option style="font-style: italic; opacity: 0.4;">Choisir</option>
                                <option value="Usager">Usager</option>
                                <option value="Professionnel">Professionnel</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        {{-- Mot de passe --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" class="form-control" placeholder="Mot de passe" required wire:model="password">
                        </div>

                        {{-- Confirmation du mot de passe --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label for="password_confirmation">Rattaper le mot de passe</label>
                            <input type="password" id="password_confirmation" class="form-control" placeholder="Rattaper le mot de passe" required wire:model="password_confirmation">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <span class="custom-checkbox d-block">
                        <input id="remember" type="checkbox" name="remember" wire:model="remember">
                        <label for="remember">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </span>

                    <div class="center">
                        <button id="signup" wire:target='register' wire:loading.attr='disabled' type="submit" class="btn btn-midium theme-btn btn-radius width-200">
                            <span wire:loading>
                                @include('components.public.loader', ['withText' => false, 'color' => '#fff'])
                            </span>
                            <span>
                                &nbsp;{{ __('Enregistrer') }}
                            </span>
                        </button>
                    </div>

                </form>
            </div>

            <div class="center mrg-top-5">
                <div class="bottom-login text-center">Déjà un compte ? </div>
                <a id="btn-login" href="javascript:void(0)" class="theme-cl">{{ __('Se Connecter') }}</a>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#type').on('change', function(e) {
                var data = $(this).val();
                console.log(data);
                var nom = $(this).data('nom');
                @this.set(nom, data);
            });
        });
    </script>
@endpush
