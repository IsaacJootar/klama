@if ($errors->any())
    @php
<<<<<<< HEAD
        // Combine all errors into a single string and deliver to toastr library
=======
        // Combine all errors into a single string
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
        $errorMessages = implode('<br>', $errors->all());
        toastr()->warning($errorMessages); // Pass all errors at once
    @endphp
@endif
