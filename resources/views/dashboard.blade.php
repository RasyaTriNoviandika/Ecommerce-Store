@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Dashboard</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 mb-2">Total Orders</p>
                        <p class="text-4xl font-bold">{{ $totalOrders }}</p>
                    </div>
                    <i class="fas fa-shopping-bag text-5xl opacity-50"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 mb-2">Total Spent</p>
                        <p class="text-4xl font-bold">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                    </div>
                    <i class="fas fa-wallet text-5xl opacity-50"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 mb-2">Pending Orders</p>
                        <p class="text-4xl font-bold">{{ $recentOrders->where('status', 'pending')->count() }}</p>
                    </div>
                    <i class="fas fa-clock text-5xl opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Recent Orders</h2>
                <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Order ID</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Items</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Total</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-4 px-4 font-medium">#{{ $order->id }}</td>
                                    <td class="py-4 px-4 text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="py-4 px-4 text-gray-600">{{ $order->items->count() }} items</td>
                                    <td class="py-4 px-4 font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="py-4 px-4">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                                            @if($order->status == 'completed') bg-green-100 text-green-800
                                            @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                            View <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-600 text-lg">You haven't placed any orders yet.</p>
                    <a href="{{ route('home') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

