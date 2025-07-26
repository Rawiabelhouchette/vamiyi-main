@props(['annonce'])

{{-- Entreprise --}}
<tr>
    <td style="font-weight: bold;" width="30%">Entreprise</td>
    <td>
        <a class="text-success" href="{{ route('entreprises.show', $annonce->entreprise->id) }}">
            {{ $annonce->entreprise->nom }}
        </a>
    </td>
</tr>

{{-- Titre --}}
<tr>
    <td style="font-weight: bold;" width="30%">Titre</td>
    <td>{{ $annonce->titre }}</td>
</tr>

{{-- Description --}}
<tr>
    <td style="font-weight: bold;" width="30%">Description</td>
    <td>{{ $annonce->description }}</td>
</tr>

{{-- is_Active --}}
<tr>
    <td style="font-weight: bold;" width="30%">Statut</td>
    <td>
        @if ($annonce->is_active)
            <span class="label label-success">Activé</span>
        @else
            <span class="label label-danger">Désactivé</span>
        @endif
    </td>
</tr>

{{-- Date de validite --}}
<tr>
    <td style="font-weight: bold;" width="30%">Date de validité</td>
    <td>{{ date('d-m-Y', strtotime($annonce->date_validite)) }} | {{ $annonce->jour_restant }} jour(s) restant(s)</td>
</tr>
