@extends('layouts.app')

@section('content') 
    <table class="table">
        <thead>
            <th>Lp.</th>
            <th>Nazwa pola</th>
            <th>Powierzchnia</th>
            <th>Lista działek</th>
            <th>Uprawa</th>
        </thead>
        <tbody>
            @foreach ($fields as $field)
                <tr>
                    <td data-label="Lp.">{{ $loop->index+1 }}</td>
                    <td data-label="Nazwa pola"><a href="{{ route('field.show', [$field->farm_id, $field->id]) }}">{{ $field->field_name }}</a></td>
                    <td data-label="Powierzchnia">{{ $field->field_area }}</td>
                    <td data-label="Lista działek">
                        @foreach ($field->cadastralParcels as $parcel)
                            <li><a href="{{ route('parcel.show', [$field->farm_id, $field->id, $parcel->id]) }}">{{ $parcel->parcel_number}}</a></li>
                        @endforeach
                    </td> 
                    <td data-label="Uprawa">
                        @foreach ($field->crops as $crop)
                            {{ $crop->name }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection