@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Manage Categories</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add Category Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Add New Category</h2>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Category Name</label>
                            <input type="text" name="name" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition-all font-semibold">
                            <i class="fas fa-plus mr-2"></i>Add Category
                        </button>
                    </form>
                </div>
            </div>

            <!-- Categories List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    @if($categories->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach($categories as $category)
                                <div class="p-6 hover:bg-gray-50 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $category->products_count }} products</p>
                                    </div>
                                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category? All products in this category will be affected.')">
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
                            <i class="fas fa-tags text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600">No categories yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

