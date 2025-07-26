@props(['annonce'])

<div class="tab-content tabs">
    <div class="tab-pane fade in active" id="information" role="tabpanel">
        <div class="row">
            @forelse ($annonce->annonceable->caracteristiques as $key => $value)
                <div class="col-md-4 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    {{ $key }} <br>
                    <strong class="theme-cl">{{ $value }}</strong>
                </div>
            @empty
                <div class="col-md-12">
                    Aucune information disponible
                </div>
            @endforelse
        </div>
    </div>
    <div class="tab-pane fade" id="equipement" role="tabpanel">
        @forelse ($annonce->referenceDisplay() as $key => $value)
            @if (count($value) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <strong class="" style="text-transform: uppercase;">{{ $key }}</strong>
                    </div>
                    <div class="detail-wrapper-body padd-bot-10">
                        <ul class="detail-check">
                            @forelse ($value as $equipement)
                                <div class="col-xs-12 col-md-4 padd-l-0">
                                    <li style="width: 100%;">{{ $equipement }}</li>
                                </div>
                            @empty
                                <span class="text-center">
                                    Aucun équipement disponible
                                </span>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-md-12">
                Aucun équipement disponible
            </div>
        @endforelse
    </div>
</div>
