@extends('layouts.app') @section('content')
<div class="wrapper">
  <div class="content">
    <h1>Pola</h1>
    <ol>
      @foreach ($fields as $field)
      <li>
        <div class="field">
          <div>
            <a href="{{ route('field.show', [$field->farm_id, $field->id]) }}"
              >{{ $loop->index+1 }}. {{ $field->field_name }}</a
            >
          </div>
          <div>Powierzchnia: {{ $field->field_area }} ha</div>
          <div>
            Uprawa: @foreach ($field->crops as $crop)
            {{ $crop->name }}
            @endforeach
          </div>
          <div>
            Lista działek:
            <ul>
              @foreach ($field->cadastralParcels as $parcel)
              <li>
                <a
                  href="{{ route('parcel.show', [$field->farm_id, $field->id, $parcel->id]) }}"
                  >{{ $parcel->parcel_number}}</a
                >
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </li>
      @endforeach
    </ol>
  </div>
</div>
@endsection
