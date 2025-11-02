<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        {{-- Poppins Font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Poppins', sans-serif !important;
            }
             /* CSS Kustom (Input abu & hover tombol) */
             input[type=text], input[type=password] {
                 background-color: #F3F4F6 !important; /* bg-gray-100 */
                 color: #374151 !important; /* text-gray-700 */
             }
             button.hover\:bg-gray-600:hover {
                  background-color: #4B5563 !important; /* bg-gray-600 */
             }
              button.bg-gray-700 {
                  background-color: #374151 !important; /* bg-gray-700 */
              }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- Background Utama Abu Terang, Padding p-4, dan Konten di Tengah --}}
        <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
            {{ $slot }} {{-- Slot akan diisi oleh login.blade.php --}}
        </div>
    </body>
</html>