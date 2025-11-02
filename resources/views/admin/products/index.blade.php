@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Manage Categories</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add Category Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Add New Category</h2>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-semibold mb-2">Category Name</label>
                            <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Add Category
                        </button>
                    </form>
                </div>
            </div>

            <!-- Categories List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    @if($categories->count() > 0)
                        <div class="divide-y">
                            @foreach($categories as $category)
                                <div class="p-6 hover:bg-gray-50 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $category->products_count }} products</p>
                                    </div>
                                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-4 border-t">
                            {{ $categories->links() }}
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <i class="fas fa-tags text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-600">No categories yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
