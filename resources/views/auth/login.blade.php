{{-- LOGIN PAGE --}}
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl flex items-center justify-center mb-6 shadow-2xl transform hover:scale-110 transition-transform animate-bounce">
                    <i class="fas fa-sign-in-alt text-white text-4xl"></i>
                </div>
                <h1 class="text-5xl font-black text-gray-900 mb-3">Welcome Back!</h1>
                <p class="text-gray-600 text-lg">Sign in to continue your shopping journey</p>
            </div>

            <!-- Login Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-10 border-2 border-gray-100 backdrop-blur-lg">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-black text-gray-700 mb-3 flex items-center space-x-2">
                            <i class="fas fa-envelope text-purple-600"></i>
                            <span>Email Address</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all text-lg font-medium"
                            placeholder="Enter your email"
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-2 flex items-center space-x-2 bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-black text-gray-700 mb-3 flex items-center space-x-2">
                            <i class="fas fa-lock text-purple-600"></i>
                            <span>Password</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all text-lg font-medium"
                                placeholder="Enter your password"
                            >
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2 flex items-center space-x-2 bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 text-purple-600 border-2 border-gray-300 rounded focus:ring-purple-500 cursor-pointer">
                            <span class="text-sm text-gray-700 font-semibold group-hover:text-purple-600 transition-colors">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-bold hover:underline">Forgot password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-5 rounded-2xl hover:shadow-2xl transition-all font-black text-xl transform hover:scale-105 mb-6 flex items-center justify-center space-x-3">
                        <i class="fas fa-sign-in-alt text-2xl"></i>
                        <span>Sign In</span>
                    </button>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t-2 border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500 font-bold">New to our store?</span>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 text-purple-600 hover:text-purple-700 font-black text-lg hover:underline">
                            <span>Create an account</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Test Credentials -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 p-6 rounded-2xl shadow-lg">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-info-circle text-blue-600 mt-1 text-xl"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-black mb-2">Test Credentials:</p>
                        <p class="mb-1"><span class="font-bold">Email:</span> <code class="bg-blue-100 px-2 py-1 rounded font-mono">test@example.com</code></p>
                        <p><span class="font-bold">Password:</span> <code class="bg-blue-100 px-2 py-1 rounded font-mono">password</code></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- REGISTER PAGE --}}
@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-pink-600 to-purple-600 rounded-3xl flex items-center justify-center mb-6 shadow-2xl transform hover:scale-110 transition-transform animate-bounce">
                    <i class="fas fa-user-plus text-white text-4xl"></i>
                </div>
                <h1 class="text-5xl font-black text-gray-900 mb-3">Create Account</h1>
                <p class="text-gray-600 text-lg">Join us and start shopping today</p>
            </div>

            <!-- Register Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-10 border-2 border-gray-100">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-black text-gray-700 mb-3 flex items-center space-x-2">
                            <i class="fas fa-user text-pink-600"></i>
                            <span>Full Name</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-100 transition-all text-lg font-medium"
                            placeholder="Enter your full name"
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-2 flex items-center space-x-2 bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-black text-gray-700 mb-3 flex items-center space-x-2">
                            <i class="fas fa-envelope text-pink-600"></i>
                            <span>Email Address</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-100 transition-all text-lg font-medium"
                            placeholder="Enter your email"
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-2 flex items-center space-x-2 bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-black text-gray-700 mb-3 flex items-center space-x-2">
                            <i class="fas fa-lock text-pink-600"></i>
                            <span>Password</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-100 transition-all text-lg font-medium"
                            placeholder="Create a password (min. 8 characters)"
                        >
                        @error('password')
                            <p class="text-red-500 text-sm mt-2 flex items-center space-x-2 bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-black text-gray-700 mb-3 flex items-center space-x-2">
                            <i class="fas fa-lock text-pink-600"></i>
                            <span>Confirm Password</span>
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-100 transition-all text-lg font-medium"
                            placeholder="Confirm your password"
                        >
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start space-x-3">
                        <input type="checkbox" required class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-pink-500 mt-1">
                        <label class="text-sm text-gray-700">
                            I agree to the <a href="#" class="text-pink-600 font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-pink-600 font-bold hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-purple-600 text-white px-6 py-5 rounded-2xl hover:shadow-2xl transition-all font-black text-xl transform hover:scale-105 mb-6 flex items-center justify-center space-x-3">
                        <i class="fas fa-user-plus text-2xl"></i>
                        <span>Create Account</span>
                    </button>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t-2 border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500 font-bold">Already have an account?</span>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 text-pink-600 hover:text-pink-700 font-black text-lg hover:underline">
                            <span>Sign in here</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Benefits -->
            <div class="mt-8 grid grid-cols-3 gap-4">
                <div class="text-center bg-white p-4 rounded-2xl shadow-lg border border-gray-100">
                    <i class="fas fa-truck text-3xl text-purple-600 mb-2"></i>
                    <p class="text-xs font-bold text-gray-700">Free Shipping</p>
                </div>
                <div class="text-center bg-white p-4 rounded-2xl shadow-lg border border-gray-100">
                    <i class="fas fa-shield-alt text-3xl text-green-600 mb-2"></i>
                    <p class="text-xs font-bold text-gray-700">Secure Payment</p>
                </div>
                <div class="text-center bg-white p-4 rounded-2xl shadow-lg border border-gray-100">
                    <i class="fas fa-gift text-3xl text-pink-600 mb-2"></i>
                    <p class="text-xs font-bold text-gray-700">Special Offers</p>
                </div>
            </div>
        </div>
    </div>
@endsection