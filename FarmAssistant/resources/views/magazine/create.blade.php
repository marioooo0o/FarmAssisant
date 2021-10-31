@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])

@section('content')
    Dodaj środek do magazynu: 

    <form action="{{ route('magazine.store', [$idFarm]) }}" method="POST" id="product-form">
        @csrf
        <div id="products-container">
        <label for="">Nazwa środka:</label>
        
            <select name="addProtectionProduct[0][product_name]" >
                @foreach ($plantProtectionProducts as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <label>Ilość: <input type="number" name="addProtectionProduct[0][quantity]" step="0.01" value="1"> {{ $product->unit }}</label>
            <br>
        </div>
        
        <br>
        <p>Tu powinien być przycisk który daje możliwość dodania kolejnego środka z jego ilością</p>
        <br>
        <button type="submit">Dodaj</button>
    </form>
    <button type="button" name="add" id="dynamic-ar" >Dodaj nowy produkt</button>

    <script>
        let productsId = 0;
    let productForm = document.getElementById("products-container");
        function addProduct() {
            productsId++;
            productForm.innerHTML += `
            <label for="">Nazwa środka:</label>
        
        <select name="addProtectionProduct[${productsId}][product_name]">
            @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
        <label>Ilość: <input type="number" name="addProtectionProduct[${productsId}][quantity]" step="0.01" value="1"></label>
    <br>
            `
        }
        document.getElementById("dynamic-ar").addEventListener("click", addProduct);
    </script>

@endsection
