@extends('layout.admin.app')

@section('abonnement', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Abonnement</a></li>
                <li class="active">Recherche</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Liste des abonnements</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-2 table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Offre</th>
                                        <th>Durée (mois)</th>
                                        <th>Entreprise</th>
                                        <th>Date debut</th>
                                        <th>Date fin</th>
                                        <th>Temps restant</th>
                                        <th>Etat</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
                header.style.border = "1px solid black";
                header.style.backgroundColor = "lightblue";
            });


            var datatable = $('#dataTable').DataTable({
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 50,
                processing: true,
                serverSide: true,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'offre.libelle',
                    },
                    {
                        data: 'offre.duree',
                    },
                    {
                        data: 'entreprises.0.nom',
                        // data: 'id',
                    },
                    {
                        data: 'date_debut',
                    },
                    {
                        data: 'date_fin',
                    },
                    {
                        className: 'text-center',
                        render: function(data, type, row) {
                            if (row.is_active == 0) {
                                return '-';
                            }
                            var date1 = new Date(row.date_fin);
                            var date2 = new Date();
                            var diff = date1.getTime() - date2.getTime();
                            var days = diff / (1000 * 3600 * 24);
                            if (days.toFixed(0) < 0)
                                return 'Expiré';
                            return days.toFixed(0) + ' jours';
                        }
                    },
                    {
                        className: 'text-center',
                        render: function(data, type, row) {
                            if (row.is_active == 1) {
                                return '<span class="label label-success">Actif</span>';
                            } else {
                                return '<span class="label label-danger">Inactif</span>';
                            }
                        }
                    },
                ],
                ajax: {
                    url: "{{ route('abonnements.datatable') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: function(d) {
                        d.page = d.start / d.length + 1;
                        d.search = d.search.value;
                        d.length = d.length;
                        return d;
                    },
                },

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
            });
        });
    </script>
@endsection
