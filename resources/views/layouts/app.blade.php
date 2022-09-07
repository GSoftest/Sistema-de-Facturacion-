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
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select.css') }}">
    <!--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
   <!--     <link rel="stylesheet" href="{{ asset('css/app.css') }}">-->
       
        @livewireStyles

        <!-- Scripts -->
      <script src="{{ mix('js/app.js') }}" defer></script>
      <script src="{{ asset('js/validacion.js') }}" defer></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--   <script src="{{ asset('js/app.js') }}" defer></script>-->
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 grid grid-cols-2 gap-1">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="flex items-center">
                                <div class="px-1"><img src="{{URL::asset('app/logo_bcv.jpg')}}" class="flex-shrink-0 h-10"/></div>
                                <div><label><strong>{{$tasa_BCV}}</strong></label></div>

                            </div>
                            <div class="flex justify-start">
                            </div>
                                <div></div>
                        </div>
                        <div class="grid grid-cols-4 gap-1">
                            <div></div>
                            <div></div>
                        <div class="flex items-center justify-end">
                            <label><strong>Tasa activa:</strong></label>
                        </div>
                          <div class="flex items-center"><label><strong>USD {{str_replace(".",",",$tasa_del_dia)}}</strong></label></div>
                        </div>
                 <!--      {{ $header }}-->
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
