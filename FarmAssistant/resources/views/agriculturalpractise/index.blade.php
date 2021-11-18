@extends('layouts.app', ['activeFarm' => $activeFarm, 'farms' => $farms])

@section('content')
<table >
    <thead>
        <th>Lp.</th>
        <th>Nazwa zabiegu</th>
        <th>Pola</th>
        <th>Data wykonania</th>
    </thead>
    <tbody>
        @foreach ($practises as $practise)
        <tr>
            <td data-label="Lp.">{{ $loop->index+1 }}</td>
            <td data-label="Nazwa zabiegu">{{ $practise->name }}</td>
            <td data-label="Pola">
                @foreach ($practise->fields as $field)
                
                    <li><a href="{{ route('field.show', [$field->farm_id, $field->id])}}">{{ $field->field_name }}</a></li>
                @endforeach
            </td>
            <td data-label="Data wykonania">{{ $practise->updated_at }}</td>
        
        </tr>
           @endforeach
    </tbody>
</table>
@endsection
