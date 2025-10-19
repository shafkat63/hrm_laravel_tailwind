@extends('layout.appmain')
@section('title', '- User')

@section('mainContent')
<main id="main" class="main p-6 min-h-screen bg-gradient-to-b from-blue-100 to-indigo-100">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">User Info</h1>
            <nav class="text-sm text-gray-700 mt-1">
                <ol class="list-reset flex space-x-2">
                    <li><a href="{{ url('/') }}" class="text-blue-600 hover:underline">Home</a></li>
                    <li>/</li>
                    <li>User Config</li>
                    <li>/</li>
                    <li class="font-semibold text-gray-800">User Info</li>
                </ol>
            </nav>
        </div>

        <!-- Card -->
        <div class="bg-white/80 backdrop-blur-md shadow-lg rounded-2xl overflow-hidden border border-white/20">
            <div class="flex justify-between items-center px-6 py-4 border-b border-white/20">
                <h5 class="text-lg font-semibold text-gray-800">User Info</h5>
                <a href="javascript:void(0)" onclick="openModal()"
                    class="inline-flex items-center gap-2 bg-green-500/80 hover:bg-green-500/90 text-white text-sm font-medium px-4 py-2 rounded-xl transition backdrop-blur-sm">
                    Add New <i class="bi bi-plus"></i>
                </a>
            </div>

            <!-- DataTable -->
            <div class="overflow-x-auto">
                <table id="dataTableItem"
                    class="min-w-full border border-white/20 rounded-xl bg-white/80 backdrop-blur-md text-gray-800">
                    <thead class="bg-white/80 backdrop-blur-md text-gray-700 uppercase">
                        <tr>
                            <th class="px-4 py-2 border-b border-white/20">SL</th>
                            <th class="px-4 py-2 border-b border-white/20">Name</th>
                            <th class="px-4 py-2 border-b border-white/20">Phone</th>
                            <th class="px-4 py-2 border-b border-white/20">Email</th>
                            <th class="px-4 py-2 border-b border-white/20">Role</th>
                            <th class="px-4 py-2 border-b border-white/20 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="backdrop-blur-sm">
                        <!-- rows will be injected by DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Create User Modal -->
<div id="createUserModal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-4 overflow-y-auto">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- Modal Content -->
    <div
        class="relative w-full max-w-lg sm:max-w-md md:max-w-lg lg:max-w-xl bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl border border-white/30 p-6 mx-auto flex flex-col max-h-[90vh]">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-4 border-b border-white/30 pb-3 flex-shrink-0">
            <h3 class="text-xl font-semibold text-gray-800">Add New User</h3>
            <button class="text-gray-500 hover:text-gray-800" onclick="closeModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Form Container (scrollable if too tall) -->
        <div class="overflow-y-auto pr-2 flex-1">
            <form id="createUserForm" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" name="name"
                            class="w-full border border-white/30 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email"
                            class="w-full border border-white/30 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Phone</label>
                        <input type="text" name="phone"
                            class="w-full border border-white/30 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Password</label>
                            <input type="password" name="password"
                                class="w-full border border-white/30 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full border border-white/30 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Role</label>
                        <select name="roles[]" id="rolesSelect"
                            class="w-full border border-white/30 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800"
                            multiple>
                            <!-- Roles injected via AJAX -->
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Photo</label>
                        <input type="file" name="photo" class="w-full">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Status</label>
                        <select name="status"
                            class="w-full border border-white/30 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3 flex-shrink-0">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 rounded-xl border border-white/30 text-gray-700 hover:bg-gray-100 transition">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl bg-green-500/80 hover:bg-green-500/90 text-white transition">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('script')
<script>
    $(document).ready(function() {
    const table = $('#dataTableItem').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('all.User') }}",
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        },
        columns: [
            { data: 'id', render: (data,type,row,meta)=> meta.row+1 },
            { data: 'name' },
            { data: 'phone' },
            { data: 'email' },
            { data: 'roles_html', orderable:false, searchable:false },
            { data: null, className:"text-center", orderable:false, searchable:false,
              render: function(data,type,row){
                  return `
                  <button class="text-blue-500 hover:text-blue-700 mx-1 edit-button" data-id="${row.uid}">
                      <i class="bi bi-pencil-square"></i>
                  </button>
                  <button class="text-red-500 hover:text-red-700 mx-1 delete-button" data-id="${row.uid}">
                      <i class="bi bi-trash-fill"></i>
                  </button>`;
              }
            }
        ],
        order:[[0,'desc']]
    });

    // Modal functions
    window.openModal = ()=>{ $('#createUserModal').removeClass('hidden'); loadRoles(); };
    window.closeModal = ()=>{ $('#createUserModal').addClass('hidden'); $('#createUserForm')[0].reset(); };

    function loadRoles() {
        $.ajax({
            url: "{{ route('GetRoles') }}",
            type: 'GET',
            success: function(roles){
                let select=$('#rolesSelect');
                select.empty();
                roles.forEach(role=>select.append(`<option value="${role.name}">${role.name}</option>`));
            },
            error:()=>Swal.fire('Error','Could not load roles','error')
        });
    }

    $('#createUserForm').submit(function(e){
        e.preventDefault();
        let formData=new FormData(this);
        $.ajax({
            url: "{{ route('User.store') }}",
            type: 'POST',
            data: formData,
            processData:false,
            contentType:false,
            beforeSend:()=>Swal.fire({title:'Saving...',allowOutsideClick:false,didOpen:()=>Swal.showLoading()}),
            success: function(response){
                Swal.close();
                let res=typeof response==='string'?JSON.parse(response):response;
                if(res.statusCode===200){ table.ajax.reload(); closeModal(); Swal.fire('Success',res.statusMsg,'success'); }
                else Swal.fire('Error',res.statusMsg,'error');
            },
            error: ()=>Swal.fire('Error','Could not save data','error')
        });
    });
});
</script>
@endsection