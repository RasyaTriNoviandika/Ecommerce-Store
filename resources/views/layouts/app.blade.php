<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ecommerce Store')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2 font-bold text-xl text-gray-900">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-white"></i>
                    </div>
                    <span>Store</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Home
                    </a>
                    @if(class_exists('App\Models\Category'))
                        @foreach(\App\Models\Category::take(4)->get() as $category)
                            <a href="{{ route('home', ['category' => $category->id]) }}" class="text-gray-700 hover:text-blue-600 font-medium">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <form action="{{ route('home') }}" method="GET" class="hidden lg:block">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Search..." 
                                class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </form>
                    
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                {{ array_sum(array_column(session('cart'), 'quantity')) }}
                            </span>
                        @endif
                    </a>
                    
                    <!-- User Menu -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center space-x-2 px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">
                                <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden lg:block">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg border shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50">
                                    Dashboard
                                </a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50">
                                    My Orders
                                </a>
                                @if(auth()->user()->is_admin ?? false)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 border-t">
                                    Admin Panel
                                </a>
                                @endif
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-3 text-red-600 hover:bg-red-50 border-t">
                                    Logout
                                </a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success') || session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-green-800 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <span class="text-red-800 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white"></i>
                        </div>
                        <span class="text-xl font-bold">Store</span>
                    </div>
                    <p class="text-gray-400">Your trusted online shopping destination for quality products.</p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white">Cart</a></li>
                        @auth
                            <li><a href="{{ route('orders.index') }}" class="hover:text-white">Orders</a></li>
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Categories</h3>
                    <ul class="space-y-2 text-gray-400">
                        @if(class_exists('App\Models\Category'))
                            @foreach(\App\Models\Category::take(4)->get() as $category)
                                <li><a href="{{ route('home', ['category' => $category->id]) }}" class="hover:text-white">{{ $category->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: support@store.com</li>
                        <li>Phone: +62 123 456 7890</li>
                        <li>Address: Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Ecommerce Store. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>