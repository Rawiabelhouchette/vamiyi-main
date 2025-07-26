@props(['annonce'])
<tr>
    <td style="font-weight: bold;" width="30%" colspan="2">Image à la une</td>
</tr>

<tr>
    <td colspan="2">
        <div class="text-center gallery-box">
            <div class="row">
                <div class="col-md-3">
                    <div class="listing-shot grid-style mrg-bot-15 padd-0">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            @if ($annonce->image)
                                <a data-fancybox="gallery" href="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}">
                                    <img class="listing-shot-img" class="img-responsive" src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>

<tr>
    <td style="font-weight: bold;" width="30%" colspan="2">Galerie</td>
</tr>

<tr>
    <td colspan="2">
        <div class="text-center gallery-box">
            @foreach ($annonce->galerie as $image)
                <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="listing-shot grid-style padd-0">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <a data-fancybox="gallery" href="{{ asset('storage/' . $image->chemin) }}">
                                <img class="listing-shot-img" class="img-responsive" src="{{ asset('storage/' . $image->chemin) }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @empty($annonce->galerie->count())
                <span>Aucune image</span>
            @endempty
        </div>
    </td>
</tr>
