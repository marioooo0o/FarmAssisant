@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm]) 
@section('content')
<div class="create-container practise">
  <div class="content">
    <h1>Edytuj zabieg</h1>
    @if ($errors->any())
    <div class="alert alert-danger" style="color: red">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{ route('practise.update', [$activeFarm->id, $practise->id]) }}" method="POST">
      @csrf @method('PUT') <input type="text" name="practise_name" placeholder="Nazwa zabiegu" 
      @if (old('practise_name')) value="{{ old("practise_name") }}"
      @else value="{{ $practise->name }}" @endif class="input-name" /> 
      @error('practise_name')
      <div>{{ $message }}</div>
      @enderror
      <br />
      <h2>Data zabiegu:</h2>
      <input type="datetime-local" name="start" class="input-data" 
      @if (old('start')) value="{{ old("start") }}" 
      @else
      {{-- Dodać date z bazy --}}
      value="{{ $practise->start_all_date }}" 
      @endif />

      <h2>Wybrane pola:</h2>
      <div id="fields-container">
        @foreach ($practise->fields as $selectedField)
        <div class="removable-input-container removable-input-container--fields" id="fields-{{ $loop->index }}">
          <select name="fields[]" class="input-field">
            @foreach ($fields as $field)
            <option value="{{ $loop->index }}" 
              @if ($field->
              id == $selectedField->id) selected 
              @endif> {{ $field->field_name }} {{ $field->field_area }} ha
            </option>
            @endforeach
          </select>
          <button type="button" class="remove-button" id="fields-button-{{ $loop->index }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
        @endforeach
      </div>
      <button type="button" name="addFieldButton" id="addField">Dodaj pole</button>

      <h2>Wybrane środki:</h2>
      <div id="products-container">
        @foreach ($practise->plantProtectionProducts as $productSelected)
        <div class="removable-input-container removable-input-container--products" id="products-{{ $loop->index }}">
          <div class="product">
            <div class="flex">
              <select name="protectionproduct[{{ $loop->index }}][name]" class="input-protection">
                @foreach ($plantProtectionProducts as $product)
                <option value="{{ $loop->index }}" 
                  @if ($product->
                  id == $productSelected->id) selected 
                  @endif>
                  {{ $product->name }}
                </option>
                @endforeach
              </select>
              <button type="button" class="remove-button" id="products-button-{{ $loop->index }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
            <div class="info-text">Maksymalna dawka środka: <span class="max"> 0</span></div>
            <label
              >Ilość środka:<input
                class="input-quantity"
                type="number"
                min="0"
                max="150"
                name="protectionproduct[{{ $loop->index }}][quantity]"
                value="{{ $productSelected->pivot->quantity }}"
                id="input-quantity-{{ $loop->index }}"
            /></label>
            l
          </div>
        </div>
        @endforeach
      </div>
      <button type="button" name="addProductButton" id="addProduct">Dodaj środek</button>
      <label
        >Ilość wody:
        <input type="number" name="water" step="10" value="1000" min="0" value="{{ $practise->water }}" />
      </label>
      l
      <button type="submit" class="submit">Dodaj zabieg</button>
      <script>
        let fieldsId = 0;
        const fieldForm = document.getElementById("fields-container");
        const fieldInputs = Array.from(document.getElementsByClassName("removable-input-container--fields"));

        fieldInputs.forEach((e) => {
          const id = fieldsId;
          fieldsId++;
          document.getElementById(`fields-button-${id}`).addEventListener("click", () => {
            document.getElementById(`fields-${id}`).remove();
          });
        });

        function addField() {
          fieldsId++;
          const id = fieldsId;
          const newInput = document.createElement("div");
          newInput.setAttribute("id", `fields-${id}`);
          newInput.setAttribute("class", "removable-input-container");
          newInput.innerHTML = 
          `
          <select name="fields[]" class="input-field">
            @foreach ($fields as $field)
            <option value="{{ $loop->index }}">{{ $field->field_name }} {{ $field->field_area }} ha</option>
            @endforeach
          </select>
          <button type="button" class="remove-button" id="fields-button-${id}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
              <path
                fill-rule="evenodd"
                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
              />
            </svg>
          </button>
          `;
          fieldForm.appendChild(newInput);
          document.getElementById(`fields-button-${id}`).addEventListener("click", () => {
            document.getElementById(`fields-${id}`).remove();
            updateMaximumDoses();
          });
        }

        document.getElementById("addField").addEventListener("click", () => {
          addField();
          addInputListeners();
          updateMaximumDoses();
        });

        let productsId = 0;
        const productsForm = document.getElementById("products-container");
        const productInputs = Array.from(document.getElementsByClassName("removable-input-container--products"));

        productInputs.forEach((e) => {
          const id = productsId;
          productsId++;
          document.getElementById(`products-button-${id}`).addEventListener("click", () => {
            document.getElementById(`products-${id}`).remove();
          });
        });

        function addProduct() {
          productsId++;
          const id = productsId;
          const newInput = document.createElement("div");
          newInput.setAttribute("id", `products-${id}`);
          newInput.setAttribute("class", "removable-input-container removable-input-container--products");
          newInput.innerHTML = 
          `
          <div class="product">
            <div class="flex">
              <select name="protectionproduct[${id}][name]" class="input-protection">
                @foreach ($plantProtectionProducts as $product)
                <option value="{{ $loop->index }}">{{ $product->name }}</option>
                @endforeach
              </select>
              <button type="button" class="remove-button" id="products-button-${id}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path
                    fill-rule="evenodd"
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                  />
                </svg>
              </button>
            </div>
            <div class="info-text">Maksymalna dawka środka: <span class="max">0</span></div>
            <label>Ilość środka:<input class="input-quantity" type="number" min="0" name="protectionproduct[${id}][quantity]" /></label>
            l
          </div>
            `;
          productsForm.appendChild(newInput);
          document.getElementById(`products-button-${id}`).addEventListener("click", () => {
            document.getElementById(`products-${id}`).remove();
          });
        }
        
        document.getElementById("addProduct").addEventListener("click", () => {
          addProduct();
          addInputListeners()
          updateMaximumDoses();
        });

        const fieldsData = {!! json_encode($fields->toArray()) !!}
        const plantProtectionProductsData = {!! json_encode($plantProtectionProducts->toArray()) !!}

        function updateMaximumDoses()
        {
          const inputFields = Array.from(document.getElementsByClassName("input-field"));
          let sum = 0;
          inputFields.forEach((e) => {
            sum += fieldsData[e.value].field_area;
          })
          const products = Array.from(document.getElementsByClassName("product"));
          products.forEach((e) => {
            e.querySelector(".max").innerHTML = (plantProtectionProductsData[e.querySelector(".input-protection").value].maximum_dose * sum).toFixed(0);
          })
        }

        function addInputListeners() {
          const inputFields = Array.from(document.getElementsByClassName("input-field"));
          inputFields.forEach((e) => {
            e.addEventListener("change", updateMaximumDoses)
          })
          const inputProtections = Array.from(document.getElementsByClassName("input-protection"));
          inputProtections.forEach((e) => {
            e.addEventListener("change", updateMaximumDoses)
          })
        }

        updateMaximumDoses()
        addInputListeners()
      </script>
    </form>
  </div>
</div>
@endsection
