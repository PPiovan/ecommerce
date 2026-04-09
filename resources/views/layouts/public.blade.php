<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MiTienda')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <style>
    [x-cloak] { display: none !important; }
    </style>
    <div class="flex min-h-screen flex-col">
        @include('partials.public.header')
        @include('partials.public.navbar')

        <main class="flex-1">
            @yield('content')
        </main>

        @include('partials.public.footer')
    </div>
</body>
</html>