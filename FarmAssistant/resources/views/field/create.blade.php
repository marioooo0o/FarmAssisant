@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')
<div class="create-container field">
  <div class="content">
    <h1>Utwórz pole:</h1>
    <form action="{{ route('field.store', [$activeFarm->id]) }}" method="POST">
      @csrf
      @dump($errors)
      <input
        type="text"
        name="field_name"
        placeholder="Nazwa pola"
        class="input-name"
        value="{{ old('field_name') }}"
        id="field-name"
        
      />
      @error('field_name')
      <div id="error-name" style="color: red">{{ $message }}</div>
      @enderror
      <div class="info-text">Dodaj działki, na których znajduje się pole:</div>
      <div id="parcels">
        <div class="parcel parcel--first">
          <input
            type="text"
            name="parcel_numbers[0][name]"
            placeholder="Numer działki ewidencyjnej"
            class="input-number"
            id="parcel_numbers[0][name]"
          />
          <input
            type="number"
            name="parcel_numbers[0][parcel_area]"
            step="0.1"
            min="0"
            class="input-area"
            value="0"
            id="parcel_numbers[0][parcel_area]"
          />
          ha
          
          
        </div>
        @error('parcel_numbers.0.name')
          <div id="error-parcel-name" style="color: red">{{ $message }}</div><br>
          @enderror
          @error('parcel_numbers.0.parcel_area')
          <div id="error-parcel-area" style="color: red">{{ $message }}</div>
          @enderror 
      </div>
      Całkowity rozmiar pola: <span id="field-area">0 ha</span>
      <button type="button" id="addParcel">Dodaj działkę</button>
      <select name="crops" id="crops" class="input-crops">
        @foreach ($crops as $crop)
        <option value="{{ $crop->id }}">{{ $crop->name }}</option>
        @endforeach
      </select>
      <button type="submit" class="submit">Utwórz pole</button>
    </form>
  </div>
  <script>
        const errorEl = document.getElementById("error-name");
        const fieldNameEl = document.getElementById("field-name");
        fieldNameEl.addEventListener("focus", () => errorEl.classList.add("hidden"));





    const errorParcelNameEl = document.getElementById("error-parcel-name");
    const parcelNameEl = document.getElementById("parcel_numbers[0][name]");
    parcelNameEl.addEventListener("focus", () => errorParcelNameEl.classList.add("hidden"));


    const errorParcelAreaEl = document.getElementById("error-parcel-area");
    const parcelAreaEl = document.getElementById("parcel_numbers[0][parcel_area]");
    parcelAreaEl.addEventListener("focus", () => errorParcelAreaEl.classList.add("hidden"));



    let fieldForm = document.getElementById("parcels");
    let fieldsId = 0;
    function addParcel() {
      fieldsId++;
      const id = fieldsId;
      const newInput = document.createElement("div");
      newInput.setAttribute("id", `fields-${id}`);
      newInput.setAttribute("class", "removable-input-container");
      newInput.innerHTML = `
          <div class="parcel">
          <input
              type="text"
              name="parcel_numbers[${id}][name]"
              placeholder="Numer działki ewidencyjnej"
              class="input-number"
            />
            <input
              type="number"
              name="parcel_numbers[${id}][parcel_area]"
              step="0.1"
              min="0"
              class="input-area"
              value="0"
            />
            ha
            <button type="button" class="remove-button" id="fields-button-${id}">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              class="bi bi-trash"
              viewBox="0 0 16 16"
            >
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
          `;
      fieldForm.appendChild(newInput);
      document
        .getElementById(`fields-button-${id}`)
        .addEventListener("click", () => {
          document.getElementById(`fields-${id}`).remove();
        });
      document.querySelectorAll(".input-area").forEach((element) => {
        element.addEventListener("change", evaluateArea);
      });
    }
    function evaluateArea() {
      let area = 0;
      document.querySelectorAll(".input-area").forEach((element) => {
        area += Number(element.value);
      });
      console.log(area);
      document.getElementById("field-area").innerHTML = `${area.toFixed(1)} ha`;
    }
    document.getElementById("addParcel").addEventListener("click", addParcel);
    document.querySelectorAll(".input-area").forEach((element) => {
      element.addEventListener("change", evaluateArea);
    });
  </script>
</div>
@endsection
