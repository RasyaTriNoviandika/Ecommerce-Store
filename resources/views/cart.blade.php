@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-5xl font-black text-gray-900 mb-2 flex items-center space-x-3">
                    <i class="fas fa-shopping-cart text-purple-600"></i>
                    <span>Shopping Cart</span>
                </h1>
                <p class="text-gray-600 text-lg">Review your items before checkout</p>
            </div>
            <a href="{{ route('home') }}" class="hidden md:flex items-center space-x-2 text-purple-600 hover:text-purple-700 font-bold text-lg group bg-purple-50 px-6 py-3 rounded-xl border-2 border-purple-200 hover:border-purple-300 transition-all">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Continue Shopping</span>
            </a>
        </div>

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl transition-all border-2 border-gray-100 hover:border-purple-200 group">
                            <div class="flex gap-6">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    <div class="relative overflow-hidden rounded-2xl w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 shadow-lg group-hover:shadow-xl transition-all">
                                        @if($item['product']->image)
                                            <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <a href="{{ route('product.show', $item['product']->slug) }}" class="text-2xl font-black text-gray-900 hover:text-purple-600 transition-colors">
                                                {{ $item['product']->name }}
                                            </a>
                                            <p class="text-sm text-gray-600 mt-1 flex items-center space-x-2">
                                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">{{ $item['product']->category->name }}</span>
                                            </p>
                                        </div>
                                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-3 hover:bg-red-50 rounded-xl transition-all transform hover:scale-110">
                                                <i class="fas fa-trash text-xl"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <!-- Quantity Selector -->
                                        <div class="flex items-center space-x-4">
                                            <span class="text-gray-700 font-bold">Qty:</span>
                                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center border-3 border-purple-300 rounded-xl bg-white shadow-md overflow-hidden">
                                                <button type="button" onclick="this.parentElement.querySelector('input').stepDown(); this.parentElement.submit();" class="px-4 py-2 hover:bg-purple-50 transition-colors text-purple-600 font-bold">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input 
                                                    type="number" 
                                                    name="quantity" 
                                                    value="{{ $item['quantity'] }}" 
                                                    min="1" 
                                                    max="{{ $item['product']->stock }}"
                                                    onchange="this.form.submit()"
                                                    class="w-16 text-center border-0 focus:ring-0 focus:outline-none font-black text-lg"
                                                >
                                                <button type="button" onclick="this.parentElement.querySelector('input').stepUp(); this.parentElement.submit();" class="px-4 py-2 hover:bg-purple-50 transition-colors text-purple-600 font-bold">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <!-- Price -->
                                        <div class="text-right">
                                            <p class="text-sm text-gray-600">Unit Price</p>
                                            <p class="text-xl font-black text-gray-900">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="mt-4 pt-4 border-t-2 border-gray-100 flex justify-between items-center bg-gradient-to-r from-purple-50 to-pink-50 -mx-6 -mb-6 px-6 py-4 rounded-b-3xl">
                                <span class="text-gray-700 font-bold text-lg">Subtotal:</span>
                                <span class="text-3xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @endforeach

                    <!-- Clear Cart Button -->
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear all items from cart?')" class="flex justify-end">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-bold flex items-center space-x-2 bg-red-50 px-6 py-3 rounded-xl border-2 border-red-200 hover:border-red-300 transition-all hover:shadow-lg">
                            <i class="fas fa-trash-alt"></i>
                            <span>Clear Cart</span>
                        </button>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl p-8 sticky top-24 border-2 border-purple-200">
                        <h2 class="text-3xl font-black text-gray-900 mb-6 flex items-center space-x-2">
                            <i class="fas fa-file-invoice text-purple-600"></i>
                            <span>Order Summary</span>
                        </h2>
                        
                        <!-- Summary Items -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-700 py-3 border-b border-gray-200">
                                <span class="font-semibold">Subtotal:</span>
                                <span class="font-bold text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700 py-3 border-b border-gray-200">
                                <span class="font-semibold">Shipping:</span>
                                <span class="text-green-600 font-bold flex items-center space-x-1">
                                    <i class="fas fa-check-circle"></i>
                                    <span>FREE</span>
                                </span>
                            </div>
                            <div class="flex justify-between text-gray-700 py-3 border-b border-gray-200">
                                <span class="font-semibold">Tax:</span>
                                <span class="text-green-600 font-bold">Included</span>
                            </div>
                            
                            <!-- Total -->
                            <div class="flex justify-between items-center pt-4 bg-gradient-to-r from-purple-100 to-pink-100 -mx-8 px-8 py-6 rounded-2xl border-2 border-purple-300">
                                <span class="text-2xl font-black text-gray-900">Total:</span>
                                <span class="text-4xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        @auth
                            <a href="{{ route('checkout.index') }}" class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center px-6 py-5 rounded-2xl hover:shadow-2xl transition-all font-black text-xl mb-4 transform hover:scale-105 flex items-center justify-center space-x-3">
                                <i class="fas fa-lock text-2xl"></i>
                                <span>Proceed to Checkout</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center px-6 py-5 rounded-2xl hover:shadow-2xl transition-all font-black text-xl mb-4 transform hover:scale-105 flex items-center justify-center space-x-3">
                                <i class="fas fa-sign-in-alt text-2xl"></i>
                                <span>Login to Checkout</span>
                            </a>
                        @endauth

                        <!-- Security Badge -->
                        <div class="text-center text-sm text-gray-600 bg-green-50 py-4 rounded-xl border border-green-200">
                            <i class="fas fa-shield-alt text-green-600 mr-2 text-xl"></i>
                            <span class="font-bold">Secure checkout with 256-bit SSL encryption</span>
                        </div>
                        
                        <!-- Payment Methods -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-xs text-gray-600 mb-3 font-bold text-center">We Accept:</p>
                            <div class="flex justify-center items-center space-x-3">
                                <div class="bg-white px-3 py-2 rounded-lg shadow-md border border-gray-200">
                                    <i class="fab fa-cc-visa text-3xl text-blue-600"></i>
                                </div>
                                <div class="bg-white px-3 py-2 rounded-lg shadow-md border border-gray-200">
                                    <i class="fab fa-cc-mastercard text-3xl text-red-600"></i>
                                </div>
                                <div class="bg-white px-3 py-2 rounded-lg shadow-md border border-gray-200">
                                    <i class="fab fa-cc-paypal text-3xl text-blue-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="bg-white rounded-3xl shadow-2xl p-16 text-center border-2 border-gray-100">
                <div class="max-w-md mx-auto">
                    <!-- Empty Cart Icon -->
                    <div class="w-48 h-48 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl">
                        <i class="fas fa-shopping-cart text-purple-400 text-8xl"></i>
                    </div>
                    
                    <h2 class="text-4xl font-black text-gray-900 mb-4">Your cart is empty</h2>
                    <p class="text-gray-600 mb-8 text-lg">Looks like you haven't added any items to your cart yet. Start exploring our products!</p>
                    
                    <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-10 py-5 rounded-2xl hover:shadow-2xl transition-all font-black text-xl transform hover:scale-105">
                        <i class="fas fa-shopping-bag text-2xl"></i>
                        <span>Start Shopping</span>
                    </a>
                    
                    <!-- Popular Categories -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <p class="text-gray-700 font-bold mb-4">Popular Categories</p>
                        <div class="flex flex-wrap justify-center gap-3">
                            @if(class_exists('App\Models\Category'))
                                @foreach(\App\Models\Category::take(4)->get() as $category)
                                    <a href="{{ route('home', ['category' => $category->id]) }}" class="bg-purple-50 text-purple-700 px-4 py-2 rounded-full text-sm font-bold hover:bg-purple-100 transition-colors border border-purple-200">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection