@extends('template')

@section('title')
    Działka ewidenyjna 
@endsection

@section('content')

<h1>{{ $parcel->parcel_number }}</h1>
<h4>Całkowita powierzchnia działki: {{ $sum }} ha</h4>
Działka należy do pól: 


<ul>
    @foreach ($fields as $field)
        <li>
            <a href="/farm/{{ $farm->id }}/field/{{ $field->field_id }}">{{ $field->field_name }}</a> Powierzchnia: {{ $field->parcel_area }}ha
    @endforeach
</ul>
@endsection
