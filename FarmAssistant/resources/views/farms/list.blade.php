@extends('template', ['farmsName'=>$farmsName])

@section('title')
    Lista Gospodarstw
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            
            <thead>
              <tr>
                  <th scope="col">Lp.</th>
                  <th scope="col">Nazwa Gospodarstwa</th>
                  <th scope="col">Ulica</th>
                  <th scope="col">Numer domu</th>
                  <th scope="col">Powierzchnia</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($farmList as $farm)
              <tr>
                  
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td><a href="/farm/{{ $farm->id }}">{{ $farm->name }}</a></td>
                  <td>{{ $farm->street }}</td>
                  <td>{{ $farm->street_number }}</td>
                  <td>{{ $farm->area }} ha</td>
                  
              </tr>
            </tbody>
            @empty
            Brak farm!
        @endforelse
          </table>
        
    </div>
@endsection