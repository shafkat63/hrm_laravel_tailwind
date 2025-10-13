@extends('layout.app')

@section('title', 'Register')

@section('mainContent')
<div class="min-h-[90vh] flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-indigo-50 px-4">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8 border border-gray-100">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-600">
                HR<span class="text-gray-900">M</span>
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Create your account and start managing employees efficiently
            </p>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input id="name" name="name" type="text" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="John Doe">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="example@email.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="••••••••">
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                    Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="••••••••">
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition-all">
                    Create Account
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="my-6 text-center text-gray-500 text-sm">or</div>

        <!-- Social Buttons -->
        <div class="flex gap-3">
            <button
                class="flex-1 border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition flex items-center justify-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" class="w-4 h-4" alt="Google">
                Google
            </button>
            <button
                class="flex-1 border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition flex items-center justify-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-4 h-4" alt="Facebook">
                Facebook
            </button>
        </div>

        <!-- Login -->
        <p class="text-center text-sm text-gray-600 mt-8">
            Already have an account?
            <a href="/login" class="text-blue-600 hover:underline">Log in</a>
        </p>
    </div>
</div>
@endsection
