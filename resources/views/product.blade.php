@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb - Enhanced -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-3 text-sm bg-white px-6 py-4 rounded-2xl shadow-md border border-gray-100">
                <li>
                    <a href="{{ route('home') }}" class="text-purple-600 hover:text-purple-700 font-semibold flex items-center space-x-2 group">
                        <i class="fas fa-home group-hover:scale-110 transition-transform"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                <li>
                    <a href="{{ route('home', ['category' => $product->category_id]) }}" class="text-purple-600 hover:text-purple-700 font-semibold hover:underline">
                        {{ $product->category->name }}
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                <li class="text-gray-900 font-bold">{{ Str::limit($product->name, 30) }}</li>
            </ol>
        </nav>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8 lg:p-12">
                <!-- Product Image - Enhanced -->
                <div class="relative group">
                    <div class="sticky top-24">
                        <!-- Main Image Container -->
                        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-gray-50 to-gray-100 aspect-square shadow-xl border-4 border-gray-200 group-hover:border-purple-300 transition-all duration-500">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-gray-300 text-9xl"></i>
                                </div>
                            @endif
                            
                            <!-- Stock Badge -->
                            <div class="absolute top-6 left-6">
                                @if($product->stock <= 5 && $product->stock > 0)
                                    <span class="bg-red-500 text-white px-6 py-3 rounded-full text-sm font-bold shadow-2xl animate-pulse flex items-center space-x-2 backdrop-blur-sm">
                                        <i class="fas fa-fire"></i>
                                        <span>Only {{ $product->stock }} left - Hurry!</span>
                                    </span>
                                @elseif($product->stock == 0)
                                    <span class="bg-gray-600 text-white px-6 py-3 rounded-full text-sm font-bold shadow-2xl backdrop-blur-sm">
                                        <i class="fas fa-times-circle mr-2"></i>Out of Stock
                                    </span>
                                @else
                                    <span class="bg-green-500 text-white px-6 py-3 rounded-full text-sm font-bold shadow-2xl backdrop-blur-sm">
                                        <i class="fas fa-check-circle mr-2"></i>In Stock ({{ $product->stock }} available)
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Zoom Hint -->
                            <div class="absolute bottom-6 right-6 bg-black/60 text-white px-4 py-2 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-sm">
                                <i class="fas fa-search-plus mr-2"></i>Hover to zoom
                            </div>
                        </div>
                        
                        <!-- Product Features Icons -->
                        <div class="grid grid-cols-3 gap-4 mt-6">
                            <div class="text-center bg-gradient-to-br from-purple-50 to-pink-50 p-4 rounded-2xl border border-purple-200">
                                <i class="fas fa-truck text-3xl text-purple-600 mb-2"></i>
                                <p class="text-xs font-bold text-gray-700">Free Shipping</p>
                            </div>
                            <div class="text-center bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-2xl border border-green-200">
                                <i class="fas fa-shield-alt text-3xl text-green-600 mb-2"></i>
                                <p class="text-xs font-bold text-gray-700">Secure Payment</p>
                            </div>
                            <div class="text-center bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-2xl border border-blue-200">
                                <i class="fas fa-undo text-3xl text-blue-600 mb-2"></i>
                                <p class="text-xs font-bold text-gray-700">Easy Returns</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info - Enhanced -->
                <div class="space-y-6">
                    <!-- Category Badge -->
                    <div>
                        <span class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 px-5 py-2 rounded-full text-sm font-bold border-2 border-purple-200">
                            <i class="fas fa-tag"></i>
                            <span>{{ $product->category->name }}</span>
                        </span>
                    </div>
                    
                    <!-- Product Name -->
                    <h1 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight">
                        {{ $product->name }}
                    </h1>
                    
                    <!-- Rating -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-star text-yellow-400 text-xl"></i>
                            <i class="fas fa-star text-yellow-400 text-xl"></i>
                            <i class="fas fa-star text-yellow-400 text-xl"></i>
                            <i class="fas fa-star text-yellow-400 text-xl"></i>
                            <i class="fas fa-star text-yellow-400 text-xl"></i>
                        </div>
                        <span class="text-gray-600 font-semibold">(5.0)</span>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-600">0 reviews</span>
                    </div>

                    <!-- Price Section -->
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl p-8 border-2 border-purple-200 shadow-lg">
                        <div class="flex items-baseline space-x-3 mb-3">
                            <p class="text-6xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="text-green-600 font-bold flex items-center space-x-2">
                            <i class="fas fa-check-circle"></i>
                            <span>Best price guaranteed</span>
                        </p>
                    </div>
                    
                    <!-- Description -->
                    @if($product->description)
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                            <h2 class="text-2xl font-black mb-4 text-gray-900 flex items-center space-x-2">
                                <i class="fas fa-info-circle text-purple-600"></i>
                                <span>Description</span>
                            </h2>
                            <p class="text-gray-700 leading-relaxed text-lg">{{ $product->description }}</p>
                        </div>
                    @endif

                    <!-- Add to Cart Section -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 border-2 border-gray-200 shadow-xl">
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-6">
                                @csrf
                                
                                <!-- Quantity Selector -->
                                <div>
                                    <label class="block text-lg font-black mb-4 text-gray-900 flex items-center space-x-2">
                                        <i class="fas fa-sort-numeric-up text-purple-600"></i>
                                        <span>Quantity:</span>
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center border-3 border-purple-300 rounded-2xl bg-white shadow-lg overflow-hidden">
                                            <button type="button" onclick="decreaseQty()" class="px-6 py-4 hover:bg-purple-50 transition-colors text-purple-600 font-bold text-xl">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input 
                                                type="number" 
                                                id="quantity"
                                                name="quantity" 
                                                value="1" 
                                                min="1" 
                                                max="{{ $product->stock }}"
                                                class="w-24 text-center border-0 focus:ring-0 focus:outline-none text-2xl font-black text-gray-900"
                                            >
                                            <button type="button" onclick="increaseQty()" class="px-6 py-4 hover:bg-purple-50 transition-colors text-purple-600 font-bold text-xl">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <span class="text-gray-600 font-semibold">{{ $product->stock }} available</span>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex gap-4">
                                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-5 rounded-2xl hover:shadow-2xl transition-all font-black text-xl transform hover:scale-105 flex items-center justify-center space-x-3">
                                        <i class="fas fa-cart-plus text-2xl"></i>
                                        <span>Add to Cart</span>
                                    </button>
                                    <button type="button" class="px-6 py-5 border-3 border-purple-300 rounded-2xl hover:bg-purple-50 hover:border-purple-400 transition-all transform hover:scale-105 text-purple-600">
                                        <i class="fas fa-heart text-2xl"></i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-300 text-gray-600 px-8 py-5 rounded-2xl cursor-not-allowed font-black text-xl flex items-center justify-center space-x-3">
                                <i class="fas fa-times-circle text-2xl"></i>
                                <span>Out of Stock</span>
                            </button>
                        @endif
                    </div>

                    <!-- Product Features -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-6 border-2 border-blue-200">
                        <h3 class="font-black mb-4 text-gray-900 text-xl flex items-center space-x-2">
                            <i class="fas fa-star text-blue-600"></i>
                            <span>Why Choose Us?</span>
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-xl"></i>
                                <span class="text-gray-700 font-medium"><strong>Free Shipping</strong> on orders over Rp 500.000</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-xl"></i>
                                <span class="text-gray-700 font-medium"><strong>30-day Return Policy</strong> - No questions asked</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-xl"></i>
                                <span class="text-gray-700 font-medium"><strong>Secure Payment</strong> - Your data is protected</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-xl"></i>
                                <span class="text-gray-700 font-medium"><strong>Quality Guaranteed</strong> - 100% authentic products</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function increaseQty() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max'));
            const current = parseInt(input.value);
            if (current < max) {
                input.value = current + 1;
            }
        }
        
        function decreaseQty() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current > 1) {
                input.value = current - 1;
            }
        }
    </script>
@endsection