@props(['offre', 'withModal' => false])

<div class="col-md-4 col-sm-6 col-xs-12">
    <form id="pricing-submit-form" action="{{ route('abonnements.payement.check') }}" method="POST">
    {{-- <form class="pricing-submit-form" action="{{ route('abonnements.store') }}" method="POST"> --}}
        @csrf
        <div class="package-box">
            <div class="package-header">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <h3>{{ $offre->libelle }}</h3>
            </div>
            <div class="package-price" style="">
                <h3 class="mrg-top-0" style="font-family: 'Poppins', sans-serif; font-size: 27px !important; color: #26354e; margin-bottom: .25em; ">{{ number_format($offre->prix, 0, ',', ' ') }} <sup style="font-size: 15px;">F CFA </sup><sub>/ {{ $offre->duree }} Mois</sub></h3>
            </div>
            <div class="package-info" style="font-family: 'Muli', sans-serif;">
                <ul>
                    <li>3 Designs</li>
                    <li>3 PSD Designs</li>
                    <li>4 color Option</li>
                    <li>10GB Disk Space</li>
                    <li>Full Support</li>
                </ul>
            </div>
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">
            @if ($withModal)
                <button type="button" data-toggle="modal" data-target="#abonnement-{{ $offre->id }}" class="btn btn-package">Souscrire</button>
            @else
                <button type="button" class="btn btn-package pricing-submit-btn">Souscrire</button>
            @endif
        </div>

        @if ($withModal)
            <div class="modal fade in" id="abonnement-{{ $offre->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content" style="padding-bottom: 10px;">

                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLabel2">Création d'entreprise</h4>
                            <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                                <i class="ti-close"></i>
                            </button>
                        </div>

                        <div class="modal-body padd-top-10">

                            <div class="wel-back">
                                <h3>Veuillez créer <span class="theme-cl">une entreprise !</span></h3>
                            </div>

                            <div class="form-group">
                                <label>Nom de votre entreprise</label>
                                <input type="text" name="nom_entreprise" class="form-control" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <label>Numéro de téléphone</label>
                                <input type="text" name="numero_telephone" class="form-control telephone" data-country="Togo" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <label>Numéro de whatsapp</label>
                                <input type="text" name="numero_whatsapp" class="form-control telephone" data-country="Togo" placeholder="" required>
                            </div>

                            <div class="center">
                                <button type="submit" id="login-btn" class="btn btn-midium theme-btn btn-radius width-200"> Continuer </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
