@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')
<div class="wrapper">
  <div class="content">
    <div class="field-icons-container">
      <h1>Działka {{ $parcel->parcel_number }}</h1>
     
    </div>
    <h4>Całkowita powierzchnia działki: {{ $sum }} ha</h4>
    Działka należy do pól:

    <ol>
      @foreach ($fields as $field)
      <li>
        <a
          href="/farm/{{ $farm->id }}/field/{{ $field->field_id }}"
          >{{ $field->field_name }}</a
        >
         - Powierzchnia: {{ $field->parcel_area }}ha
      </li>
      @endforeach
    </ol>
  </div>
</div>

@endsection
