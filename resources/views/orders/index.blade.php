@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">My Orders</h1>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Order #{{ $order->id }}</h3>
                                <p class="text-gray-600 mt-1">Placed on {{ $order->created_at->format('d F Y, h:i A') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <span class="inline-block mt-2 px-4 py-1 rounded-full text-sm font-semibold
                                    @if($order->status == 'completed') bg-green-100 text-green-800
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm text-gray-600">Shipping Address</p>
                                    <p class="font-medium text-gray-900">{{ $order->address }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Contact</p>
                                    <p class="font-medium text-gray-900">{{ $order->email }}</p>
                                    @if($order->phone)
                                        <p class="font-medium text-gray-900">{{ $order->phone }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="border-t pt-4">
                                <h4 class="font-semibold mb-3 text-gray-900">Order Items ({{ $order->items->count() }})</h4>
                                <div class="space-y-3">
                                    @foreach($order->items as $item)
                                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                            <div class="flex items-center gap-4">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                                    <p class="text-sm text-gray-600">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                            <p class="font-semibold text-gray-900">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                    View Details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-16 text-center">
                <i class="fas fa-shopping-bag text-8xl text-gray-300 mb-6"></i>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">No orders yet</h2>
                <p class="text-gray-600 mb-8">Start shopping to see your orders here</p>
                <a href="{{ route('home') }}" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg hover:shadow-xl transition-all font-semibold text-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>Start Shopping
                </a>
            </div>
        @endif
    </div>
@endsection

