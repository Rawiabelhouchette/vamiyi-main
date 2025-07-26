@props(['galery', 'required' => false])

<div class="row">
    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 20px; padding-left: 40px;padding-right: 40px;">
        <div class="row">
            <div class="col-md-12">
                <label class="">Image à la une
                    <b style="color: red; font-size: 100%;">*</b>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="upload-image" class="btn btn-sm theme-btn" style="padding: 6px">
                    <i class="fa fa-upload fa-lg" style="margin-left: 10px;"></i>
                    &nbsp; &nbsp; &nbsp;
                    @if ($image)
                        1 image sélectionnée
                    @else
                        Aucune image sélectionnée
                    @endif
                    &nbsp; &nbsp;
                </label>
            </div>
        </div>
        <input id="upload-image" type="file" wire:model="image" accept="image/*" style="display: none;" required> <br>
        <div class="text-center gallery-box">
            <div class="row">
                <div class="col-md-3 padd-bot-0">
                    @if ($image)
                        <div class="listing-shot grid-style padd-0">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <a data-fancybox="gallery" href="{{ $image->temporaryUrl() }}">
                                    <img class="listing-shot-img" src="{{ $image->temporaryUrl() }}" class="img-responsive" alt="">
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 40px; padding-left: 40px;padding-right: 40px;">
        <div class="row">
            <div class="col-md-12">
                <label class="">Galérie
                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                </label>
            </div>
            <div class="col-md-4">
                <label for="upload" class="btn btn-sm theme-btn" style="padding: 6px">
                    <i class="fa fa-upload fa-lg" style="margin-left: 10px;"></i>
                    &nbsp; &nbsp; &nbsp;
                    @if ($galerie)
                        {{ count($galerie) }} image(s) sélectionnée(s)
                    @else
                        Aucune image sélectionnée
                    @endif
                    &nbsp; &nbsp;
                </label>
                <input id="upload" type="file" wire:model="selected_images" accept="image/*" multiple style="display: none;"> <br>
            </div>
            <div class="col-md-4">
                @if (count($galerie) != 0)
                    <a href="javascript:void(0)" wire:click='removeAllImages' wire:confirm="Confirmez-vous cette action ?"
                       class="btn btn-sm theme-btn-outlined" wire:click="removeAllImages" style="padding: 6px">
                        <i class="fa fa-trash fa-lg" style="margin-left: 10px;"></i>
                        &nbsp; &nbsp; &nbsp;
                        Supprimer toutes les images
                        &nbsp; &nbsp;
                    </a>
                @endif
            </div>
            <div class="col-md-4">
                {{-- <a href="javascript:void(0)" wire:click='restoreImages' wire:confirm="Confirmez-vous cette action ?"
                   class="btn btn-sm theme-btn-outlined" wire:click="removeAllOldImages" style="padding: 6px">
                    <i class="fa fa-refresh fa-lg" style="margin-left: 10px;"></i>
                    &nbsp; &nbsp; &nbsp;
                    Annuler les modifications
                    &nbsp; &nbsp;
                </a> --}}
            </div>
        </div>
        <div class="text-center">
            <div class="text-center gallery-box mrg-top-15">
                @foreach ($galerie as $index => $image)
                    <div class="col-xs-12 col-md-4 col-lg-3">
                        <div class="listing-shot grid-style padd-0">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <a data-fancybox="gallery" href="{{ $image->temporaryUrl() }}">
                                    <img class="listing-shot-img" src="{{ $image->temporaryUrl() }}" class="img-responsive" alt="">
                                </a>
                                <span class="approve-listing" style="background-color: red;">
                                    <a href="javascript:void(0)" style="color: white;" wire:click='removeImage("{{ $index }}")'>
                                        <i class="fa fa-trash" style="font-size: 10px;"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @error('galerie')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
</div>
