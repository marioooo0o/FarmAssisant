@extends('template')

@section('title')
    Edycja działki
@endsection

@section('content')



<label for="parcel_number">Numer działki: </label>
<input type="text" value="{{ $parcel->parcel_number }}">
<h4 >Całkowita powierzchnia działki: <h4 id="sum">{{ $sum }}</h4> ha </h4>
Działka należy do pól: 


<ul>
    @foreach ($fields as $field)
        <li>
            <a href="/farm/{{ $farm->id }}/field/{{ $field->field_id }}">{{ $field->field_name }}</a> Powierzchnia: <input type="number" step="0.01" value="{{ $field->parcel_area }}" id="input-1">ha
    @endforeach
</ul>
<script>
    const sum = document.querySelector("#sum");
    const input1 = document.querySelector("#input-1");
    
    const updateSum = () => {
        sum.innerHTML = Number(input1.value);
    };
    input1.addEventListener("change", updateSum);
</script>

<button type="submit" class="btn btn-primary">Zapisz</button>
@endsection