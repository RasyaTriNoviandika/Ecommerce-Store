@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Admin Dashboard</h1>
            <a href="{{ route('admin.products') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                Manage Products
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-2">Total Products</p>
                        <p class="text-4xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
                    </div>
                    <i class="fas fa-box text-5xl text-gray-300"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-2">Total Categories</p>
                        <p class="text-4xl font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
                    </div>
                    <i class="fas fa-tags text-5xl text-gray-300"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-2">Total Orders</p>
                        <p class="text-4xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                    </div>
                    <i class="fas fa-shopping-bag text-5xl text-gray-300"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-2">Total Revenue</p>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                    </div>
                    <i class="fas fa-dollar-sign text-5xl text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('admin.products') }}" class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Products</h3>
                        <p class="text-gray-600">Manage your product catalog</p>
                    </div>
                    <i class="fas fa-box text-4xl text-gray-300"></i>
                </div>
            </a>

            <a href="{{ route('admin.categories') }}" class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Categories</h3>
                        <p class="text-gray-600">Organize product categories</p>
                    </div>
                    <i class="fas fa-tags text-4xl text-gray-300"></i>
                </div>
            </a>

            <a href="{{ route('admin.orders') }}" class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Orders</h3>
                        <p class="text-gray-600">View and manage orders</p>
                    </div>
                    <i class="fas fa-shopping-bag text-4xl text-gray-300"></i>
                </div>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Recent Orders</h2>
            @if($recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Order ID</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Customer</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Total</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-4 px-4 font-medium">#{{ $order->id }}</td>
                                    <td class="py-4 px-4">{{ $order->user->name }}</td>
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
                                    <td class="py-4 px-4 text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="py-4 px-4">
                                        <a href="{{ route('admin.orders') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600 text-center py-8">No orders yet</p>
            @endif
        </div>
    </div>
@endsection