@extends('layout.public.app')

@section('content')
    @livewire('public.search-box')

    @livewire('public.search', ['hasSessionValue' => $hasSessionValue])

    @push('scripts')
        <script>
            function shareAnnonce(url, titre, image, type) {
                var text = "Salut!%0AJette un œil à l'annonce que j’ai trouvé sur Vamiyi%0ATitre : " + titre + "%0ALien : " + url + " ";
                var subject = titre;
                var url = url;
                var image = image;
                var annonceType = type;

                $('#annonce-titre').text(subject);
                $('#annonce-image-url').attr('src', image);
                $('#annonce-type').text(annonceType);

                $('#annonce-email').attr('href', 'mailto:?subject=' + subject + '&body=' + text);
                $('#annonce-url').data('url', url);
                $('#annonce-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
                $('#annonce-whatsapp').attr('href', 'whatsapp://send?text=' + text);
                $('#share-page-zone').hide();
                $('#image-share').show();
            }

            function sharePage() {
                var url = window.location.href;
                var text = "Salut!%0AJette un œil à la page que j’ai trouvé sur Vamiyi%0ALien : " + url + " ";

                $('#annonce-url').data('url', url);
                $('#annonce-email').attr('href', 'mailto:?subject=Vamiyi&body=' + text);
                $('#annonce-url').attr('href', url);
                $('#annonce-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
                $('#annonce-whatsapp').attr('href', 'whatsapp://send?text=' + text);
                $('#share-page-zone').show();
                $('#image-share').hide();
            }

            $('#annonce-url').click(function() {
                var text = $(this).data('url');

                if (!navigator.clipboard) {
                    console.error('Clipboard API not available');
                    return;
                }

                navigator.clipboard.writeText(text).then(function() {
                    $('#copyMessage').hide();
                    $('#copyMessage').fadeIn(500);
                    setTimeout(function() {
                        $('#copyMessage').fadeOut(500);
                    }, 1500);
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            });
        </script>

        <script>
            function filterList(category) {
                // Get the input field and its value
                var filter = normalizeString($('#search-' + category).val());

                // Get the list and its items
                var $li = $('#list-' + category + 's li');

                // Variable to count the number of items displayed
                var count = 0;

                // Loop through the list items and hide those that don't match the filter
                $li.each(function() {
                    var txtValue = normalizeString($(this).find('label').text());
                    if (txtValue.indexOf(filter) > -1) {
                        $(this).fadeIn(300);
                        count++;
                    } else {
                        $(this).fadeOut(300);
                    }
                });

                // Get the no results message
                var $noResults = $('#no-' + category + '-results');

                // If no items are displayed, show the no results message
                if (count === 0) {
                    $noResults.fadeIn(300);
                } else {
                    $noResults.hide(); //fadeOut(300);
                }
            }

            function normalizeString(str) {
                return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toUpperCase();
            }

            window.addEventListener('refresh:filter', event => {
                var intervalId = setInterval(function() {
                    var categories = [];
                    $('ul.price-range').each(function() {
                        if (this.id.startsWith('list-')) {
                            var idWithoutList = this.id.replace('list-', '').slice(0, -1);
                            categories.push(idWithoutList);
                        }
                    });

                    categories.forEach(function(category) {
                        filterList(category);
                    });
                    clearInterval(intervalId);
                }, 500);
            });
        </script>

        <script>
            // reset filters
            $('.reset-filters').on('click', function() {
                var url = window.location.href;
                var newUrl = url.split('?')[0];
                window.history.pushState({}, '', newUrl);

                $('#reset-filters').fadeOut(300);
                $('#research-zone').fadeOut(300);
            });
        </script>

        <script>
            window.addEventListener('custom:element-removal', event => {
                var ids = event.detail[0].element;
                var perPage = event.detail[0].perPage;
                var key = event.detail[0].key;
                var facette = event.detail[0].facette;

                if (!key) {
                    $('#key-filter').fadeOut(300);
                }

                if (facette == 0 && key == '') {
                    $('#research-zone').fadeOut(300);
                    $('#reset-filters').fadeOut(300);
                }

                if (perPage > ids.length) {
                    $('#annonce-pagination').fadeOut(300);
                } else {
                    $('#annonce-pagination').fadeIn(300);
                }
                // remove element where id is not in ids using js looping on annonces-zone id

                $('#annonces-zone').children().each(function() {
                    var annonceId = $(this).attr('id').split('-')[1];
                    if (!ids.includes(annonceId)) {
                        $(this).fadeOut(300);
                    }
                });
            });













            // $(document).ready(function() {
            //     $('.selectedOption').on('click', function() {
            //         // supprimer l'element pres 2 seconde s'il existe toujours

            //         var intervalId = setInterval(function() {
            //             if ($(this).length > 0) {
            //                 $(this).parent().remove(); //.fadeOut(300);
            //             }
            //             clearInterval(intervalId);
            //         }, 500);
            //     });
            // });
        </script>
    @endpush
@endsection
