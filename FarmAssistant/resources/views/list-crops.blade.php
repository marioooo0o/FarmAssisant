@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')

Lista upraw
@foreach ($crops as $crop)
    Uprawy: {{ $crop->name }}
    Powierzchnia: {{ $crop->crop_area }} ha
    <br>
@endforeach
@endsection