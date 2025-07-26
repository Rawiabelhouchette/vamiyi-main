@props([
    'title' => '',
    'annonce',
])

<div>
    <style>
        .modal-open #share {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .modal-open #share {
                width: 350px;
                left: calc(50% - 175px);
            }
        }

        #share-header {
            border-bottom: none !important;
            padding-bottom: 0;
        }

        .share-icon {
            scale: 1.25;
        }
    </style>

    <div id="share" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="shareLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content padd-bot-0">
                <div class="modal-header" id="share-header">
                    <h4 id="modalLabel2" class="modal-title">Partager</h4>
                    <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>

                <div class="modal-body padd-top-0">
                    <div class="row">
                        <div class="col-12 mrg-10">
                            <div class="side-list text-center">
                                <ul class="padd-top-0">
                                    <li class="padd-top-0 padd-bot-0">
                                        <h5>{{ \Illuminate\Support\Str::limit($annonce->titre, 96, '...') }}</h5>
                                        <div class="listing-list-info">
                                            <h5 id="annonce-titre"></h5>
                                            <div class="listing-post-meta">
                                                <span class="updated" id="annonce-type">{{ $annonce->type }}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 text-center mrg-10">
                            <ul class="side-list-inline no-border social-side">
                                <li class="share-icon">
                                    <a href="javascript:void(0)" id="annonce-url">
                                        <i class="fa fa-copy theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('show', $annonce->slug) }}" target="_blank">
                                        <i class="fa-brands fa-facebook theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="whatsapp://send?text=Salut!%0AJette un œil à l'annonce que j’ai trouvé sur Vamiyi%0ATitre : {{ $annonce->titre }}%0ALien : {{ route('show', $annonce->slug) }} " target="_blank">
                                        <i class="fa-brands fa-whatsapp theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="mailto:?subject={{ $annonce->titre }}&body=Salut!%0AJette un œil à l'annonce que j’ai trouvé sur Vamiyi%0ATitre : {{ $annonce->titre }}%0ALien : {{ route('show', $annonce->slug) }} " target="_blank">
                                        <i class="fa fa-envelope theme-cl"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12 text-center mrg-10">
                            <p id="copyMessage" style="display: none;">URL copiée dans le presse-papiers !</p>
                        </div>

                        <style>
                            #copyMessage {
                                background-color: #4CAF50;
                                color: white;
                                padding: 10px;
                                border-radius: 3px;
                            }
                        </style>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#annonce-url').click(function() {
                    var text = "{{ route('show', $annonce->slug) }}";

                    if (!navigator.clipboard) {
                        console.error('Clipboard API not available');
                        return;
                    }

                    navigator.clipboard.writeText(text).then(function() {
                        $('#copyMessage').hide();
                        $('#copyMessage').fadeIn(500);
                        setTimeout(function() {
                            $('#copyMessage').fadeOut(500);
                        }, 2000);
                    }, function(err) {
                        console.error('Could not copy text: ', err);
                    });
                });
            });
        </script>
    @endpush
</div>
