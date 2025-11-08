<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        {{-- Poppins Font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Poppins', sans-serif !important;
                background-color: #D9D9D9 !important; 
            }
            input[type=text], input[type=password] {
                 background-color: #F3F4F6 !important; /* bg-gray-100 */
                 color: #374151 !important; /* text-gray-700 */
             }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antbiased">
        {{-- 
          INI BAGIAN PENTING:
          Div ini bertugas memusatkan kartu login di tengah layar
          secara vertikal (items-center) dan horizontal (justify-center).
        --}}
        <div class="min-h-screen flex items-center justify-center p-4 md:p-12">
            {{ $slot }} {{-- Slot ini akan diisi oleh login.blade.php --}}
        </div>
    </body>
</html>