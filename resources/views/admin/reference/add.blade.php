@extends('layout.admin.app')

@section('reference', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Référence</a></li>
                <li class="active">Gestion de Référence</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <livewire:Admin.Reference.add />
            </div>

            <div class="">
                <div class="card card-list">

                    <div class="card-header">
                        <h4>Liste des noms de référence</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-2 table-hover">
                                <thead>
                                    <tr>
                                        <th><span class="custom-checkbox"></span></th>
                                        <th>Type </th>
                                        <th>Nom de référence</th>
                                        <th>Valeur</th>
                                        <th>Créer par</th>
                                        <th>Date de création </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let headers = document.querySelectorAll("#dataTable th");
            headers.forEach(header => {
            });


            var datatable = $('#dataTable').DataTable({

                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                pageLength: 50,
                oLanguage: {
                    "sProcessing": "Traitement en cours...",
                    "sSearch": "Rechercher&nbsp;:",
                    "sLengthMenu": "Afficher _MENU_ éléments",
                    "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix": "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sPrevious": "Pr&eacute;c&eacute;dent",
                        "sNext": "Suivant",
                        "sLast": "Dernier"
                    },

                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    }
                },
                Processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('references.datatable') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: function(d) {
                        d.page = d.start / d.length + 1;
                        d.search = d.search.value;
                        d.length = d.length;
                        return d;
                    },
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'reference.type',
                    },
                    {
                        data: 'reference.nom',
                    },
                    {
                        data: 'valeur'
                    },
                    {
                        render: function(data, type, row) {
                            if (!row.user) {
                                return '-';
                            }
                            return row.user.nom + ' ' + row.user.prenom;
                        }
                    },
                    {
                        render: function(data, type, row) {
                            var date = new Date(row.created_at);
                            return date.toLocaleDateString('fr-FR') + ' ' + date.toLocaleTimeString('fr-FR');
                        },
                    },
                    {
                        className: "text-center",
                        render: function(data, type, row) {
                            return '<a href="javascript:void(0)" data-id="' + row.id + '" class="edit"><i class="fa fa-pencil"></i></a>';
                        }
                    }
                ],
            });

            window.addEventListener('relaod:dataTable', event => {
                datatable.ajax.reload();
            });

            $(document).on('click', '.edit', function(e) {
                // scroll to top with animation
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow');
                Livewire.dispatch('editReference', [$(this).data('id')]);
            });
        });
    </script>
@endsection
