@extends('layout.appmain')

@section('title', 'Profile')

@section('mainContent')
<div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-blue-100 via-white to-blue-200 p-6">
    <div class="backdrop-blur-lg bg-white/30 border border-white/40 shadow-xl rounded-2xl p-8 w-full max-w-4xl">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            <!-- Profile Image -->
            <div class="relative">
                <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile Photo"
                    class="w-32 h-32 rounded-full object-cover border-4 border-blue-400 shadow-lg">
                <span
                    class="absolute bottom-2 right-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">Online</span>
            </div>

            <!-- User Info -->
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-800 drop-shadow-sm">John Doe</h2>
                <p class="text-blue-700 font-medium mb-3">Software Engineer</p>

                <div class="space-y-1 text-gray-700">
                    <div class="flex items-center justify-center md:justify-start text-sm">
                        <i class="bi bi-envelope me-2 text-blue-600"></i>
                        <span>john.doe@example.com</span>
                    </div>
                    <div class="flex items-center justify-center md:justify-start text-sm">
                        <i class="bi bi-phone me-2 text-blue-600"></i>
                        <span>+8801XXXXXXXXX</span>
                    </div>
                    <div class="flex items-center justify-center md:justify-start text-sm">
                        <i class="bi bi-geo-alt me-2 text-blue-600"></i>
                        <span>Dhaka, Bangladesh</span>
                    </div>
                </div>
            </div>

            <!-- Edit Button -->
            <div>
                <button id="btnEditProfile"
                    class="px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-lg transition flex items-center gap-2">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-6 border-white/40">

        <!-- Profile Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="backdrop-blur-md bg-white/40 p-4 rounded-xl border border-white/30">
                <h4 class="font-semibold text-gray-800 mb-2 text-lg">Personal Information</h4>
                <ul class="space-y-1 text-sm text-gray-700">
                    <li><strong>Employee ID:</strong> EMP-001</li>
                    <li><strong>Gender:</strong> Male</li>
                    <li><strong>Date of Birth:</strong> 12 May 1998</li>
                    <li><strong>Marital Status:</strong> Single</li>
                </ul>
            </div>
            <div class="backdrop-blur-md bg-white/40 p-4 rounded-xl border border-white/30">
                <h4 class="font-semibold text-gray-800 mb-2 text-lg">Work Information</h4>
                <ul class="space-y-1 text-sm text-gray-700">
                    <li><strong>Department:</strong> IT</li>
                    <li><strong>Designation:</strong> Software Engineer</li>
                    <li><strong>Date Joined:</strong> 01 Jan 2022</li>
                    <li><strong>Status:</strong> Active</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="backdrop-blur-lg bg-white/40 border border-white/30 rounded-2xl w-full max-w-md p-6 shadow-2xl relative">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Edit Profile</h3>

            <form id="editProfileForm">
                @csrf
                <div class="mb-3">
                    <label class="block text-gray-800 font-medium mb-1">Name</label>
                    <input type="text" name="name" value="John Doe"
                        class="w-full px-4 py-2 rounded-lg bg-white/60 border border-white/40 focus:ring-2 focus:ring-blue-500 backdrop-blur-md">
                </div>
                <div class="mb-3">
                    <label class="block text-gray-800 font-medium mb-1">Email</label>
                    <input type="email" name="email" value="john.doe@example.com"
                        class="w-full px-4 py-2 rounded-lg bg-white/60 border border-white/40 focus:ring-2 focus:ring-blue-500 backdrop-blur-md">
                </div>
                <div class="mb-3">
                    <label class="block text-gray-800 font-medium mb-1">Phone</label>
                    <input type="text" name="phone" value="+8801XXXXXXXXX"
                        class="w-full px-4 py-2 rounded-lg bg-white/60 border border-white/40 focus:ring-2 focus:ring-blue-500 backdrop-blur-md">
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" id="btnCancelEdit"
                        class="px-4 py-2 bg-white/50 text-gray-700 rounded-lg hover:bg-white/70 transition border border-white/40">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition shadow-md">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Open Edit Modal
        $('#btnEditProfile').on('click', function () {
            $('#editModal').removeClass('hidden').addClass('flex');
        });

        // Close Modal
        $('#btnCancelEdit').on('click', function () {
            $('#editModal').addClass('hidden').removeClass('flex');
        });

        // Submit Edit (Dummy AJAX)
        $('#editProfileForm').on('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                icon: 'success',
                title: 'Profile Updated!',
                text: 'Your changes have been saved successfully.',
                showConfirmButton: false,
                timer: 1200,
                background: 'rgba(255,255,255,0.8)',
                backdrop: 'rgba(0,0,0,0.3)'
            });

            $('#editModal').addClass('hidden').removeClass('flex');
        });
    });
</script>
@endsection
