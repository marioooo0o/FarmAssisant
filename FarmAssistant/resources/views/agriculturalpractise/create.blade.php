@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')
<div class="create-container practise">
  <div class="content">
    <h1>Dodaj zabieg</h1>

    @if ($errors->any())
    <div class="alert alert-danger" style="color: red">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{ route('practise.store', [$idFarm]) }}" method="POST">
      @csrf
      <input
        type="text"
        name="practise_name"
        placeholder="Nazwa zabiegu"
        value="{{ old('practise_name') }}"
        class="input-name"
      />
      @error('practise_name')
      <div>{{ $message }}</div>
      @enderror
      <br />
      <h2>Data zabiegu: </h2>
      <input type="datetime-local" name="start" class="input-data"/>

      <h2>Wybrane pola:</h2>
      <div id="fields-container">
        <div class="removable-input-container removable-input-container--first">
          <select name="fields[]" class="input-field">
            {{-- Do zrobienia w przyszłości @if (old('fields')!=null) @foreach
            (old('fields') as $fieldOld)
            <option value="{{ $fields[$fieldOld] }}" selected>
              {{ $fields[$fieldOld]->field_name }}
              {{ $fields[$fieldOld]->field_area }} ha
            </option>
            @endforeach @else @dump('nie ma mnie') @endif --}} @foreach ($fields
            as $field)
            <option value="{{ $field->id }}">
              {{ $field->field_name }} {{ $field->field_area }} ha
            </option>
            @endforeach
          </select>
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
        </div>
      </div>
      <button type="button" name="addFieldButton" id="addField">
        Dodaj pole
      </button>
      <h2>Wybrane środki:</h2>
      <div id="products-container">
        <div class="product">
          <select name="protectionproduct[0][name]" class="input-protection input-protection--first">
            @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">
              {{ $product->name }}
            </option>
            @endforeach
          </select>
          <div class="info-text">Maksymalna dawka środka: 0</div>
          <label
            >Ilość środka:<input
              class="input-quantity"
              type="number"
              min="0"
              name="protectionproduct[0][quantity]"
          /></label>
          l
        </div>
      </div>
      <button type="button" name="addProductButton" id="addProduct">
        Dodaj środek
      </button>

      <label
        >Ilość wody:
        <input type="number" name="water" step="10" value="1000" min="0" />
      </label>

      l
      <button type="submit" class="submit">Dodaj zabieg</button>
      <script>
        let fieldsId = 0;
        const fieldForm = document.getElementById("fields-container");
        function addField() {
          fieldsId++;
          const newInput = document.createElement("div");
          newInput.setAttribute("id", `fields-${fieldsId}`);
          newInput.setAttribute("class", "removable-input-container");
          newInput.innerHTML = `
          <select name="fields[]" class="input-field">
            {{-- Do zrobienia w przyszłości @if (old('fields')!=null) @foreach
            (old('fields') as $fieldOld)
            <option value="{{ $fields[$fieldOld] }}" selected>
              {{ $fields[$fieldOld]->field_name }}
              {{ $fields[$fieldOld]->field_area }} ha
            </option>
            @endforeach @else @dump('nie ma mnie') @endif --}} @foreach ($fields
            as $field)
            <option value="{{ $field->id }}">
              {{ $field->field_name }} {{ $field->field_area }} ha
            </option>
            @endforeach
          </select>
          <button type="button" class="remove-button" id="fields-button-${fieldsId}">
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
          `;
          fieldForm.appendChild(newInput);
          document
            .getElementById(`fields-button-${fieldsId}`)
            .addEventListener("click", () => {
              document.getElementById(`fields-${fieldsId}`).remove();
              fieldsId--;
            });
        }
        document.getElementById("addField").addEventListener("click", addField);



        let productsId = 0;
        const productsForm = document.getElementById("products-container");
        function addProduct() {
          productsId++;
          const newInput = document.createElement("div");
          newInput.setAttribute("id", `products-${productsId}`);
          newInput.setAttribute("class", "removable-input-container removable-input-container--products");
          newInput.innerHTML = `
					<div class="product">
            <div class="flex">
          <select name="protectionproduct[${productsId}][name]" class="input-protection">
            @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">
              {{ $product->name }}
            </option>
            @endforeach
          </select>
          <button type="button" class="remove-button" id="products-button-${productsId}">
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
					<div class="info-text">Maksymalna dawka środka: 0</div>
          <label
            >Ilość środka:<input
              class="input-quantity"
              type="number"
              min="0"
              name="protectionproduct[${productsId}][quantity]"
          /></label>
          l
        </div>
          `;
          productsForm.appendChild(newInput);
          document
            .getElementById(`products-button-${productsId}`)
            .addEventListener("click", () => {
              document.getElementById(`products-${productsId}`).remove();
              productsId--;
            });
        }
        document
          .getElementById("addProduct")
          .addEventListener("click", addProduct);
      </script>
    </form>
  </div>
</div>
@endsection
