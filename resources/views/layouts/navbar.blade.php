<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex">

<!-- Sidebar -->
<aside id="sidebar"
       class="w-64 bg-white shadow-md h-screen fixed left-0 top-0 flex flex-col transform transition-transform duration-300 -translate-x-full md:translate-x-0 z-20">
    <div class="px-6 py-6 border-b border-gray-200 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-blue-600 flex items-center space-x-2">
            <!-- Home icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9v9a3 3 0 01-3 3h-3v-6H9v6H6a3 3 0 01-3-3v-9z"/>
            </svg>
            <span>Stay-Review</span>
        </h1>
        <button id="closeSidebar" class="md:hidden text-gray-600 text-xl font-bold">&times;</button>
    </div>

    <nav class="flex-1 px-4 py-6">
        <ul class="space-y-4 text-gray-700 font-medium">
            @if(auth()->check() && auth()->user()->role === 'user')
                <li>
                    <a href="{{ route('user.dashboard') }}"
                       class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('user.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-7-7v18" />
                        </svg>
                        Dashboard
                    </a>
                </li>
            @endif

            @if(auth()->check() && auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('properties.index') }}"
                       class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('properties.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M5 6h14l1 5H4l1-5z" />
                        </svg>
                        Manage Properties
                    </a>
                </li>
                    @if(auth()->check() && auth()->user()->role === 'user')
                        <li> <a href="{{ route('properties.provinces') }}" class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('properties.*') ? 'bg-blue-50 text-blue-600' : '' }}"> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11.955 11.955 0 0112 15c2.8 0 5.366.978 7.379 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" /> </svg>
                            Properties based on provinces </a>
                    </li> @endif

                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6-10a5 5 0 11-10 0 5 5 0 0110 0z" />
                        </svg>
                        Manage Users
                    </a>
                </li>

                <li>
                    <a href="#reviews"
                       class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Manage Reviews
                    </a>
                </li>

                <li>
                    <a href="#verify-properties"
                       class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                        </svg>
                        Verify Properties
                    </a>
                </li>
            @endif

            <!-- Profile -->
            <li>
                <a href="{{ route('profile.index') }}"
                   class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11.955 11.955 0 0112 15c2.8 0 5.366.978 7.379 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Profile
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a href="{{ route('settings.index') }}"
                   class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('settings.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Settings
                </a>
            </li>

            <!-- Legal -->
            <li>
                <a href="{{ route('legal') }}"
                   class="flex items-center py-2 px-3 rounded hover:bg-blue-100 hover:text-blue-600 transition {{ request()->routeIs('legal') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 12h.01M12 12a9 9 0 11-9 9 9 9 0 019-9z" />
                    </svg>
                    Legal
                </a>
            </li>
        </ul>
    </nav>

    <div class="px-6 py-4 border-t border-gray-200">
        <button id="logoutBtn" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
            Logout
        </button>
    </div>
</aside>

<!-- Overlay (mobile only) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden z-10"></div>

<!-- Main Content -->
<main class="flex-1 md:ml-64 p-6 transition-all duration-300">
    <!-- Hamburger Button (mobile only) -->
    <button id="openSidebar" class="md:hidden mb-4 text-gray-700 text-2xl">&#9776;</button>

    @yield('content')
</main>

<!-- Logout Modal -->
<div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-30">
    <div class="bg-white rounded-lg shadow-lg w-80 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Confirm Logout</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to logout?</p>
        <div class="flex justify-end space-x-4">
            <button id="cancelLogout" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition">Cancel</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600 transition">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const openSidebar = document.getElementById('openSidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogout = document.getElementById('cancelLogout');

    // Sidebar toggle
    openSidebar.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });
    closeSidebar.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    // Logout modal
    logoutBtn.addEventListener('click', () => {
        logoutModal.classList.remove('hidden');
    });
    cancelLogout.addEventListener('click', () => {
        logoutModal.classList.add('hidden');
    });
    logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) {
            logoutModal.classList.add('hidden');
        }
    });
</script>

</body>
</html>
