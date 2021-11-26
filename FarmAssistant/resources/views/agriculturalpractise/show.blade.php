@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])

@section('content')
{{--
@dump($practise->plantProtectionProducts)--}}
    <h1>{{ $practise->name }}</h1>
    <p>Data zabiegu: {{ $practise->start }}</p>
    <p>Zabieg na polach: 
        @foreach ($practise->fields as $field)
            <li><a href="{{ route('field.show', [$activeFarm->id, $field->id]) }}">{{ $field->field_name }}</a>  {{ $field->field_area }}ha</li>
        @endforeach
    </p>
    Środki użyte do zabiegu:
    @foreach ($practise->plantProtectionProducts as $product)
        <li>{{ $product->name }}  {{ $product->pivot->quantity }}{{ $product->unit }}</li> 
    @endforeach
    

@endsection