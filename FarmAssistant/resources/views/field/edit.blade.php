@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])

@section('content')

    <h1>Edytuj pole:</h1>

    <form action="/farm/{{ $activeFarm->id}}/field/{{ $field->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="field_name">Nazwa pola: </label>
        <input type="text" name="field_name" value="{{ $field->field_name }}">
        <br>
        <label for="field_area_label">Powierzchnia pola: </label>
        <label for="field_area">{{ $field->field_area }} ha</label>
        <br>
        @isset($field->cadastralParcels)
        <td>Edytuj działki: </td>
        <td>
            <ul>
                @foreach ($field->cadastralParcels as $parcel)
                    <li>
                        <a href="/farm/{{ $activeFarm->id }}/field/{{ $field->id }}/parcel/{{ $parcel->id }}/edit">{{ $parcel->parcel_number }}</a>
                    </li>
                @endforeach
                <a href="/farm/{{ $activeFarm->id }}/field/{{ $field->id }}/parcel/create"><i class="material-icons">add_circle</i></a>
            </ul>
        </td>
            
        @endisset

        Uprawa:
        <select name="crops" id="crops">
            @foreach ($crops as $crop)
                @isset($cropActive)
                    @if ($cropActive->id == $crop->id ))
                        <option value="{{ $crop->id}}" selected>{{ $crop->name }}</option>
                    @endif
                @endisset
                <option value="{{ $crop->id }}">{{ $crop->name }}</option>            
            @endforeach
        </select>

        <button type="submit" class="btn btn-success">Zapisz</button>
        
    </form>
    
@endsection