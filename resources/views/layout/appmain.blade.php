<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HRM @yield("title")</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon.png') }}" rel="apple-touch-icon">

    <!-- Tailwind CSS -->
    <script src="{{ asset('js/tailwind.js') }}"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .active-link {
            @apply bg-blue-100 text-blue-700;
        }

        .sidebar a:hover {
            @apply bg-blue-50 text-blue-600;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    @yield('style')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col" x-data="{ sidebarOpen: false }">

    <!-- ======= Header ======= -->
    <header class="bg-white shadow-sm fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">

            <!-- Mobile Sidebar Toggle -->
            <button class="md:hidden text-gray-700 focus:outline-none" @click="sidebarOpen = true">
                <i class="bi bi-list text-2xl"></i>
            </button>

            <!-- Logo -->
            <a href="{{ url('/dashboard') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo" class="w-10 h-10 rounded-md">
                <span class="text-xl font-bold text-blue-600">HRM<span class="text-gray-900">T</span></span>
            </a>

            <!-- Search -->
            <div class="hidden md:flex">
                <form class="flex items-center bg-gray-100 rounded-lg overflow-hidden">
                    <input type="text" name="query" placeholder="Search..."
                        class="px-3 py-1 bg-gray-100 focus:outline-none w-64">
                    <button type="submit" class="px-3 text-gray-600 hover:text-blue-600">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profileDropdownBtn"
                    class="flex items-center focus:outline-none space-x-2 hover:bg-gray-100 rounded-full px-3 py-1 transition">
                    <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/avater.jpg') }}"
                        alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    <span class="hidden md:inline text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="profileDropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border py-2 text-sm">
                    <a href="{{ url('users-profile') }}" class="block px-4 py-2 hover:bg-gray-100">My Profile</a>
                    <a href="{{ url('changepassword') }}" class="block px-4 py-2 hover:bg-gray-100">Change Password</a>
                    <a href="{{ url('users-profile') }}" class="block px-4 py-2 hover:bg-gray-100">Account Settings</a>
                    <a href="{{ url('pages-faq.html') }}" class="block px-4 py-2 hover:bg-gray-100">Need Help?</a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">@csrf</form>
                    <button onclick="document.getElementById('logout-form').submit()"
                        class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Sign Out</button>
                </div>
            </div>
        </div>
    </header>

    <!-- ======= Sidebar ======= -->
    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition class="fixed inset-0 bg-black/30 z-40 md:hidden"
        x-cloak></div>

    <aside class="sidebar bg-white w-64 fixed top-16 left-0 h-[calc(100vh-4rem)] overflow-y-auto border-r scrollbar-hide
                  transform transition-transform duration-300 z-50"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full' md:translate-x-0">
        @include('layout.menu')
    </aside>

    <!-- ======= Main Content ======= -->
    <main class="flex-1 mt-16 md:ml-64 p-6 transition-all duration-300">
        @yield('mainContent')
    </main>

    <!-- ======= Footer ======= -->
    <footer class="bg-white shadow-inner py-4 mt-auto text-center">
        <div class="text-sm text-gray-600">
            &copy; {{ date('Y') }} <strong>SRL-AMS</strong> — Designed by
            <a href="https://srl.com.bd/" target="_blank" class="text-blue-600 hover:underline">SRL</a>
        </div>
    </footer>

    <!-- ======= Scripts ======= -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Profile dropdown toggle
        const dropdownBtn = document.getElementById("profileDropdownBtn");
        const dropdownMenu = document.getElementById("profileDropdown");

        dropdownBtn.addEventListener("click", () => {
            dropdownMenu.classList.toggle("hidden");
        });

        window.addEventListener("click", function(e) {
            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });

        // Reusable function for showing validation errors
        function showErrors(errors) {
            $(".border-red-500").removeClass("border-red-500");
            $(".error-text").remove();

            $.each(errors, function(key, messages) {
                const input = $("#" + key);
                input.addClass("border-red-500");
                input.after(`<p class="text-red-500 text-xs mt-1 error-text">${messages[0]}</p>`);
            });
        }
    </script>

    @yield('script')
</body>

</html>