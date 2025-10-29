@extends('layout.appmain')
@section('title', '- Permissions')

@section('mainContent')


<div class="container mx-auto mt-10 px-4">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 drop-shadow-sm">Permissions Management</h2>
        <nav class="text-sm text-gray-700 mt-1">
            <ol class="list-reset flex space-x-2">
                <li><a href="{{ url('/') }}" class="text-blue-600 hover:underline">Home</a></li>
                <li>/</li>
                <li>User Config</li>
                <li>/</li>
                <li class="font-semibold text-gray-800">Permissions</li>
            </ol>
        </nav>
    </div>
    <!-- Card -->
    <div class="bg-white/30 backdrop-blur-md shadow-lg rounded-2xl overflow-hidden border border-white/20">
        <div class="flex justify-between items-center px-6 py-4 border-b border-white/20">
            <h5 class="text-lg font-semibold text-gray-800">Permission List</h5>
            <button id="openCreateModal"
                class="inline-flex items-center gap-2 bg-green-500/70 hover:bg-green-500/90 text-white text-sm font-medium px-4 py-2 rounded-xl transition backdrop-blur-sm">
                Add New <i class="bi bi-plus"></i>
            </button>
        </div>

        <!-- DataTable -->
        <div class="overflow-x-auto">
            <table id="dataTableItem"
                class="min-w-full border border-white/20 rounded-xl bg-white/20 backdrop-blur-md text-gray-800">
                <thead class="bg-white/30 backdrop-blur-md text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-2 border-b border-white/80">SL</th>
                        <th class="px-4 py-2 border-b border-white/80">Name</th>
                        <th class="px-4 py-2 border-b border-white/80">Guard Name</th>
                        <th class="px-4 py-2 border-b border-white/80">Created At</th>
                        <th class="px-4 py-2 border-b border-white/80">Updated At</th>
                        <th class="px-4 py-2 border-b border-white/80 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="backdrop-blur-sm">
                    <!-- rows will be injected by DataTables -->
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Create Modal -->
<div id="createModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl w-full max-w-md p-6 border border-white/20">
        <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Create Permission</h3>
            <button id="closeModal" class="text-gray-700 hover:text-gray-900">&times;</button>
        </div>

        <form id="permissionForm">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Permission Name</label>
                <input type="text" id="name" name="name"
                    class="w-full border border-white/80 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800"
                    placeholder="Enter permission name">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Type</label>
                <select id="type" name="type"
                    class="w-full border border-white/80 rounded-xl bg-white/80 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                    <option value="Single">Single Permission</option>
                    <option value="CRUD">CRUD (view, create, update, delete)</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" id="cancelModal"
                    class="bg-gray-200/60 hover:bg-gray-200/80 text-gray-800 px-4 py-2 rounded-xl">Cancel</button>
                <button type="submit"
                    class="bg-blue-600/70 hover:bg-blue-600/90 text-white px-5 py-2 rounded-xl">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white/30 backdrop-blur-md rounded-2xl shadow-2xl w-full max-w-md p-6 border border-white/20">
        <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Edit Permission</h3>
            <button id="closeEditModal" class="text-gray-700 hover:text-gray-900">&times;</button>
        </div>

        <form id="editPermissionForm">
            @csrf
            <input type="hidden" id="edit_id" name="id">
            <div class="mb-4">
                <label for="edit_name" class="block text-gray-700 font-semibold mb-2">Permission Name</label>
                <input type="text" id="edit_name" name="name"
                    class="w-full border border-white/30 rounded-xl bg-white/20 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800"
                    placeholder="Enter permission name">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Type</label>
                <select id="edit_type" name="type"
                    class="w-full border border-white/30 rounded-xl bg-white/20 backdrop-blur-sm px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-gray-800">
                    <option value="Single">Single Permission</option>
                    <option value="CRUD">CRUD (view, create, update, delete)</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" id="cancelEditModal"
                    class="bg-gray-200/60 hover:bg-gray-200/80 text-gray-800 px-4 py-2 rounded-xl">Cancel</button>
                <button type="submit"
                    class="bg-blue-600/70 hover:bg-blue-600/90 text-white px-5 py-2 rounded-xl">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
    let table = $('#dataTableItem').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('all.Permission') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}" }
        },
        columns: [
            { data: 'id', render: (data, type, row, meta) => meta.row + 1 },
            { data: 'name' },
            { data: 'guard_name' },
            { data: 'created_at' },
            { data: 'updated_at' },
            {
                data: 'id',
                className: "text-center",
                render: function(id) {
                    return `
                        <button class="text-blue-500 hover:text-blue-700 mx-1 edit-btn" data-id="${id}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700 mx-1 delete-button" data-id="${id}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    `;
                }
            }
        ],
        order: [[0, 'desc']]
    });

    // Create Modal
    $('#openCreateModal').click(()=>$('#createModal').removeClass('hidden'));
    $('#closeModal, #cancelModal').click(()=>{ $('#createModal').addClass('hidden'); $('#permissionForm')[0].reset(); });

    $('#permissionForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ route('Permission.store') }}",
            method: "POST",
            data: { _token:"{{ csrf_token() }}", name:$('#name').val(), type:$('#type').val() },
            beforeSend: ()=>Swal.fire({title:'Saving...', allowOutsideClick:false, didOpen:()=>Swal.showLoading()}),
            success: function(res){
                Swal.close();
                if(res.statusCode===200){ Swal.fire('Success', res.statusMsg,'success'); $('#createModal').addClass('hidden'); $('#permissionForm')[0].reset(); table.ajax.reload(null,false); }
                else Swal.fire('Error', res.statusMsg,'error');
            },
            error: ()=>{ Swal.close(); Swal.fire('Error','Something went wrong!','error'); }
        });
    });

    // Edit Modal
    $(document).on('click','.edit-btn',function(){
        let id=$(this).data('id');
        $.get("/Permission/"+id,function(res){
            let data=res[0];
            $('#edit_id').val(data.id); $('#edit_name').val(data.name);
            if(/view_|create_|update_|delete_/.test(data.name)) $('#edit_type').val('CRUD'); else $('#edit_type').val('Single');
            $('#editModal').removeClass('hidden');
        }).fail(()=>Swal.fire('Error','Failed to fetch permission data','error'));
    });
    $('#closeEditModal, #cancelEditModal').click(()=>{ $('#editModal').addClass('hidden'); $('#editPermissionForm')[0].reset(); });

    $('#editPermissionForm').submit(function(e){
        e.preventDefault();
        let id=$('#edit_id').val();
        $.ajax({
            url:"/Permission", method:"POST",
            data:{ _token:"{{ csrf_token() }}", id:id, name:$('#edit_name').val(), type:$('#edit_type').val() },
            beforeSend:()=>Swal.fire({title:'Updating...', allowOutsideClick:false, didOpen:()=>Swal.showLoading()}),
            success: function(res){
                Swal.close();
                if(res.statusCode===200){ Swal.fire('Success', res.statusMsg,'success'); $('#editModal').addClass('hidden'); $('#editPermissionForm')[0].reset(); table.ajax.reload(null,false); }
                else Swal.fire('Error', res.statusMsg,'error');
            },
            error: ()=>{ Swal.close(); Swal.fire('Error','Something went wrong!','error'); }
        });
    });

    // Delete
    $(document).on('click','.delete-button',function(){
        let id=$(this).data('id');
        Swal.fire({
            title:"Are you sure?", text:"This permission will be deleted permanently!", icon:"warning",
            showCancelButton:true, confirmButtonColor:"#d33", cancelButtonColor:"#3085d6", confirmButtonText:"Yes, delete it!"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({ url:"/Permission/"+id, type:"DELETE", data:{_token:"{{ csrf_token()}}"}, success:()=>{ Swal.fire("Deleted!","The permission has been deleted.","success"); table.ajax.reload(null,false); }, error:()=>Swal.fire("Error!","Failed to delete permission.","error") });
            }
        });
    });
});
</script>
@endsection