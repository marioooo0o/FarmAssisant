@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])

@section('content')

<div class="dashboard-container">
<div class="magazine">
    <h2>Magazyn</h2>

    @if (!$productsInMagazine->isEmpty())
    <ul>
        @foreach ($productsInMagazine as $product)
        <li id="product-{{ $loop->iteration }}">
            {{ $product->name}} {{ $product->quantity}} {{ $product->unit }}
            <script>
                if("{{ $product->quantity}}" < 5) {
                    document.getElementById("product-{{ $loop->iteration }}").innerHTML += `<div class="bar bar--red" id="product-bar-{{ $loop->iteration }}"></div>`;
                    document.getElementById("product-bar-{{ $loop->iteration }}").style.width = `${"{{ $product->quantity }}"*10}%`;
                }
                else if("{{ $product->quantity}}" < 10) {
                    document.getElementById("product-{{ $loop->iteration }}").innerHTML += `<div class="bar bar--orange" id="product-bar-{{ $loop->iteration }}"></div>`;
                    document.getElementById("product-bar-{{ $loop->iteration }}").style.width = `${"{{ $product->quantity }}"*10}%`;
                }
                else {
                    document.getElementById("product-{{ $loop->iteration }}").innerHTML += `<div class="bar bar--green" id="product-bar-{{ $loop->iteration }}"></div>`;
                    document.getElementById("product-bar-{{ $loop->iteration }}").style.width = `100%`;
                }
            </script>
        </li>
        @endforeach
    </ul>
    @endif
</div>
</div>

@endsection