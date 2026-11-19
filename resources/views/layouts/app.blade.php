<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bandung Computer') }}</title>

        <link rel="icon" href="{{ asset('icons/logo_bandung_computer.png') }}" type="image/png" />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Sembunyikan scrollbar bawaan browser (Chrome, Brave, Edge, Safari) */
            html::-webkit-scrollbar,
            body::-webkit-scrollbar {
                display: none;
            }

            /* Sembunyikan scrollbar bawaan browser (Firefox & Edge lama) */
            html,
            body {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC]">
        <!-- Menggunakan flex container agar sidebar dan main content berdampingan dengan benar -->
        <div class="min-h-screen flex">
            <x-sidebar />

            <!-- Main Content Area: Menggunakan flex-1 dan min-w-0 agar lebarnya menyesuaikan sisa layar secara fleksibel -->
            <main class="flex-1 min-w-0 ml-56 px-8 py-5">
                @yield('content')
            </main>
        </div>
    </body>
</html>