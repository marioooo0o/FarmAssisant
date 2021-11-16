@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')

<div class="dashboard-container">
    <div class="procedures">
        <h2>Zabiegi</h2>
        <ol>
            @if (!$practises->isEmpty()) @foreach ($practises as $practise)
            <li>
                <a class="procedure-name">{{ $practise->name }}</a>
                <a
                    href="{{ route('field.show',[$activeFarm->id, $practise->field_id]) }}"
                    >{{ $practise->field_name }}</a
                ><span
                    class="date"
                    >{{\Carbon\Carbon::parse($practise->updated_at)->format('d-m-Y') }}</span
                >
            </li>
            @endforeach @else Brak zabiegów, dodaj swój pierwszy zabieg! @endif
        </ol>
        <a href="/home/{{ $farm->id}}/practise/create"><button>+</button></a>
    </div>
    <div class="fields">
        <h2>Pola</h2>

        <ol>
            @if (!$fields->isEmpty()) @foreach ($fields as $field)
            <li>
                <a href="/farm/{{ $field->farm_id }}/field/{{ $field->id }}">
                    {{ $field->field_name }} {{ $field->field_area }}ha</a
                >
            </li>
            @endforeach @else Brak pól, dodaj swoje pierwsze pole! @endif
        </ol>
        <a href="{{ route('field.create', ['idFarm'=> $activeFarm->id ]) }}"
            ><button>+</button></a
        >
    </div>
    <div class="magazine">
        <h2>Magazyn</h2>
        @if (!$productsData->isEmpty())
        <ul>
            @foreach ($productsData as $product)
            <li>
                {{ $product->name}} {{ $product->quantity}} {{ $product->unit }}
            </li>
            @endforeach
        </ul>
        <a href="/home/{{ $farm->id }}/magazine/create"><button>+</button></a>

        @else Brak środków w magazynie!
        <a href="/home/{{ $farm->id }}/magazine/create"><button>+</button></a>

        @endif
    </div>
    <div class="weather">
        <h2>Pogoda</h2>
    </div>
    <div class="ranking">
        <h2>Ranking upraw</h2>
        <ol>
            @isset($crops) @foreach ($crops as $crop)
            <li>{{ $crop->name }} {{ $crop->crop_area }} ha</li>
            @endforeach @endisset
        </ol>
    </div>
    <div class="calendar">
        <h2>Kalendarz</h2>
    </div>
</div>
@endsection
