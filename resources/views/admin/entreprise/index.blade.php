@extends('layout.admin.app')

@section('entreprise', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Entreprise</a></li>
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
                        <h4>Liste des entreprises</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-2 table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                        <th>WhatsApp</th>
                                        <th>Pays</th>
                                        <th>Ville</th>
                                        <th>Quartier</th>
                                        {{-- <th>Créer par</th> --}}
                                        <th>Crée le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entreprises as $entreprise)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $entreprise->nom }}</td>
                                            {{-- <td>{{ $entreprise->description }}</td> --}}
                                            <td>{{ $entreprise->telephone }}</td>
                                            <td>{{ $entreprise->email }}</td>
                                            <td>{{ $entreprise->whatsapp }}</td>
                                            <td>{{ $entreprise->quartier->ville->pays->nom ?? '-' }}</td>
                                            <td>{{ $entreprise->quartier->ville->nom ?? '-' }}</td>
                                            <td>{{ $entreprise->quartier->nom ?? '-' }}</td>
                                            {{-- <td>{{ $entreprise->creator->nom }} {{ $entreprise->creator->prenom }}</td> --}}
                                            <td>{{ $entreprise->created_at }}</td>
                                            <td class="text-center">
                                                <span style="display: inline-flex;">
                                                    <a href="{{ route('entreprises.show', $entreprise->id) }}" class="show">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href="{{ route('entreprises.edit', $entreprise->id) }}" class="edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </span>
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
                header.style.border = "1px solid black";
                header.style.backgroundColor = "lightblue";
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
            });

            window.addEventListener('relaod:dataTable', event => {
                datatable.ajax.reload();
            });
        });
    </script>
@endsection
