@extends('layout.app')

@section('title', 'Register')

@section('mainContent')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">HR<span class="text-gray-800">M</span></h1>
            <p class="text-gray-500 mt-2">Create your account</p>
        </div>

        <form id="registerForm">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-1">Phone</label>
                <input type="text" name="phone" id="phone" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" id="btnRegister"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Register
            </button>
        </form>

        <div class="mt-4 text-center text-gray-500">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        $('#btnRegister').prop('disabled', true).text('Registering...');
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('register.post') }}",
            method: "POST",
            data: formData,
            dataType: 'json',
            success: function(response) {
                $('#btnRegister').prop('disabled', false).text('Register');

                if(response.statusCode === 200){
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: response.statusMsg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "{{ route('login') }}";
                    });
                } else if(response.statusCode === 204){
                    $('.error-text').remove();
                    $.each(response.errors, function(key, messages){
                        const input = $('#' + key);
                        input.after(`<p class="text-red-500 text-xs mt-1 error-text">${messages[0]}</p>`);
                    });
                }
            },
            error: function(xhr) {
                $('#btnRegister').prop('disabled', false).text('Register');
                let message = xhr.responseJSON?.message || 'Something went wrong';
                Swal.fire('Error', message, 'error');
            }
        });
    });
});
</script>
@endsection
