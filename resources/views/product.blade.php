@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><a href="{{ route('home', ['category' => $product->category_id]) }}" class="hover:text-blue-600">{{ $product->category->name }}</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-gray-900 font-medium">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- Product Image -->
                <div class="relative">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-xl shadow-md">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-8xl"></i>
                        </div>
                    @endif
                    @if($product->stock <= 5 && $product->stock > 0)
                        <span class="absolute top-4 left-4 bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Low Stock!
                        </span>
                    @elseif($product->stock == 0)
                        <span class="absolute top-4 left-4 bg-gray-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    <div class="mb-4">
                        <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $product->category->name }}
                        </span>
                    </div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center mb-6">
                        <div class="flex items-center mr-4">
                            <span class="text-yellow-400 text-xl">★★★★★</span>
                            <span class="ml-2 text-gray-600">(0 reviews)</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        @if($product->stock > 0)
                            <p class="text-green-600 font-semibold">
                                <i class="fas fa-check-circle mr-1"></i>{{ $product->stock }} available in stock
                            </p>
                        @else
                            <p class="text-red-600 font-semibold">
                                <i class="fas fa-times-circle mr-1"></i>Currently out of stock
                            </p>
                        @endif
                    </div>
                    
                    @if($product->description)
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-3 text-gray-900">Description</h2>
                            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="border-t pt-6">
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex items-center space-x-4">
                                    <label class="text-gray-700 font-medium">Quantity:</label>
                                    <div class="flex items-center border-2 border-gray-300 rounded-lg">
                                        <button type="button" onclick="decreaseQty()" class="px-4 py-2 hover:bg-gray-100">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input 
                                            type="number" 
                                            id="quantity"
                                            name="quantity" 
                                            value="1" 
                                            min="1" 
                                            max="{{ $product->stock }}"
                                            class="w-20 text-center border-0 focus:ring-0 focus:outline-none"
                                        >
                                        <button type="button" onclick="increaseQty()" class="px-4 py-2 hover:bg-gray-100">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg hover:shadow-xl transition-all font-semibold text-lg">
                                        <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                                    </button>
                                    <button type="button" class="px-6 py-4 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-colors">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-300 text-gray-500 px-8 py-4 rounded-lg cursor-not-allowed font-semibold text-lg">
                                <i class="fas fa-times-circle mr-2"></i>Out of Stock
                            </button>
                        @endif
                    </div>

                    <div class="mt-8 pt-6 border-t">
                        <h3 class="font-semibold mb-3 text-gray-900">Product Features</h3>
                        <ul class="space-y-2 text-gray-700">
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Free shipping on orders over Rp 500.000</li>
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>30-day return policy</li>
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Secure payment</li>
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
