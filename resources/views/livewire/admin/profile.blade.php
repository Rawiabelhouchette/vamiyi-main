<div class="row">
    <form wire:submit.prevent='update'>
        @csrf
        <div class="col-md-12">
            <div class="text-center">
                <style>
                    @media (max-width: 768px) {
                        .profile-edit-button {
                            margin-top: 5px;
                        }
                    }
                </style>
                @if ($editInfo || $editPass)
                    <a href="javascript:void(0)" class="btn theme-btn" wire:click='cancel'>Annuler</a>
                @else
                    <a href="javascript:void(0)" class="btn theme-btn-trans-radius" wire:click='editInformation'>Modifier information</a>
                    <a href="javascript:void(0)" class="btn theme-btn-trans-radius profile-edit-button" wire:click='editPassword'>Changer mot de passe</a>
                @endif
            </div> <br>
        </div>
        <div class="col-md-12">
            <div class="add-job_container">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Informations Personnelles</h4>
                    </div>
                    <div class="card-body">
                        <div class="row no-ext-mrg sm-plix">
                            <div class="col-sm-6">
                                <label>Nom</label>
                                <input type="text" name="nom" class="form-control" @if (!$editInfo) readonly @endif wire:model='nom' required>
                                @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label>Prénom</label>
                                <input type="text" name="prenom" class="form-control" @if (!$editInfo) readonly @endif wire:model='prenom' required>
                                @error('prenom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row no-ext-mrg sm-plix">
                            <div class="col-sm-6">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" @if (!$editInfo) readonly @endif wire:model='email' required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label>Nom d'utilisateur</label>
                                <input type="text" name="username" class="form-control" wire:model='username' @if (!$editInfo) readonly @endif required>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($editInfo)
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="submit" class="btn theme-btn" wire:loading.attr='disabled' wire:target='update'>Mettre à jour</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($editPass)
                    <div class="card" wire:transition.fade>
                        <div class="card-header">
                            <h4><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Mot de passe</h4>
                        </div>

                        <div class="card-body">
                            <div class="row no-ext-mrg sm-plix">
                                <div class="col-sm-6">
                                    <label>Ancien mot de passe</label>
                                    <input type="password" wire:model='password_old' class="form-control" required>
                                    @error('password_old')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label>Nouveau mot de passe</label>
                                    <input type="password" wire:model='password' class="form-control" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row no-ext-mrg sm-plix">
                                <div class="col-sm-6">
                                    <label>Retaper le nouveau mot de passe</label>
                                    <input type="password" wire:model='password_confirmation' class="form-control" required>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="submit" class="btn theme-btn" wire:loading.attr='disabled' wire:target='update'>Mettre à jour</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
