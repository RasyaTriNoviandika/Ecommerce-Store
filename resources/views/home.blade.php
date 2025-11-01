@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section with Better Visual -->
    <div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 text-white py-20 mb-12 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 animate-pulse">Welcome to Ecommerce Store</h1>
            <p class="text-xl md:text-2xl mb-10 text-blue-100 font-medium">Discover amazing products at unbeatable prices</p>
            <form action="{{ route('home') }}" method="GET" class="max-w-3xl mx-auto">
                <div class="flex flex-col sm:flex-row gap-3 bg-white/20 backdrop-blur-lg rounded-2xl p-2 shadow-2xl">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search for products..." 
                        class="flex-1 px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-4 focus:ring-white/50 font-medium placeholder-gray-500"
                    >
                    <button type="submit" class="bg-white text-purple-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-search mr-2"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Categories with Better Design -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Shop by Category</h2>
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->id]) }}" class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 text-center overflow-hidden transform hover:-translate-y-2">
                        <!-- Background gradient on hover -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Icon container -->
                        <div class="relative z-10 w-20 h-20 bg-gradient-to-br from-blue-400 to-purple-400 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <i class="fas fa-box text-white text-3xl"></i>
                        </div>
                        
                        <!-- Text content -->
                        <div class="relative z-10">
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-white transition-colors duration-300">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-500 group-hover:text-blue-100 transition-colors duration-300 mt-2 font-medium">{{ $category->products->count() }} products</p>
                        </div>
                        
                        <!-- Decorative element -->
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Filter Bar with Better Style -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-10 border border-gray-100">
            <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search products..." 
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                    >
                </div>
                <select 
                    name="category" 
                    class="px-6 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all bg-white font-medium"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl hover:shadow-2xl transition-all font-bold transform hover:scale-105">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </form>
        </div>

        <!-- Products Grid with Enhanced Design -->
        @if($products->count() > 0)
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">All Products</h2>
                <div class="flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-full">
                    <i class="fas fa-box text-blue-600"></i>
                    <p class="text-blue-700 font-semibold">{{ $products->total() }} products found</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1 border border-gray-100">
                        <!-- Product Image Container -->
                        <div class="relative overflow-hidden bg-gray-100">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-gray-200 via-gray-300 to-gray-400 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-6xl"></i>
                                </div>
                            @endif
                            
                            <!-- Stock Badge -->
                            @if($product->stock <= 5 && $product->stock > 0)
                                <span class="absolute top-4 left-4 bg-red-500 text-white px-4 py-2 rounded-full text-xs font-bold shadow-lg animate-pulse">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Low Stock!
                                </span>
                            @elseif($product->stock == 0)
                                <span class="absolute top-4 left-4 bg-gray-600 text-white px-4 py-2 rounded-full text-xs font-bold shadow-lg">
                                    <i class="fas fa-times-circle mr-1"></i>Out of Stock
                                </span>
                            @else
                                <span class="absolute top-4 left-4 bg-green-500 text-white px-4 py-2 rounded-full text-xs font-bold shadow-lg">
                                    <i class="fas fa-check-circle mr-1"></i>In Stock
                                </span>
                            @endif
                            
                            <!-- Quick Action Buttons -->
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex gap-2">
                                <button class="bg-white p-3 rounded-full shadow-lg hover:bg-red-50 text-red-500 hover:text-red-600 transition-all">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="bg-white p-3 rounded-full shadow-lg hover:bg-blue-50 text-blue-500 hover:text-blue-600 transition-all">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            
                            <!-- Category Badge -->
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-white/90 backdrop-blur-sm text-blue-600 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2 text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[3rem]">
                                {{ $product->name }}
                            </h3>
                            
                            <!-- Price and Stock -->
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                @if($product->stock > 0)
                                    <span class="text-xs text-gray-600 bg-gray-100 px-3 py-1 rounded-full font-semibold">
                                        <i class="fas fa-check-circle text-green-500 mr-1"></i>{{ $product->stock }} left
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                <a href="{{ route('product.show', $product->slug) }}" class="flex-1 bg-blue-600 text-white text-center px-4 py-3 rounded-xl hover:bg-blue-700 transition-all font-semibold transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-eye mr-2"></i> View Details
                                </a>
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-3 rounded-xl hover:shadow-2xl transition-all font-semibold transform hover:scale-105">
                                            <i class="fas fa-cart-plus mr-2"></i> Add
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-500 px-4 py-3 rounded-xl cursor-not-allowed font-semibold">
                                        <i class="fas fa-ban mr-2"></i> Sold Out
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-xl shadow-lg p-4">
                    {{ $products->links() }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-xl p-16 text-center border border-gray-100">
                <div class="max-w-md mx-auto">
                    <div class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-gray-400 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No products found</h3>
                    <p class="text-gray-600 mb-8">Try adjusting your search or filter criteria</p>
                    <a href="{{ route('home') }}" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl hover:shadow-2xl transition-all font-bold transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i> View All Products
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
