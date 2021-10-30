
<h1>Dodaj zabieg</h1>

<form action="{{ route('practise.store', [$idFarm]) }}" method="POST">
    @csrf
    <div id="practise-container">
        <label for="">Nazwa zabiegu:</label>
        <input type="text" name="practise_name">
        <br>
        <div id="field-container">
            <label for="">Pole</label>
            <select name="fields[]">
                @foreach ($fields as $field)
                    <option value="{{ $field->id }}">{{ $field->field_name }}  <label for="">{{ $field->field_area }} ha</label></option>
                @endforeach
            </select>
        <button type="button" name="addFieldButton" id="addField">Dodaj pole</button>
        <br>
        </div>
        <div id="product-container">
            <label for="">Nazwa środka:</label>
            <select name="protectionproduct[0][name]">
                @foreach ($plantProtectionProducts as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <button type="button" name="addProductButton" id="addProduct">Dodaj pole</button>
            <br>
            <label for="">Maksymalna dawka środka: tutaj bierzemy z js wartość</label>    
            <br>
            <label for="">Ilość środka: </label>
            <input type="numeric" name="protectionproduct[0][quantity]"> l
    <br>
        </div>
    <br>
    
    <label for="">Ilość wody: </label>
    <input type="numeric" step="10" value="1000"> l
    <br>
        </div>
        
    <button type="submit">Dodaj</button>
    <script>
        let productsId = 0;
        let fieldForm = document.getElementById("field-container");
        let practiseForm = document.getElementById("product-container");
        function addField()
        {
            fieldForm.innerHTML += `
            <label for="">Pole</label>
            <select name="fields[]">
            @foreach ($fields as $field)
                <option value="{{ $field->id }}">{{ $field->field_name }}  <label for="">{{ $field->field_area }} ha</label></option>
            @endforeach
            </select>
            <br>
           
            `
        }
        document.getElementById("addField").addEventListener("click", addField);

        function addProduct()
        {
            productsId++;
            practiseForm.innerHTML += `
                <label for="">Nazwa środka:</label>
                <select name="protectionproduct[${productsId}][name]">
                    @foreach ($plantProtectionProducts as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Ilość środka: </label>
                <input type="numeric" name="protectionproduct[${productsId}][quantity]"> l
                <br>
            `
        }
        document.getElementById("addProduct").addEventListener("click", addProduct);
    </script>
</form>