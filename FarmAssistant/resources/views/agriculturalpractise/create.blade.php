@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm]) @section('content')
<div class="create-container practise">
  <div class="content">
    <h1>Dodaj zabieg</h1>
    <form action="{{ route('practise.store', [$idFarm]) }}" method="POST">
      @csrf
      <input type="text" name="practise_name" placeholder="Nazwa zabiegu" value="{{ old('practise_name') }}" class="input-name" id="field-name"/>
      @error('practise_name')
      <div id="error-name" style="color: red">{{ $message }}</div>
      @enderror
      <br />
      <h2>Data zabiegu:</h2>
      <input type="datetime-local" name="start" class="input-data" id="start-data"/>
      @error('start')
        <div id="error-start" style="color: red">{{ $message }}</div>
      @enderror
      <h2>Wybrane pola:</h2>
      <div id="fields-container">
        <div class="removable-input-container removable-input-container--first">
          <select name="fields[]" class="input-field"> 
            @foreach ($fields as $field)
            <option value="{{ $field->id}}">
              {{ $field->field_name }} {{ $field->field_area }} ha
            </option>
            @endforeach
          </select>
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
      <button type="button" name="addFieldButton" id="addField">Dodaj pole</button>
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
          <div class="info-text">Sugerowana dawka środka: <span class="max">0</span></div>
          <label>Ilość środka:<input class="input-quantity" type="number" min="0" max="150" name="protectionproduct[0][quantity]" id="protectionproduct[0][quantity]"/></label>
          l
          @error('protectionproduct.0.quantity')
          <div id="error-quantity" style="color: red"> {{ $message }}</div>
          @enderror
        </div>
      </div>
      <button type="button" name="addProductButton" id="addProduct">Dodaj środek</button>

      <label
        >Ilość wody:
        <input type="number" name="water" step="10" value="1000" min="0" />
      </label>

      l
      <button type="submit" class="submit">Dodaj zabieg</button>
      <script>
        const errorEl = document.getElementById("error-name");
        const fieldNameEl = document.getElementById("field-name");
        fieldNameEl.addEventListener("focus", () => errorEl.classList.add("hidden"));

        const errorStartEl = document.getElementById("error-start");
        const startEl = document.getElementById("start-data");
        startEl.addEventListener("focus", () => errorStartEl.classList.add("hidden"));

        const errorQuantityEl = document.getElementById("error-quantity");
        const quantityEl = document.getElementById("protectionproduct[0][quantity]");
        quantityEl.addEventListener("focus", () => errorQuantityEl.classList.add("hidden"));


        let fieldsId = 0;
        const fieldForm = document.getElementById("fields-container");

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
            <option value="{{ $field->id }}">{{ $field->field_name }} {{ $field->field_area }} ha</option>
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
                <option value="{{ $product->id }}">{{ $product->name }}</option>
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
            <div class="info-text">Sugerowana dawka środka: <span class="max">0</span></div>
            <label>Ilość środka:<input class="input-quantity" type="number" min="0" name="protectionproduct[${id}][quantity]" /></label>
            l
            @error('protectionproduct.${id}.quantity')
            <div>{{ $message }}</div>
            @enderror
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
            for(let i = 0; i < fieldsData.length; i++)
            {
              if(e.value == fieldsData[i].id){
                sum += fieldsData[i].field_area;
              } 
            }
          })
          const products = Array.from(document.getElementsByClassName("product"));
          products.forEach((e) => {
            for(let i = 0; i < plantProtectionProductsData.length; i++)
            {
              if(e.querySelector(".input-protection").value == plantProtectionProductsData[i].id){
                e.querySelector(".max").innerHTML = (plantProtectionProductsData[i].maximum_dose * sum).toFixed(2) + "l";


              } 
            }
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