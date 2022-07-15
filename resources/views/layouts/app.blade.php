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
   <!--     <link rel="stylesheet" href="{{ asset('css/app.css') }}">-->

        @livewireStyles

        <!-- Scripts -->
      <script src="{{ mix('js/app.js') }}" defer></script>
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
                        <div class="grid grid-cols-4 gap-1">
                            <div class="flex justify-end">
                                <img src="{{URL::asset('app/logo_bcv.jpg')}}" class="flex-shrink-0 h-10"/>
                            </div>
                            <div class="flex items-center"><label><strong>{{$tasa_del_dia}}</strong></label></div>
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
