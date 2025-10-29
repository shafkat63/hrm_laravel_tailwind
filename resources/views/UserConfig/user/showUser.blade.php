@extends('layout.appmain')
@section('title', '- User')

@section('mainContent')
<div class="container mx-auto mt-10 px-4">
    <!-- Header and Breadcrumb -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h2 class="text-3xl font-extrabold text-gray-800 drop-shadow-sm mb-2 sm:mb-0">Users Management</h2>
        <nav class="text-sm text-gray-700 mt-1" aria-label="Breadcrumb">
            <ol class="list-reset flex space-x-2">
                <li><a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 transition duration-150">Home</a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li>User Config</li>
                <li><span class="text-gray-400">/</span></li>
                <li class="font-semibold text-gray-800">User Info</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white/90 backdrop-blur-lg shadow-3xl rounded-2xl overflow-hidden border border-gray-100">

        <!-- Table Header and Add Button -->
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-6 py-4 border-b border-gray-200">
            <h5 class="text-xl font-semibold text-gray-800 mb-2 sm:mb-0">User Information Table</h5>
            <a href="javascript:void(0)" onclick="openModal('create')"
                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02] active:scale-[0.98]">
                <i class="bi bi-plus text-lg"></i> Add New User
            </a>
        </div>

        <!-- Filter Section -->
        <div class="p-6 bg-gray-50/70 border-b border-gray-200">
            <h6 class="text-sm font-bold text-gray-700 mb-3">Filter Options:</h6>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="filterRole" class="block text-xs font-medium text-gray-700 mb-1">Filter by Role</label>
                    <select id="filterRole"
                        class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                        <option value="">All Roles</option>
                        {{-- Options populated by JS --}}
                    </select>
                </div>
                <div>
                    <label for="filterStatus" class="block text-xs font-medium text-gray-700 mb-1">Filter by
                        Status</label>
                    <select id="filterStatus"
                        class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                        <option value="">All Statuses</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-span-1">
                    <button id="applyFilterButton"
                        class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition duration-300 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                        Apply Filter <i class="bi bi-funnel text-xs"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="overflow-x-auto p-4">
            <table id="dataTableItem" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100/70 text-xs text-gray-700 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">SL</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Name</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Phone</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Email</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Role(s)</th>
                        <th class="px-6 py-3 text-center font-bold border-b border-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100 text-gray-700">
                    {{-- DataTables rows go here --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create/Edit User Modal -->
<div id="createUserModal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-4 overflow-y-auto">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>

    <div
        class="relative w-full max-w-lg bg-white/95 backdrop-blur-lg rounded-2xl shadow-3xl border border-white/50 p-6 mx-auto flex flex-col max-h-[90vh]">

        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-3 flex-shrink-0">
            <h3 id="modalTitle" class="text-2xl font-bold text-gray-800">Add New User</h3>
            <button class="text-gray-500 hover:text-gray-800 text-3xl transition" onclick="closeModal()">
                &times;
            </button>
        </div>

        <!-- Modal Body (Form) -->
        <div class="overflow-y-auto pr-2 flex-1 custom-scrollbar">
            <form id="createUserForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="userIdField">

                <div class="space-y-4">
                    {{-- Name --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="name">Name</label>
                        <input type="text" name="name" id="name" required
                            class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    {{-- Email (Read-only in Edit Mode) --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm disabled:bg-gray-100"
                            readonly>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="phone">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    {{-- Password Group (Hidden in Edit Mode) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="password-group">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="password_confirmation">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="rolesSelect">Role(s)</label>
                        <select name="roles[]" id="rolesSelect" multiple required
                            class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            {{-- Options populated by JS --}}
                        </select>
                    </div>

                    {{-- Photo --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="photo">Photo</label>
                        <input type="file" name="photo" id="photo"
                            class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-200">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="status">Status</label>
                        <select name="status" id="status" required
                            class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Modal Footer (Save/Cancel Buttons) -->
                <div
                    class="mt-8 pt-4 border-t border-gray-200 flex flex-col sm:flex-row justify-end gap-3 flex-shrink-0">
                    <button type="button" onclick="closeModal()"
                        class="px-5 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition duration-200 shadow-sm">Cancel</button>
                    <button type="submit" id="saveButton"
                        class="px-5 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white transition duration-200 shadow-md transform hover:scale-[1.02] active:scale-[0.98]">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Global variables for state management
    let currentMode = 'create'; 
    let dataTable;

    // Helper function for reusable SweetAlert loading state
    const showLoading = (title) => Swal.fire({title: title, allowOutsideClick: false, didOpen: () => Swal.showLoading()});

    $(document).ready(function() {
        // --- Initialization ---
        loadRoles(); 
        
        // Initialize DataTables
        dataTable = $('#dataTableItem').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('all.User') }}",
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, 
                data: function (d) {
                    // Pass filter values to the server
                    d.role = $('#filterRole').val();
                    d.status = $('#filterStatus').val();
                }
            },
            columns: [
                { data: 'id', render: (data,type,row,meta)=> meta.row + 1, className: 'text-left' },
                { data: 'name', className: 'font-medium' },
                { data: 'phone' },
                { data: 'email' },
                { data: 'roles_html', orderable:false, searchable:false, className: 'whitespace-nowrap' }, 
                { data: null, className:"text-center whitespace-nowrap", orderable:false, searchable:false,
                    render: function(data,type,row){
                        // Use a consistent ID property, assuming 'id' is the unique identifier
                        const userId = row.id || row.uid; 
                        return `
                        <div class="flex justify-center items-center space-x-2">
                            <button class="text-blue-500 hover:text-blue-700 edit-button p-1 rounded-full hover:bg-blue-50 transition" data-id="${userId}" title="Edit User">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700 delete-button p-1 rounded-full hover:bg-red-50 transition" data-id="${userId}" title="Delete User">
                                <i class="bi bi-trash-fill text-lg"></i>
                            </button>
                        </div>`;
                    }
                }
            ],
            order:[[0,'desc']],
            // DataTables customization
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lBf>rtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        // Apply Filter Event
        $('#applyFilterButton').on('click', function() {
            dataTable.ajax.reload();
        });


        // --- Modal Control Functions (Globally accessible) ---

        window.openModal = (mode = 'create', userId = null) => {
            currentMode = mode;
            const $modal = $('#createUserModal');
            const $form = $('#createUserForm');
            const $passwordGroup = $('#password-group');
            const $saveButton = $('#saveButton');
            const $emailInput = $('#email');
            const $passwordInput = $('#password');
            const $passwordConfirmInput = $('#password_confirmation');
            
            // 1. Reset Form & Hidden Fields
            $form[0].reset(); 
            $('#userIdField').val(''); 
            
            // 2. Load Roles (ensures fresh roles are in the select dropdown)
            loadRoles(true);

            if (mode === 'edit' && userId) {
                // --- EDIT Mode Configuration ---
                $('#modalTitle').text('Edit User'); 
                $saveButton.text('Update User');
                $('#userIdField').val(userId);
                
                // Hide and un-require password fields for update
                $passwordGroup.hide();
                $passwordInput.prop('required', false);
                $passwordConfirmInput.prop('required', false);

                // Disable email editing
                $emailInput.prop('readonly', true).addClass('bg-gray-100');
                
                fetchUser(userId); // Load user data
            } else {
                // --- CREATE Mode Configuration ---
                $('#modalTitle').text('Add New User');
                $saveButton.text('Save User');
                
                // Show and require password fields for creation
                $passwordGroup.show();
                $emailInput.prop('readonly', false).removeClass('bg-gray-100');
                $passwordInput.prop('required', true);
                $passwordConfirmInput.prop('required', true);
            }

            $modal.removeClass('hidden');
        };

        window.closeModal = () => { 
            $('#createUserModal').addClass('hidden'); 
            $('#createUserForm')[0].reset();
            currentMode = 'create'; // Reset mode after closing
            // Ensure email field is enabled for the next time it's opened in 'create' mode
            $('#email').prop('readonly', false).removeClass('bg-gray-100');
        };


        // --- AJAX Functions ---

        function loadRoles(isModalCall = false) {
            $.ajax({
                url: "{{ route('GetRoles') }}",
                type: 'GET',
                success: function(roles){
                    // 1. Populate Modal Role Select
                    if (isModalCall) { 
                        let modalSelect = $('#rolesSelect');
                        modalSelect.empty();
                        modalSelect.append(`<option value="" disabled>Select Role(s)</option>`); 
                        roles.forEach(role=>modalSelect.append(`<option value="${role.name}">${role.name}</option>`));
                    }
                    
                    // 2. Populate Filter Role Select
                    let filterSelect = $('#filterRole');
                    filterSelect.find('option:not(:first)').remove(); // Keep "All Roles" option
                    roles.forEach(role => filterSelect.append(`<option value="${role.name}">${role.name}</option>`));
                },
                error:()=>Swal.fire('Error','Could not load roles for filtering/modal','error')
            });
        }
        
        function fetchUser(userId) {
            $.ajax({
                url: `/User/${userId}/edit`, 
                type: 'GET',
                beforeSend: () => showLoading('Loading user data...'),
                success: function(user){
                    console.log(user);
                    
                    Swal.close();
                    if(user) {
                        $('#name').val(user.name);
                        $('#email').val(user.email);
                        $('#phone').val(user.phone || ''); // Handle null phone
                        $('#status').val(user.status.toString()); 
                        
                        // Select the user's current roles
                        const userRoles = user.roles.map(role => role.name);
                        $('#rolesSelect').val(userRoles).trigger('change'); 
                    } else {
                        closeModal();
                        Swal.fire('Error', 'User not found.', 'error');
                    }
                },
                error:()=> {
                    Swal.close();
                    Swal.fire('Error','Could not load user data','error');
                    closeModal();
                }
            });
        }

        // --- Form Submission Handler ---
        $('#createUserForm').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            
            let url = currentMode === 'create' ? "{{ route('User.store') }}" : `/User/${$('#userIdField').val()}`; 
            let method = currentMode === 'create' ? 'POST' : 'POST'; 
            
            if (currentMode === 'edit') {
                // Laravel convention for update using FormData
                formData.append('_method', 'PATCH'); 
            }

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData:false,
                contentType:false,
                beforeSend: () => showLoading('Saving data...'),
                success: function(response){
                    Swal.close();
                    let res=typeof response==='string'?JSON.parse(response):response;
                    if(res.statusCode === 200 || res.success) { 
                        dataTable.ajax.reload(); 
                        closeModal(); 
                        Swal.fire('Success', res.statusMsg || 'User saved successfully', 'success'); 
                    } else {
                        Swal.fire('Error', res.statusMsg || res.message || 'An error occurred during save.', 'error');
                    }
                },
                error: (jqXHR) => {
                    Swal.close();
                    if (jqXHR.status === 422) {
                        // Handle Validation Errors
                        const errors = jqXHR.responseJSON.errors;
                        let errorList = '<ul>';
                        for (let field in errors) {
                            errors[field].forEach(msg => { errorList += `<li>- ${msg}</li>`; });
                        }
                        errorList += '</ul>';
                        Swal.fire('Validation Error', errorList, 'error');
                    } else {
                        Swal.fire('Error', 'Could not process request. Check server response.', 'error');
                    }
                }
            });
        });

        // --- Action Button Handlers (Delegated) ---

        // Edit Button Click
        $('#dataTableItem tbody').on('click', '.edit-button', function() {
            const userId = $(this).data('id');
            openModal('edit', userId);
        });

        // Delete Button Click
        $('#dataTableItem tbody').on('click', '.delete-button', function() {
            const userId = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "This action is irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteUser(userId);
                }
            });
        });
        
        // Delete Logic
        function deleteUser(userId) {
            $.ajax({
                url: `/User/${userId}`, 
                type: 'POST', // Sent as POST with _method set to DELETE
                data: {_method: 'DELETE', _token: $('meta[name="csrf-token"]').attr('content')}, 
                beforeSend: () => showLoading('Deleting user...'),
                success: function(response) {
                    Swal.close();
                    let res = typeof response === 'string' ? JSON.parse(response) : response;
                    if(res.statusCode === 200 || res.success) {
                        dataTable.ajax.reload();
                        Swal.fire('Deleted!', res.statusMsg || 'User has been deleted.', 'success');
                    } else {
                        Swal.fire('Error', res.statusMsg || 'Could not delete user.', 'error');
                    }
                },
                error: () => Swal.fire('Error', 'Could not connect to server to delete user.', 'error')
            });
        }
    });
</script>
@endsection