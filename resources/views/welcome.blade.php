<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library Management System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Livewire Style --}}
    @livewireStyles

    {{-- Datatables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>

<body>

    <div class="container">
        @yield('content')
    </div>


    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Datatable Script --}}
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    {{-- Livewire Script --}}
    @livewireScripts

    @yield('script')


</body>

</html>
