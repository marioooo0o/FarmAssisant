@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])

@section('content')

<div class="dashboard-container">
    <div class="procedures">
        <h2>Zabiegi</h2>
        <ol>     
            @if (!$practises->isEmpty())
                @for ($i=0; $i < 5; $i++)
                    @isset($practises[$i])
                        <li><a class="procedure-name">{{ $practises[$i]->name }}</a> <a href="{{ route('field.show',[$activeFarm->id, $practises[$i]->field_id]) }}">{{ $practises[$i]->field_name }}</a><span class="date">{{\Carbon\Carbon::parse($practises[$i]->updated_at)->format('d-m-Y') }}</span></li>
                    @endisset
                @endfor
            @else
                Brak zabiegów, dodaj swój pierwszy zabieg!
            @endif
            
                        
            
        </ol>
        <a href="/home/{{ $activeFarm->id}}/practise/create"><button>+</button></a>
    </div>
    <div class="fields">
        <h2>Pola</h2>
        
        <ol>
            @if (!$fields->isEmpty())
                @for ($i = 0; $i < 4; $i++)
                    @isset($fields[$i])
                        <li><a href="/farm/{{ $fields[$i]->farm_id }}/field/{{ $fields[$i]->id }}"> {{ $fields[$i]->field_name }}    {{ $fields[$i]->field_area }}ha</a> </li>
                    @endisset
                @endfor
                <a href="{{ route('field.index', [$activeFarm->id]) }}" class="link-to-many">Zobacz wszystkie pola</a>
            @else
                Brak pól, dodaj swoje pierwsze pole!      
            @endif
        </ol>
        <a href="{{ route('field.create', ['idFarm'=> $activeFarm->id ]) }}"><button>+</button></a>
    </div>
    <div class="magazine">
        <h2>Magazyn</h2>
        @if (!$productsInMagazine->isEmpty())
            <ul>
                @for ($i = 0; $i<5; $i++)
                    @isset($productsInMagazine[$i])
                        <li>{{ $productsInMagazine[$i]->name}}  {{ $productsInMagazine[$i]->quantity}} {{ $productsInMagazine[$i]->unit }}</li>
                    @endisset
                @endfor                
            </ul>
            <a href="/home/{{ $activeFarm->id }}/magazine/create"><button>+</button></a>

        @else
            Brak środków w magazynie!
            <a href="/home/{{ $activeFarm->id }}/magazine/create"><button>+</button></a>

        @endif        
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