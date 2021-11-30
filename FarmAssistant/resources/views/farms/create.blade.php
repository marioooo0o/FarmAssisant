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
        placeholder="Nazwa gospodarstwa"
      />
      <input class="input-farm" type="text" name="street" placeholder="Ulica" />
      <input
        class="input-farm"
        type="text"
        name="street_number"
        placeholder="Numer domu"
      />
      <input
        class="input-farm"
        type="text"
        name="postal_code"
        placeholder="Kod pocztowy"
      />
      <input
        class="input-farm"
        type="text"
        name="city"
        placeholder="Miejscowość"
      />
      <button class="submit" type="submit">Dodaj</button>
    </form>
  </div>
</div>
@endsection
