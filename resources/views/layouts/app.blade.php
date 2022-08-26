<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href={{asset('assets/css/select2.min.css')}} rel="stylesheet" />
        <!-- Scripts -->
        <script src={{asset('assets/js/select2.min.js')}}></script>
         <script src={{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}></script>
        <script src={{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}></script>
        <script src={{ asset('assets/js/bootstrap.min.js') }}></script>
        <script src={{ asset('assets/js/jquery.flexslider.js') }}></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        @include('components.alerts')
    </body>
</html>
