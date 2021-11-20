@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')
<div class="create-container field">
  <div class="content">
    <h1>Utwórz pole:</h1>
    <form action="{{ route('field.store', [$activeFarm->id]) }}" method="POST">
      @csrf
      <input
        type="text"
        name="field_name"
        placeholder="Nazwa pola"
        class="input-name"
      />
      <div class="info-text">Dodaj działki, na których znajduje się pole:</div>
      <div id="parcels">
        <div class="parcel">
          <input
            type="text"
            name="parcel_number"
            placeholder="Numer działki ewidencyjnej"
            class="input-number"
          />
          <input
            type="number"
            name="parcel_area"
            step="0.01"
            class="input-area"
            value="0"
          />
          ha
        </div>
      </div>
      Całkowity rozmiar pola: <span id="field-area">0 ha</span>
      <button type="button" id="addParcel">Dodaj działkę</button>
      <select name="crops" id="crops" class="input-crops">
        <option value="" selected disabled hidden>Wybierz uprawę</option>
        @foreach ($crops as $crop)
        <option value="{{ $crop->id }}">{{ $crop->name }}</option>
        @endforeach
      </select>
      <button type="submit" class="submit">Utwórz pole</button>
    </form>
  </div>
  <script>
    let fieldForm = document.getElementById("parcels");
    function addParcel() {
      fieldForm.innerHTML += `
			<div class="parcel">
				<input
						type="text"
						name="parcel_number"
						placeholder="Numer działki ewidencyjnej"
						class="input-number"
					/>
					<input
						type="number"
						name="parcel_area"
						step="0.01"
						class="input-area"
            value="0"
					/>
					ha
				</div>
        `;
        document.querySelectorAll(".input-area").forEach((element) => {
          element.addEventListener("change", evaluateArea);
        });
    }
    function evaluateArea() {
      let area = 0;
      document.querySelectorAll(".input-area").forEach((element) => {
        area += Number(element.value);
      });
      console.log(area)
      document.getElementById("field-area").innerHTML = `${area} ha`;
    }
    document.getElementById("addParcel").addEventListener("click", addParcel);
    document.querySelectorAll(".input-area").forEach((element) => {
      element.addEventListener("change", evaluateArea);
    });
  </script>
</div>
@endsection
