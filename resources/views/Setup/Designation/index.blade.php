@extends('layout.appmain')
@section('title', '- Designation')
@section('mainContent')
<div class="container mx-auto mt-10 px-4">

    <!-- Header and Breadcrumb -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h2 class="text-3xl font-extrabold text-gray-800 drop-shadow-sm mb-2 sm:mb-0">Designations Management</h2>
        <nav class="text-sm text-gray-700 mt-1" aria-label="Breadcrumb">
            <ol class="list-reset flex space-x-2">
                <li><a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 transition duration-150">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li>Designation Config</li>
                <li><span class="text-gray-400">/</span></li>
                <li class="font-semibold text-gray-800">Designation Info</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white/90 backdrop-blur-lg shadow-3xl rounded-2xl overflow-hidden border border-gray-100">

        <!-- Table Header and Add Button -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-6 py-4 border-b border-gray-200">
            <h5 class="text-xl font-semibold text-gray-800 mb-2 sm:mb-0">Designation Information Table</h5>
            <a href="javascript:void(0)" onclick="openModal('create')" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02] active:scale-[0.98]">
                <i class="bi bi-plus text-lg"></i> Add New Designation
            </a>
        </div>

        <!-- Filter Section -->
        <div class="p-6 bg-gray-50/70 border-b border-gray-200">
            <h6 class="text-sm font-bold text-gray-700 mb-3">Filter Options:</h6>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="filterStatus" class="block text-xs font-medium text-gray-700 mb-1">Filter by Status</label>
                    <select id="filterStatus" class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                        <option value="">All Statuses</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-span-1">
                    <button id="applyFilterButton" class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition duration-300 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                        Apply Filter <i class="bi bi-funnel text-xs"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="overflow-x-auto p-4">
            <table id="dataTableDesignation" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100/70 text-xs text-gray-700 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">SL</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Name</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Description</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Status</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Created By</th>
                        <th class="px-6 py-3 text-left font-bold border-b border-gray-200">Updated By</th>
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

<!-- Create/Edit Designation Modal -->
<div id="createDesignationModal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-4 overflow-y-auto">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative w-full max-w-lg bg-white/95 backdrop-blur-lg rounded-2xl shadow-3xl border border-white/50 p-6 mx-auto flex flex-col max-h-[90vh]">
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-3 flex-shrink-0">
            <h3 id="modalTitle" class="text-2xl font-bold text-gray-800">Add New Designation</h3>
            <button class="text-gray-500 hover:text-gray-800 text-3xl transition" onclick="closeModal()">&times;</button>
        </div>

        <!-- Modal Body (Form) -->
        <div class="overflow-y-auto pr-2 flex-1 custom-scrollbar">
            <form id="createDesignationForm">
                @csrf
                <input type="hidden" name="designation_id" id="designationIdField">
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="name">Name</label>
                        <input type="text" name="name" id="name" required class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1" for="status">Status</label>
                        <select name="status" id="status" required class="w-full border border-gray-300 rounded-xl bg-white px-3 py-2 text-gray-800 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Modal Footer (Save/Cancel Buttons) -->
                <div class="mt-8 pt-4 border-t border-gray-200 flex flex-col sm:flex-row justify-end gap-3 flex-shrink-0">
                    <button type="button" onclick="closeModal()" class="px-5 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition duration-200 shadow-sm">Cancel</button>
                    <button type="submit" id="saveButton" class="px-5 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white transition duration-200 shadow-md transform hover:scale-[1.02] active:scale-[0.98]">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
let currentMode = 'create';
let dataTable;

const showLoading = (title) => Swal.fire({
    title: title,
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
});

$(document).ready(function() {
    dataTable = $('#dataTableDesignation').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('all.Designation') }}",
            type: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function(d) {
                d.status = $('#filterStatus').val();
            }
        },
        columns: [
            { data: 'id', render: (data,type,row,meta) => meta.row + 1, className: 'text-left' },
            { data: 'name', className: 'font-medium' },
            { data: 'description' },
            { data: 'status'},
            { data: 'create_by' },
            { data: 'update_by' },
            {
                data: null,
                className: "text-center whitespace-nowrap",
                orderable: false,
                searchable: false,
                render: function(data,type,row) {
                    const desigId = row.id;
                    return `
                        <div class="flex justify-center items-center space-x-2">
                            <button class="text-blue-500 hover:text-blue-700 edit-button p-1 rounded-full hover:bg-blue-50 transition" data-id="${desigId}" title="Edit Designation">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700 delete-button p-1 rounded-full hover:bg-red-50 transition" data-id="${desigId}" title="Delete Designation">
                                <i class="bi bi-trash-fill text-lg"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        order:[[0,'desc']],
        dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lBf>rtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    $('#applyFilterButton').on('click', function() {
        dataTable.ajax.reload();
    });

    window.openModal = (mode = 'create', desigId = null) => {
        currentMode = mode;
        const $modal = $('#createDesignationModal');
        const $form = $('#createDesignationForm');
        $form[0].reset();
        $('#designationIdField').val('');

        if(mode === 'edit' && desigId) {
            $('#modalTitle').text('Edit Designation');
            $('#saveButton').text('Update Designation');
            $('#designationIdField').val(desigId);

            showLoading('Loading designation data...');
            $.ajax({
                url: `/Designation/${desigId}/edit`,
                type: 'GET',
                success: function(designation) {
                    Swal.close();
                    if(designation) {
                        $('#name').val(designation.name);
                        $('#description').val(designation.description);
                        $('#status').val(designation.status.toString());
                    }
                    $modal.removeClass('hidden');
                },
                error: ()=> {
                    Swal.close();
                    Swal.fire('Error', 'Could not load designation data', 'error');
                    closeModal();
                }
            });
        } else {
            $('#modalTitle').text('Add New Designation');
            $('#saveButton').text('Save Designation');
            $modal.removeClass('hidden');
        }
    };

    window.closeModal = () => {
        $('#createDesignationModal').addClass('hidden');
        $('#createDesignationForm')[0].reset();
        currentMode = 'create';
    };

    $('#createDesignationForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        let url = currentMode === 'create' ? "{{ route('Designation.store') }}" : `/Designation/${$('#designationIdField').val()}`;
        let method = currentMode === 'create' ? 'POST' : 'POST';

        if(currentMode === 'edit') {
            formData.append('_method', 'PATCH');
        }

        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => showLoading('Saving data...'),
            success: function(response) {
                Swal.close();
                let res = typeof response === 'string' ? JSON.parse(response) : response;
                if(res.statusCode === 200 || res.success) {
                    dataTable.ajax.reload();
                    closeModal();
                    Swal.fire('Success', res.statusMsg || 'Designation saved successfully', 'success');
                } else {
                    Swal.fire('Error', res.statusMsg || res.message || 'An error occurred during save.', 'error');
                }
            },
            error: (jqXHR) => {
                Swal.close();
                if(jqXHR.status === 422) {
                    const errors = jqXHR.responseJSON.errors;
                    let errorList = '<ul>';
                    for(let field in errors) {
                        errors[field].forEach(msg => {
                            errorList += `<li>- ${msg}</li>`;
                        });
                    }
                    errorList += '</ul>';
                    Swal.fire('Validation Error', errorList, 'error');
                } else {
                    Swal.fire('Error', 'Could not process request. Check server response.', 'error');
                }
            }
        });
    });

    $('#dataTableDesignation tbody').on('click', '.edit-button', function() {
        const desigId = $(this).data('id');
        openModal('edit', desigId);
    });

    $('#dataTableDesignation tbody').on('click', '.delete-button', function() {
        const desigId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This action is irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed) {
                deleteDesignation(desigId);
            }
        });
    });

    function deleteDesignation(desigId) {
        $.ajax({
            url: `/Designation/${desigId}`,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: () => showLoading('Deleting designation...'),
            success: function(response) {
                Swal.close();
                let res = typeof response === 'string' ? JSON.parse(response) : response;
                if(res.statusCode === 200 || res.success) {
                    dataTable.ajax.reload();
                    Swal.fire('Deleted!', res.statusMsg || 'Designation has been deleted.', 'success');
                } else {
                    Swal.fire('Error', res.statusMsg || 'Could not delete designation.', 'error');
                }
            },
            error: () => Swal.fire('Error', 'Could not connect to server to delete designation.', 'error')
        });
    }
});
</script>
@endsection
