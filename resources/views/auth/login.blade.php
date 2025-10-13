@extends('layout.app')

@section('title', 'Login')

@section('mainContent')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">HR<span class="text-gray-800">M</span></h1>
            <p class="text-gray-500 mt-2">Sign in to your account</p>
        </div>

        <form id="loginForm">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            <button type="submit" id="btnLogin"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Login
            </button>
        </form>

        <div class="mt-4 text-center text-gray-500">
            &copy; {{ date('Y') }} AMS. All rights reserved.
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Get user's location (optional)
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
        });
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            $('#btnLogin').prop('disabled', true).text('Logging in...');
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('requestLogin') }}",
                method: "POST",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#btnLogin').prop('disabled', false).text('Login');

                    if(response.statusCode === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            window.location.href = "{{ url('dashboard') }}";
                        });
                    } else {
                        Swal.fire('Error', response.statusMsg || 'Invalid credentials', 'error');
                    }
                },
                error: function(xhr) {
                    $('#btnLogin').prop('disabled', false).text('Login');
                    let message = xhr.responseJSON?.message || 'Something went wrong';
                    Swal.fire('Error', message, 'error');
                }
            });
        });
    });
</script>
@endsection