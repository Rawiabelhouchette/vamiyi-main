<div wire:ignore.self id="signin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modalLabel2" class="modal-title">{{ __('Connectez-vous à votre compte') }}</h4>
                <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="wel-back">
                    <h2>{{ __('Bienvenue !') }} <span class="theme-cl"></span></h2>
                </div>

                @if ($error)
                    <div class="alert-group">
                        <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ $message }}
                        </div>
                    </div>
                @endif

                <form wire:submit="login()">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Identifiant') }}</label>
                        <input type="text" minlength="4" name="email" class="form-control form-control-sm" placeholder="Username" wire:model='email' required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Mot de passe') }}</label>
                        <input type="password" name="password" class="form-control" placeholder="*******" wire:model='password' required>
                    </div>

                    @if (Route::has('password.reset'))
                        <div class="text-right">
                            <a class="btn-link theme-cl" href="{{ route('password.reset') }}">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        </div>
                    @endif

                    <span class="custom-checkbox d-block">
                        <input id="remember" type="checkbox" name="remember" wire:model='remember'>
                        <label for="remember" style="font-weight: normal;">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </span>

                    <div class="center">
                        <button type="submit" wire:target='login' wire:loading.attr='disabled' class="btn btn-midium theme-btn btn-radius width-200">
                            <span wire:loading>
                                @include('components.public.loader', ['withText' => false, 'color' => '#fff'])
                            </span>
                            <span>
                                &nbsp;{{ __('Connexion') }}
                            </span>
                        </button>
                    </div>

                </form>
            </div>

            <div class="center mrg-top-5">
                <div class="bottom-login text-center"> {{ __("Vous n'avez pas de compte ?") }}</div>
                <a id="btn-register" href="javascript:void(0)" class="theme-cl">{{ __('Créer un compte') }}</a>
            </div>

        </div>
    </div>
</div>
