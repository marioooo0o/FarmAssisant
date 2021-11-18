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
      <h2>Wybrane pola:</h2>
      <div id="fields-container">
        <select name="fields[]" class="input-field">
          {{-- Do zrobienia w przyszłości
            
            @if (old('fields')!=null)
              @foreach (old('fields') as $fieldOld)
                <option value="{{ $fields[$fieldOld] }}" selected>
                  {{ $fields[$fieldOld]->field_name }} {{ $fields[$fieldOld]->field_area }} ha
                </option>
              @endforeach
            @else
            @dump('nie ma mnie')
                @endif
              
            --}}
              @foreach ($fields as $field)
              <option value="{{ $field->id }}">
                {{ $field->field_name }} {{ $field->field_area }} ha
              </option>
              @endforeach
        </select>
      </div>
      <button type="button" name="addFieldButton" id="addField">
        Dodaj pole
      </button>
      <h2>Wybrane środki:</h2>
      <div id="products-container">
        <div class="product">
          <select name="protectionproduct[0][name]" class="input-protection">
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
              name="protectionproduct[0][quantity]"
          /></label>
          l
        </div>
      </div>
      <button type="button" name="addProductButton" id="addProduct">
        Dodaj środek
      </button>
      <label>Ilość wody: <input type="number" name="water" step="10" value="1000" /> </label>
      l
      <button type="submit" class="submit">Dodaj zabieg</button>
      <script>
        let productsId = 0;
        let fieldForm = document.getElementById("fields-container");
        let practiseForm = document.getElementById("products-container");
        function addField() {
          fieldForm.innerHTML += `
                <select name="fields[]" class="input-field">
                    @foreach ($fields as $field)
                    <option value="{{ $field->id }}">
                      {{ $field->field_name }} {{ $field->field_area }} ha
                    </option>
                    @endforeach
                </select>
                `;
        }
        document.getElementById("addField").addEventListener("click", addField);

        function addProduct() {
          productsId++;
          practiseForm.innerHTML += `
					<div class="product">
          <select name="protectionproduct[${productsId}][name]" class="input-protection">
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
              name="protectionproduct[${productsId}][quantity]"
          /></label>
          l
        </div>
          `;
        }
        document
          .getElementById("addProduct")
          .addEventListener("click", addProduct);
      </script>
    </form>
  </div>
</div>
@endsection
