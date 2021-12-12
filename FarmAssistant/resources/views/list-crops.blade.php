@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')

<div class="create-container practise">
    <div class="content">
        <h1>Ranking upraw</h1>
        <ol class="list-inside list-decimal">
            @if (!$crops->isEmpty())
                @foreach ($crops as $crop)
                <li>{{ $crop->name }} {{ $crop->crop_area }} ha</li>
                @endforeach 
            @else Nie posiadasz żadnych upraw! 
            @endif
        </ol>
    </div>
</div>

@endsection
