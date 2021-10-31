@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])

@section('content')

<div class="dashboard-container">
    <div class="procedures">
        <h2>Zabiegi</h2>
        <ol>     
            @isset($practises)
               @if ($practises)
               @foreach ($practises as $practise)
                <li>

                    <a class="procedure-name">{{ $practise->name }}</a> <a href="">{{ $practise->field_name }}</a><span class="date">{{\Carbon\Carbon::parse($practise->updated_at)->format('d-m-Y') }}</span>
                </li>
                @endforeach
                @else
                    Brak zabiegów dodaj swój pierwszy zabieg
                @endif
            @endisset
            
            
        </ol>
        <a href="/home/{{ $farm->id}}/practise/create"><button>+</button></a>
    </div>
    <div class="fields">
        <h2>Pola</h2>
        
        <ol>
            
            @isset($fields)
                @foreach ($fields as $field)
                <li><a href="/farm/{{ $field->farm_id }}/field/{{ $field->id }}"> {{ $field->field_name }}    {{ $field->field_area }}ha</a> </li>
                @endforeach
            @endisset
            
            
        </ol>
        <a href="{{ route('field.create', ['idFarm'=> $activeFarm->id ]) }}"><button>+</button></a>
    </div>
    <div class="magazine">
        <h2>Magazyn</h2>
        @isset($productsData)
        <ul>

            @foreach ($productsData as $product)
                <li>{{ $product->name}}  {{ $product->quantity}} todo:units</li>
            @endforeach
        </ul>
        @endisset
        
        <a href="/home/{{ $farm->id }}/magazine/create"><button>+</button></a>
    </div>
    <div class="weather">
        <h2>Pogoda</h2>
    </div>
    <div class="ranking">
        <h2>Ranking upraw</h2>
        <ol>
            @isset($crops)
                @foreach ($crops as $crop)
                    <li>{{ $crop->name }} {{ $crop->crop_area }} ha</li>
                @endforeach
            @endisset
            
                
            
            
        </ol>
    </div>
    <div class="calendar">
        <h2>Kalendarz</h2>
    </div>
</div>
@endsection