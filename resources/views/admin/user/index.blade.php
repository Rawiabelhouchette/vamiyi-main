@extends('layout.admin.app')

@section('compte', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Compte</a></li>
                <li class="active">Liste des comptes</li>
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
                        <h4>Liste des comptes</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                        <th>Actif</th>
                                        <th>Profil</th>
                                        <th>Entreprise</th>
                                        {{-- <th>Identifiant</th> --}}
                                        <th>Ajouté le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->nom }}</td>
                                            <td class="">
                                                @if ($user->prenom == '')
                                                    -
                                                @else
                                                    {{ $user->prenom }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($user->telephone == '')
                                                    -
                                                @else
                                                    {{ $user->telephone }}
                                                @endif
                                            </td>
                                            <td class="">
                                                @if ($user->email == '')
                                                    -
                                                @else
                                                    {{ $user->email }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($user->is_active == 1)
                                                    <span class="label label-success">OUI</span>
                                                @else
                                                    <span class="label label-danger">NON</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user->roles[0]->name }}</td>
                                            <td class="">
                                                @foreach ($user->entreprises as $entreprise)
                                                    - {{ $entreprise->nom }} <br>
                                                @endforeach
                                            </td>
                                            {{-- <td>{{ $user->username }}</td> --}}
                                            <td>
                                                @php
                                                    $date = new DateTime($user->created_at);
                                                @endphp
                                                {{ $date->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($user->hasRole('Usager') || $user->hasRole('Professionnel'))
                                                    <span class="text-center">-</span>
                                                @else
                                                    <a href="javascript:void(0)" class="edit" data-id="{{ $user->id }}"><i class="fa fa-pencil"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
                //
                Processing: true,
                // serverSide: true,
                // ajax: {
                //     url: "{{ route('users.datatable') }}",
                //     type: 'GET',
                //     dataType: 'json',
                //     data: function(d) {
                //         d.page = d.start / d.length + 1;
                //         d.search = d.search.value;
                //         d.length = d.length;
                //         return d;
                //     },
                // },
                // columns: [{
                //         //data: 'id',
                // data: null,
                // render: function(data, type, row, meta) {
                //     return meta.row + meta.settings._iDisplayStart + 1;
                // }
                //     },
                //     {
                //         data: 'nom',
                //     },
                //     {
                //         className: 'text-center',
                //         render: function(data, type, row) {
                //             if (row.prenom == '') {
                //                 return '-';
                //             }
                //             return row.prenom;
                //         },
                //     },
                //     {
                //         className: 'text-center',
                //         render: function(data, type, row) {
                //             if (row.telephone == '') {
                //                 return '-';
                //             }
                //             return row.telephone;
                //         },
                //     },
                //     {
                //         className: 'text-center',
                //         render: function(data, type, row) {
                //             if (row.email == '') {
                //                 return '-';
                //             }
                //             return row.email;
                //         },
                //     },
                //     {
                //         className: 'text-center',
                //         render: function(data, type, row) {
                //             if (row.is_active == 1) {
                //                 return '<span class="label label-success">OUI</span>';
                //             }
                //             return '<span class="label label-danger">NON</span>';
                //         },
                //     },
                //     {
                //         className: 'text-center',
                //         render: function(data, type, row) {
                //             return row.roles[0].name;
                //         },
                //     },
                //     {
                //         className: 'text-center',
                //         render: function(data, type, row) {
                //             if (row.entreprise == null) {
                //                 return '-';
                //             }
                //             return row.entreprise.nom;
                //         },
                //     },
                //     {
                //         data: 'username',
                //     },
                //     {
                //         render: function(data, type, row) {
                //             var date = new Date(row.created_at);
                //             return date.toLocaleDateString('fr-FR') + ' ' + date.toLocaleTimeString('fr-FR');
                //         },
                //     },
                //     {
                //         className: "text-center",
                //         render: function(data, type, row) {
                //             return '<a href="javascript:void(0)" class="edit" data-id="' + row.id + '"><i class="fa fa-pencil"></i></a>';
                //         }
                //     }
                // ],
            });

            // window.addEventListener('relaod:dataTable', event => {
            //     datatable.ajax.reload();
            // });

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.location.href = "{{ route('users.index') }}/" + id;
            });
        });
    </script>
@endsection
