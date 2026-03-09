<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
  data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template" data-style="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="stylesheet"  href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
<<<<<<< HEAD
     <!-- loader CSS -->
=======
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
     <link rel="stylesheet"  href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" class="template-customizer-core-css" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet"  href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />

  <!-- Core CSS -->
</head>

<body>

    {{ $slot }}


</body>

</html>

<!-- beautify ignore:end -->
