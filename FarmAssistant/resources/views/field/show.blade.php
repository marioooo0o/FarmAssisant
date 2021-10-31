@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])


@section('content')
    
    <h1>{{ $field->field_name }} 
        <a href="{{ route('field.edit', [$activeFarm->id, $field->id]) }}">edit</a> </h1>
        <form action="/farm/{{ $activeFarm->id }}/field/{{ $field->id }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link">
                <i class="material-icons">delete</i>
            </button>
            
            
        </form>
        
    <h2>{{ $field->field_area }} ha</h2>

    
    @isset($field->cadastralParcels)
    <td>Numery działek:</td>
    <td>
        <ul>
            @foreach ($field->cadastralParcels as $parcel)
                <li>

                    <a href="/farm/{{ $activeFarm->id }}/field/{{ $field->id }}/parcel/{{ $parcel->id }}">{{ $parcel->parcel_number }}</a>
                </li>
            @endforeach
        </ul>
    </td>
    @endisset

    @forelse ($field->crops as $crop)
        Uprawa: {{ $crop->name }} 
        <br>
    @empty
        Dadaj nazwe uprawy
    @endforelse

@endsection
