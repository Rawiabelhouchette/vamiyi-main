@props(['annonce'])

@foreach ($annonce->referenceDisplay() as $slug => $values)
    <tr>
        <td style="font-weight: bold;" width="30%">{{ ucfirst($slug) }}</td>
        <td style="padding-bottom: 0px;">
            <ul>
                @foreach ($values as $value)
                    <li>{{ $value }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
@endforeach