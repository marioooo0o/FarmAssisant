@extends('layouts.app', ['farms' => $farms])

@section('content')
    <h1>Dodaj Gospodarstwo</h1>
    <form action="{{ route('farm.store') }}" method="POST">
    @csrf
    <label>Nazwa Gospodarstwa: <input type="text" name="name"></label>
    <br>
    <h2>Adres: </h2>
    <br>

    <label>Ulica: <input type="text" name="street"></label>
    <br>
    <label>Numer domu: <input type="text" name="street_number"></label>
    <br>
    <label>Kod pocztowy: <input type="text" name="postal_code"></label>
    <br>
    <label>Miejscowość: <input type="text" name="city"></label>
    <br>
    <button type="submit">Dodaj</button>
</form>
   
@endsection
