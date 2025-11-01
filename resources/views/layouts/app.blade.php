<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ecommerce Store') - Your Online Shopping Destination</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Enhanced Navigation -->
    <nav class="bg-white/95 backdrop-blur-md shadow-xl sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fas fa-shopping-bag text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Ecommerce Store
                        </span>
                    </a>
                    <div class="hidden lg:flex items-center space-x-1">
                        <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold transition-all">
                            <i class="fas fa-home mr-2"></i>Home
                        </a>
                        @if(class_exists('App\Models\Category'))
                            @foreach(\App\Models\Category::take(4)->get() as $category)
                                <a href="{{ route('home', ['category' => $category->id]) }}" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold transition-all">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <!-- Enhanced Search Bar -->
                    <form action="{{ route('home') }}" method="GET" class="hidden md:block">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Search products..." 
                                class="w-72 pl-12 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all bg-gray-50 hover:bg-white"
                            >
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </form>
                    
                    <!-- Enhanced Cart Button -->
                    <a href="{{ route('cart.index') }}" class="relative p-3 text-gray-700 hover:text-blue-600 transition-all rounded-xl hover:bg-blue-50 group">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-bold shadow-lg animate-pulse">
                                {{ array_sum(array_column(session('cart'), 'quantity')) }}
                            </span>
                        @endif
                    </a>
                    
                    <!-- Enhanced User Menu -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:text-blue-600 transition-all rounded-xl hover:bg-blue-50 font-semibold">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden lg:block">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-gray-100 overflow-hidden">
                                <div class="py-2">
                                    <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-purple-50 border-b">
                                        <p class="font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                        <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                                    </div>
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                        <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i> Dashboard
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                        <i class="fas fa-shopping-bag mr-3 text-purple-600"></i> My Orders
                                    </a>
                                    @if(auth()->user()->is_admin ?? false)
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all border-t">
                                        <i class="fas fa-cog mr-3 text-green-600"></i> Admin Panel
                                    </a>
                                    @endif
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-3 text-red-600 hover:bg-red-50 transition-all border-t font-semibold">
                                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                    </a>
                                </div>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-gray-700 hover:text-blue-600 font-semibold transition-all rounded-xl hover:bg-blue-50">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2.5 rounded-xl hover:shadow-xl transition-all font-bold transform hover:scale-105">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Enhanced Flash Messages -->
    @if(session('success') || session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-slide-down">
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 rounded-xl shadow-lg flex items-center animate-pulse">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <span class="text-green-800 font-bold text-lg">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 p-4 rounded-xl shadow-lg flex items-center animate-pulse">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation text-white"></i>
                    </div>
                    <span class="text-red-800 font-bold text-lg">{{ session('error') }}</span>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Enhanced Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-extrabold">Ecommerce Store</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-4">Your trusted online shopping destination for quality products at great prices. Shop smart, shop easy!</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-all">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-400 transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-pink-600 transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-6">Quick Links</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>Home</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>Shopping Cart</a></li>
                        @auth
                            <li><a href="{{ route('orders.index') }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>My Orders</a></li>
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>Dashboard</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-6">Categories</h3>
                    <ul class="space-y-3 text-gray-400">
                        @if(class_exists('App\Models\Category'))
                            @foreach(\App\Models\Category::take(4)->get() as $category)
                                <li><a href="{{ route('home', ['category' => $category->id]) }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>{{ $category->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-6">Contact Us</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-blue-400 mr-3"></i>
                            support@ecommerce.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-blue-400 mr-3"></i>
                            +62 123 456 7890
                        </li>
                        <li class="flex items-start mt-4">
                            <i class="fas fa-map-marker-alt text-blue-400 mr-3 mt-1"></i>
                            <span>123 Shopping Street, Jakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} Ecommerce Store. All rights reserved. Made with <i class="fas fa-heart text-red-500"></i> for shoppers.</p>
            </div>
        </div>
    </footer>
</body>
</html>
