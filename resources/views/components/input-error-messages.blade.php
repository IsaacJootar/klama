@if ($errors->any())
    @php
        // Combine all errors into a single string and deliver to toastr library
        $errorMessages = implode('<br>', $errors->all());
        toastr()->warning($errorMessages); // Pass all errors at once
    @endphp
@endif
