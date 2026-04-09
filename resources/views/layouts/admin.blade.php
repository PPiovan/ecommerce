<!DOCTYPE html>
<html lang="es" x-data="darkMode()" x-init="init()" :class="{ 'dark': dark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function darkMode() {
            return {
                dark: false,
                init() {
                    const saved = localStorage.getItem('darkMode');

                    if (saved !== null) {
                        this.dark = saved === 'true';
                    } else {
                        this.dark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }
                },
                toggle() {
                    this.dark = !this.dark;
                    localStorage.setItem('darkMode', this.dark);
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 text-slate-800 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">
    <div class="min-h-screen flex">
        @include('partials.admin.sidebar')

        <main class="flex-1 bg-slate-50 p-6 dark:bg-slate-950">
            @yield('content')
        </main>
    </div>
</body>
</html>