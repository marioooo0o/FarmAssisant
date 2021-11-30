@extends('layouts.app', ['activeFarm' => $activeFarm, 'farms' => $farms])
@section('content')
<div class="wrapper">
  <div class="content">
    <h1>Zabiegi</h1>
    <ol>
      @foreach ($practises as $practise)
      <li>
        <div class="field">
          <div>{{ $loop->index+1 }}. <a href="{{ route('practise.show', [$activeFarm->id, $practise->id]) }}">{{ $practise->name }}</a></div>
          <div>
            Uprawa:
            @foreach ($practise->fields as $field)
            <ul>
              @foreach ($field->crops as $crop)
              <li>
                {{ $crop->name }}
              </li>
              @endforeach
            </ul>
              
            @endforeach
          </div>
          <div>
            Pola:
            <ul>
              @foreach ($practise->fields as $field)
              <li>
                <a
                  href="{{ route('field.show', [$field->farm_id, $field->id])}}"
                  >{{ $field->field_name }}</a
                >
              </li>
              @endforeach
            </ul>
          </div>
          <div>Data wykonania: {{ $practise->updated_at }}</div>
        </div>
      </li>
      @endforeach
    </ol>
  </div>
</div>
@endsection
