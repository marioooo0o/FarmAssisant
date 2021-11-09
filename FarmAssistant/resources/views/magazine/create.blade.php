@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')
<div class="create-container practise">
  <div class="content">
    <h1>Dodaj środki do magazynu:</h1>
    <form
      action="{{ route('magazine.store', [$idFarm]) }}"
      method="POST"
      id="product-form"
    >
      @csrf
      <h2>Wybrane środki:</h2>
      <div id="products-container">
        <div class="product">
          <select
            name="addProtectionProduct[0][product_name]"
            class="input-protection"
          >
            @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
          </select>
          <label
            >Ilość:
            <input
              type="number"
              name="addProtectionProduct[0][quantity]"
              step="0.1"
              value="1"
            />
            {{ $product->unit }}</label
          >
        </div>
      </div>
      <button type="button" id="addProduct">Dodaj więcej</button>
      <button type="submit" class="submit">Dodaj środki</button>
    </form>
  </div>
</div>

<script>
  let productsId = 0;
  let productForm = document.getElementById("products-container");
  function addProduct() {
    productsId++;
    productForm.innerHTML += `
    <div class="product">
          <select
            name="addProtectionProduct[${productsId}][product_name]"
            class="input-protection"
          >
            @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
          </select>
          <label
            >Ilość:
            <input
              type="number"
              name="addProtectionProduct[${productsId}][quantity]"
              step="0.1"
              value="1"
            />
            {{ $product->unit }}</label
          >
        </div>
            `;
  }
  document.getElementById("addProduct").addEventListener("click", addProduct);
</script>

@endsection
