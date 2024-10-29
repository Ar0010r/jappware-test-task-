<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Deposits</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
       
    </head>
    <body class="bg-gray-100 font-sans leading-normal tracking-normal">
    
   
    <div class="container mx-auto px-8 py-8">
        <!-- Heading -->
        <h1 class="text-2xl font-bold mb-4 mt-4">Deposits List</h1>

        @include('deposit.filters')

        <div id="deposits-table">
            <x-bladewind::table
                celled="true"
                divider="thin"
                :data="$data"
            />
        

            <div class="flex justify-end mb-4">
                {{ $pagination->links() }}
            </div>
        </div>
    </div> 
</body>
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr for the DateTime picker
        flatpickr("#date_from-filter", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        flatpickr("#date_to-filter", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script>
</html>
