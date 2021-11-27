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
            class="input-protection input-protection--first"
          >
            @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
          </select>
          <br>
          <label
            >Ilość:
            <input
              type="number"
              name="addProtectionProduct[0][quantity]"
              step="0.1"
              value="1"
              min="0"
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
    const newInput = document.createElement("div");
    newInput.setAttribute("id", `fields-${productsId}`);
    newInput.setAttribute(
      "class",
      "removable-input-container removable-input-container--products"
    );
    newInput.innerHTML = `
          <div class="flex">
          <select
            name="addProtectionProduct[${productsId}][product_name]"
            class="input-protection"
          >
            @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
          </select>
          <button type="button" class="remove-button" id="fields-button-${productsId}">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            class="bi bi-trash"
            viewBox="0 0 16 16"
          >
            <path
              d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
            />
            <path
              fill-rule="evenodd"
              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
            />
          </svg>
          </button>
          </div>
          <br>
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
          `;
    productForm.appendChild(newInput);
    document
      .getElementById(`fields-button-${productsId}`)
      .addEventListener("click", () => {
        document.getElementById(`fields-${productsId}`).remove();
        productsId--;
      });
  }
  document.getElementById("addProduct").addEventListener("click", addProduct);
</script>

@endsection
