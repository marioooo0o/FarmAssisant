@extends('layouts.app', ['farms' => $farms])
 @section('content')
<div class="create-container farm">
  <div class="content">
    <h1>Dodaj Gospodarstwo</h1>
    <form action="{{ route('farm.store') }}" method="POST">
      @csrf
      <input
        class="input-farm"
        type="text"
        name="name"
        id="farm-name"
        placeholder="Nazwa gospodarstwa"
        value= "{{old ('name') }}"
      />
      @error('name')
      <div id="error-name" style="color: red">{{ $message }}</div>
      @enderror
      <input 
        class="input-farm" 
        type="text" 
        name="street" 
        id="street"
        placeholder="Ulica" 
        value="{{ old('street') }}"
      />
      @error('street')
      <div id="error-street" style="color: red">{{ $message }}</div>
      @enderror
      <input
        class="input-farm"
        type="text"
        name="street_number"
        placeholder="Numer domu"
        value="{{ old('street_number') }}"
        id="street_number"
      />
      @error('street_number')
      <div id="error-street_number" style="color: red">{{ $message }}</div>
      @enderror
      <input
        class="input-farm"
        type="text"
        name="postal_code"
        id="postal_code"
        placeholder="Kod pocztowy"
        value="{{ old('postal_code') }}"
      />
      @error('postal_code')
      <div id="error-postal_code" style="color: red">{{ $message }}</div>
      @enderror
      <input
        class="input-farm"
        type="text"
        name="city"
        id="city"
        placeholder="Miejscowość"
        value="{{ old('city') }}"
      />
      @error('city')
      <div id="error-city" style="color: red">{{ $message }}</div>
      @enderror
      <button class="submit" type="submit">Dodaj</button>
      <script>
        const errorEl = document.getElementById("error-name");
        const fieldNameEl = document.getElementById("farm-name");
        fieldNameEl.addEventListener("focus", () => errorEl.classList.add("hidden"));

        const errorStreetEl = document.getElementById("error-street");
        const streetEl = document.getElementById("street");
        streetEl.addEventListener("focus", () => errorStreetEl.classList.add("hidden"));

        const errorStreetNumberEL = document.getElementById("error-street_number");
        const streetNumberEl = document.getElementById('street_number');
        streetNumberEl.addEventListener("focus", () => errorStreetNumberEL.classList.add("hidden"));

        const errorPostalCodeEl = document.getElementById("error-postal_code");
        const postalCodeEl = document.getElementById('postal_code');
        postalCodeEl.addEventListener("focus", () => errorPostalCodeEl.classList.add("hidden"));


        const errorCityEl = document.getElementById("error-city");
        const CityEl = document.getElementById('city');
        CityEl.addEventListener("focus", () => errorCityEl.classList.add("hidden"));
      </script>
    </form>
  </div>
</div>
@endsection
