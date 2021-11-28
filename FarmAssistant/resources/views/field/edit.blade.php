@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')
<div class="create-container field">
  <div class="content">
    <h1>Edytuj pole:</h1>

    <form
      action="/farm/{{ $activeFarm->id}}/field/{{ $field->id }}"
      method="POST"
    >
      @csrf @method('PUT')
      <input
        type="text"
        name="field_name"
        placeholder="Nazwa pola"
        class="input-name"
        value="{{ $field->field_name }}"
      />

      <!-- <label for="field_area_label">Powierzchnia pola: </label>
      <label for="field_area">{{ $field->field_area }} ha</label> -->

      @isset($field->cadastralParcels)
      <h2>Edytuj działki:</h2>

      <ul>
        @foreach ($field->cadastralParcels as $parcel)
        <li>
          <a
            href="/farm/{{ $activeFarm->id }}/field/{{ $field->id }}/parcel/{{ $parcel->id }}/edit"
            >{{ $parcel->parcel_number }}</a
          >
        </li>
        @endforeach
        <a
          href="/farm/{{ $activeFarm->id }}/field/{{ $field->id }}/parcel/create"
          ><i class="material-icons">add_circle</i></a
        >
      </ul>

      @endisset
      <select name="crops" id="crops" class="input-crops">
        @foreach ($crops as $crop) @isset($cropActive) @if ($cropActive->id ==
        $crop->id ))
        <option value="{{ $crop->id}}" selected>{{ $crop->name }}</option>
        @endif @endisset
        <option value="{{ $crop->id }}">{{ $crop->name }}</option>
        @endforeach
      </select>

      <button type="submit">Zapisz</button>
    </form>
  </div>
</div>
@endsection
