@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Orders
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex justify-between items-start mb-6 border-b pb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                    <p class="text-gray-600 mt-2">Placed on {{ $order->created_at->format('d F Y, h:i A') }}</p>
                </div>
                <span class="px-6 py-2 rounded-full text-sm font-semibold
                    @if($order->status == 'completed') bg-green-100 text-green-800
                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Shipping Address</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-medium text-gray-900">{{ $order->name }}</p>
                        <p class="text-gray-700">{{ $order->address }}</p>
                        <p class="text-gray-700 mt-2">{{ $order->email }}</p>
                        @if($order->phone)
                            <p class="text-gray-700">{{ $order->phone }}</p>
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Order Summary</h3>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping:</span>
                            <span class="font-medium text-green-600">Free</span>
                        </div>
                        <div class="border-t pt-2 mt-2 flex justify-between">
                            <span class="text-lg font-semibold">Total:</span>
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 mb-4">Order Items</h3>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-6 bg-gray-50 p-4 rounded-lg">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-lg">
                            @else
                                <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                            <div class="flex-1">
                                <a href="{{ route('product.show', $item->product->slug) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                    {{ $item->product->name }}
                                </a>
                                <p class="text-gray-600 mt-1">{{ $item->product->category->name }}</p>
                                <p class="text-gray-700 mt-2">Quantity: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold text-gray-900">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

