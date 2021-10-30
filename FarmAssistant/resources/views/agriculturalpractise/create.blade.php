
<h1>Dodaj zabieg</h1>

<form action="{{ route('practise.store', [$idFarm]) }}" method="POST">
    @csrf
    <label for="">Nazwa zabiegu:</label>
    <input type="text" name="practise_name">
    <br>
    <label for="">Pole</label>
    <select name="addField[0]">
        @foreach ($fields as $field)
            <option value="{{ $field->id }}">{{ $field->field_name }}  <label for="">{{ $field->field_area }} ha</label></option>
        @endforeach
    </select>
    <br>
    <button type="button" name="add" id="dynamic-ar">Dodaj pole</button>
    <label for="">Pole</label>
    <select name="field2" id="field2">
        @foreach ($fields as $field)
            <option value="{{ $field->id }}">{{ $field->field_name }}  <label for="">{{ $field->field_area }} ha</label></option>
        @endforeach
    </select>
    <br>
    <label for="">Nazwa środka:</label>
    <select name="protectionproduct1" id="protectionproduct">
        @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>
    <br>
    <label for="">Maksymalna dawka środka: tutaj bierzemy z js wartość</label>
    <script>
        var e = document.getElementById("ProtectionProduct");
        var product = e.value;
        console.log(product);
    </script>
    <br>
    <label for="">Ilość środka: </label>
    <input type="numeric"> l
    <br>
    <label for="">Nazwa środka:</label>
    <select name="protectionproduct2" id="protectionproduct">
        @foreach ($plantProtectionProducts as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>
    <br>
    <label for="">Maksymalna dawka środka: tutaj bierzemy z js wartość</label>
    <script>
        var e = document.getElementById("ProtectionProduct");
        var product = e.value;
        console.log(product);
    </script>
    <br>
    <label for="">Ilość środka: </label>
    <input type="numeric"> l
    <br>
    
    
    
    
    <label for="">Ilość wody: </label>
    <input type="numeric" step="10" value="1000"> l
    <br>
    <button type="submit">Dodaj</button>
</form>