@extends('template')

@section('title')
    Dodaj pole
@endsection

@section('content')
    <h1>Utwórz pole:</h1>
    <form action="{{ route('field.store', [$idFarm]) }}" method="POST">
        @csrf
        <input type="text" name="field_name" placeholder="Nazwa pola">
        <h3>Dodaj działki na których znjaduje się pole:</h3>
        <input type="text" name="parcel_number" placeholder="Numer działki ewidencyjnej">
        <input type="number" name="parcel_area" step="0.01" placeholder=""> ha
        <br>
        <label for="">Uprawa:</label>
        <select name="crops" id="crops">
            @foreach ($crops as $crop)
                <option value="{{ $crop->id }}">{{ $crop->name }}</option>
            @endforeach
        </select>

<br>
        <button type="submit" class="btn btn-primary">Dodaj</button>

    </form>
@endsection
