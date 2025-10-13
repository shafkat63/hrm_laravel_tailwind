<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HRM - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/logo.svg">
    <script src="{{ asset('js/tailwind.js') }}"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Smooth Scrolling -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-inter bg-white text-gray-800 flex flex-col min-h-screen">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/">
                <h1 class="text-2xl font-bold text-blue-600">HR<span class="text-gray-800">M</span></h1>
            </a>
            <nav class="space-x-6 hidden md:block">
                <a href="#features" class="hover:text-blue-600 font-medium">Features</a>
                <a href="#about" class="hover:text-blue-600 font-medium">About</a>
                <a href="#pricing" class="hover:text-blue-600 font-medium">Pricing</a>
                <a href="#contact" class="hover:text-blue-600 font-medium">Contact</a>
            </nav>
            <a href="/login"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all">Login</a>
        </div>
    </header>

    <main class="flex-grow px-4 py-6 pt-12">
        @yield('mainContent')
    </main>

    <footer class="bg-gray-100 border-t">
        <div
            class="max-w-screen-xl mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
            <p class="mb-2 sm:mb-0">&copy; 1999–2025 S.</p>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="goToTop" class="fixed bottom-5 right-5 w-11 h-11 flex items-center justify-center text-white text-lg 
    bg-gradient-to-r from-lime-400 via-lime-500 to-green-500 
    rounded-full shadow-lg hover:from-lime-500 hover:to-green-600 
    transition-all duration-300 transform hover:scale-110 
    opacity-0 cursor-pointer">
        <i class="fas fa-chevron-up"></i>
    </button>


    @yield('scripts')

    <!-- Back to Top Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('goToTop');
            window.addEventListener('scroll', () => {
                btn.classList.toggle('opacity-100', window.scrollY > 300);
            });
            btn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
</body>

</html>