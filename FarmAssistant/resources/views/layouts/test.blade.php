<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Podawanie produktow</title>
    
<!-- JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $('#dynamicAdd').append('<tr><td><select name="addProtectionProduct[' + i +
        '][name]"> @foreach ($plantProtectionProducts as $product)<option value="{{ $product->id }}">{{ $product->name }}</option>@endforeach </select> 
        '</td><td><input type="number" name="addProtectionProduct[' + i + 
        '][quantity]" step="0.01" value="1"> l/kg </td> </tr>'
        );
    });
</script>
</head>
<body>
    @yield('content')


</body>
</html>