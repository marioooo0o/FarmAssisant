@extends('templateOLD', ['farmsName'=>$farmsName])

@section('title')
    {{ $farm->name }} <span class="material-icons">
        mode_edit
        </span>
@endsection

@section('content')
<center>

    

<h1>{{ $farm->name }} </h1>
<h2>
    ul. {{ $farm->street }} {{ $farm->street_number }}
    <br />{{ $farm->postal_code }} {{ $farm->city }}
</h2>
                @isset($farm->fields)
                    @foreach ($farm->fields as $field)

                        <a href="/farm/{{ $farm->id }}/field/{{ $field->id }}">{{ $field->field_name }}</a> {{ $field->field_area }} ha
                        <br>
                        
                        
                         
                    @endforeach
                    <div>
                            
                        <a href="/farm/{{ $farm->id }}/field/create"><i class="material-icons">add_circle</i></a>
                    </div>
                @endisset
                
                @if ($farm->fields == null)
                <a href="">Dodaj pole!</a>  
                @endif
            </center>
@endsection 