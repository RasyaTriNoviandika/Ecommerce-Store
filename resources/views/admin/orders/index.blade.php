@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Manage Orders</h1>

        @if($orders->count() > 0)
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Order ID</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Customer</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Total</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Date</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium">#{{ $order->id }}</td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $order->email }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()" class="px-3 py-1 rounded-full text-sm font-semibold border
                                                @if($order->status == 'completed') bg-green-100 text-green-800 border-green-300
                                                @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800 border-yellow-300
                                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800 border-blue-300
                                                @else bg-red-100 text-red-800 border-red-300
                                                @endif">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t">
                    {{ $orders->links() }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
                <i class="fas fa-shopping-bag text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-600 text-lg">No orders yet</p>
            </div>
        @endif
    </div>
@endsection