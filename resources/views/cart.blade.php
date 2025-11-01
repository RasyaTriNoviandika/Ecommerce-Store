@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Shopping Cart</h1>
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
            </a>
        </div>

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow">
                            <div class="flex gap-6">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    @if($item['product']->image)
                                        <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-32 h-32 object-cover rounded-lg">
                                    @else
                                        <div class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-3xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <a href="{{ route('product.show', $item['product']->slug) }}" class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors">
                                                {{ $item['product']->name }}
                                            </a>
                                            <p class="text-sm text-gray-600 mt-1">{{ $item['product']->category->name }}</p>
                                        </div>
                                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <span class="text-gray-700 font-medium">Quantity:</span>
                                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center border-2 border-gray-300 rounded-lg">
                                                <button type="button" onclick="this.parentElement.querySelector('input').stepDown(); this.parentElement.submit();" class="px-3 py-2 hover:bg-gray-100">
                                                    <i class="fas fa-minus text-xs"></i>
                                                </button>
                                                <input 
                                                    type="number" 
                                                    name="quantity" 
                                                    value="{{ $item['quantity'] }}" 
                                                    min="1" 
                                                    max="{{ $item['product']->stock }}"
                                                    onchange="this.form.submit()"
                                                    class="w-16 text-center border-0 focus:ring-0 focus:outline-none"
                                                >
                                                <button type="button" onclick="this.parentElement.querySelector('input').stepUp(); this.parentElement.submit();" class="px-3 py-2 hover:bg-gray-100">
                                                    <i class="fas fa-plus text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-600">Unit Price</p>
                                            <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t flex justify-between items-center">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach

                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear all items from cart?')">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                            <i class="fas fa-trash-alt mr-2"></i>Clear Cart
                        </button>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping:</span>
                                <span class="text-green-600">Free</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax:</span>
                                <span>Included</span>
                            </div>
                            <div class="border-t pt-4 flex justify-between items-center">
                                <span class="text-xl font-semibold text-gray-900">Total:</span>
                                <span class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        @auth
                            <a href="{{ route('checkout.index') }}" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center px-6 py-4 rounded-lg hover:shadow-xl transition-all font-semibold text-lg mb-4">
                                <i class="fas fa-lock mr-2"></i>Proceed to Checkout
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center px-6 py-4 rounded-lg hover:shadow-xl transition-all font-semibold text-lg mb-4">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login to Checkout
                            </a>
                        @endauth

                        <div class="text-center text-sm text-gray-600">
                            <i class="fas fa-shield-alt text-blue-600 mr-1"></i>
                            Secure checkout with 256-bit SSL encryption
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-16 text-center">
                <i class="fas fa-shopping-cart text-8xl text-gray-300 mb-6"></i>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
                <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('home') }}" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg hover:shadow-xl transition-all font-semibold text-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>Start Shopping
                </a>
            </div>
        @endif
    </div>
@endsection
