@extends('layouts.app', ['activeFarm' => $activeFarm, 'farms' => $farms])
@section('content')
<div class="wrapper">
  <div class="content">
    <h1>Zabiegi</h1>
    <ol>
      @foreach ($practises as $practise)
      <li>
        <div class="field">
          <div>{{ $loop->index+1 }}. {{ $practise->name }}</div>
          <div>
            Uprawa: @foreach ($field->crops as $crop)
            {{ $crop->name }}
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
