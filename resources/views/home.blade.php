@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gray-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl font-bold mb-4">Welcome to Our Store</h1>
                <p class="text-xl text-gray-300 mb-8">Discover amazing products at great prices</p>
                
                <!-- Search Bar -->
                <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search products..." 
                            class="flex-1 px-6 py-4 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition font-medium">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Categories -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Categories</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->id]) }}" 
                       class="bg-white p-6 rounded-lg border-2 border-gray-200 hover:border-blue-500 hover:shadow-lg transition text-center group">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-50 transition">
                            <i class="fas fa-box text-2xl text-gray-600 group-hover:text-blue-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $category->products->count() }} items</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
            <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search products..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                <select 
                    name="category" 
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                    Apply
                </button>
            </form>
        </div>

        <!-- Products -->
        @if($products->count() > 0)
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900">Products</h2>
                <p class="text-gray-600 mt-1">{{ $products->total() }} products found</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-xl transition group">
                        <!-- Image -->
                        <div class="relative aspect-square bg-gray-100">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-5xl"></i>
                                </div>
                            @endif
                            
                            <!-- Stock Badge -->
                            @if($product->stock <= 5 && $product->stock > 0)
                                <span class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    Low Stock
                                </span>
                            @elseif($product->stock == 0)
                                <span class="absolute top-3 left-3 bg-gray-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    Out of Stock
                                </span>
                            @endif
                            
                            <!-- Category -->
                            <span class="absolute bottom-3 left-3 bg-white text-gray-700 px-3 py-1 rounded-full text-xs font-medium border border-gray-200">
                                {{ $product->category->name }}
                            </span>
                        </div>
                        
                        <!-- Info -->
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-gray-900 mb-2 line-clamp-2 h-14">
                                {{ $product->name }}
                            </h3>
                            
                            <p class="text-2xl font-bold text-gray-900 mb-4">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('product.show', $product->slug) }}" class="flex-1 bg-gray-100 text-gray-900 text-center px-4 py-2 rounded-lg hover:bg-gray-200 transition font-medium">
                                    View
                                </a>
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="flex-1 bg-gray-300 text-gray-500 px-4 py-2 rounded-lg cursor-not-allowed font-medium">
                                        Sold Out
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg border border-gray-200 p-16 text-center">
                <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No products found</h3>
                <p class="text-gray-600 mb-6">Try adjusting your search or filters</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                    View All Products
                </a>
            </div>
        @endif
    </div>
@endsection