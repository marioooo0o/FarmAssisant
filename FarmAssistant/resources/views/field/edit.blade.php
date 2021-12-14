@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm]) 
@section('content')
<div class="create-container field">
  <div class="content">
    <h1>Edytuj pole:</h1>

    <form action="/farm/{{ $activeFarm->id}}/field/{{ $field->id }}" method="POST">
      @csrf @method('PUT')
      <input type="text" name="field_name" placeholder="Nazwa pola" class="input-name" value="{{ $field->field_name }}" />

      <!-- <label for="field_area_label">Powierzchnia pola: </label>
      <label for="field_area">{{ $field->field_area }} ha</label> -->

      @isset($field->cadastralParcels)
      <h2>Edytuj działki:</h2>

      <div class="info-text">Dodaj działki, na których znajduje się pole:</div>
      <div id="parcels">
        @foreach ($field->cadastralParcels as $parcel)
        <div class="parcel removable-input-container" id="parcels-{{ $loop->index }}">
          <input type="text" name="parcel_numbers[0][name]" placeholder="Numer działki ewidencyjnej" class="input-number" value="{{ $parcel->parcel_number }}" />
          <input type="number" name="parcel_numbers[0][parcel_area]" step="0.1" min="0" class="input-area" value="{{ $parcel->parcel_area }}" />
          ha
          <button type="button" class="remove-button" id="parcels-button-{{ $loop->index }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path
                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
              />
              <path
                fill-rule="evenodd"
                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
              />
            </svg>
          </button>
        </div>
        @endforeach
      </div>
      Całkowity rozmiar pola: <span id="field-area">0 ha</span>
      <button type="button" id="addParcel">Dodaj działkę</button>
      @endisset
      <select name="crops" id="crops" class="input-crops">
        @foreach ($crops as $crop) 
        <option value="{{ $crop->id }}"
          @if ($cropActive->id == $crop->id)
            selected
          @endif>{{ $crop->name }}</option>
        @endforeach
      </select>
      <button type="submit">Zapisz</button>
    </form>
  </div>
</div>

<script>
  let parcelForm = document.getElementById("parcels");
  let parcelsId = 0;

  const parcelInputs = Array.from(document.getElementsByClassName("removable-input-container"));

  parcelInputs.forEach((e) => {
    const id = parcelsId;
    parcelsId++;
    document.getElementById(`parcels-button-${id}`).addEventListener("click", () => {
      document.getElementById(`parcels-${id}`).remove();
      evaluateArea();
    });
  });

  function addParcel() {
    parcelsId++;
    const id = parcelsId;
    const newInput = document.createElement("div");
    newInput.setAttribute("id", `parcels-${id}`);
    newInput.setAttribute("class", "removable-input-container");
    newInput.innerHTML = 
    `
    <div class="parcel">
      <input type="text" name="parcel_numbers[0][name]" placeholder="Numer działki ewidencyjnej" class="input-number" />
      <input type="number" name="parcel_numbers[0][parcel_area]" step="0.1" min="0" class="input-area" value="0" />
      ha
      <button type="button" class="remove-button" id="parcels-button-${id}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
          <path
            fill-rule="evenodd"
            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
          />
        </svg>
      </button>
    </div>
    `;
    parcelForm.appendChild(newInput);
    document.getElementById(`parcels-button-${id}`).addEventListener("click", () => {
      document.getElementById(`parcels-${id}`).remove();
      evaluateArea();
    });
    document.querySelectorAll(".input-area").forEach((element) => {
      element.addEventListener("change", evaluateArea);
    });
    evaluateArea();
  }
  function evaluateArea() {
    let area = 0;
    document.querySelectorAll(".input-area").forEach((element) => {
      area += Number(element.value);
    });
    document.getElementById("field-area").innerHTML = `${area.toFixed(1)} ha`;
  }
  document.getElementById("addParcel").addEventListener("click", addParcel);
  document.querySelectorAll(".input-area").forEach((element) => {
    element.addEventListener("change", evaluateArea);
  });
  evaluateArea();
</script>
@endsection
