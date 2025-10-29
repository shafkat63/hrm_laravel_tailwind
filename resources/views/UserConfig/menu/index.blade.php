@extends('layout.appmain')

@section('mainContent')
@section('title', '- Menu')
<div class="container mx-auto mt-10 px-4">
    <h4 class="py-3 mb-4 text-2xl font-semibold text-gray-800">Menu</h4>


 <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 drop-shadow-sm">Menu Setup</h2>
        <button
            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2.5 rounded-xl shadow-md hover:from-green-600 hover:to-emerald-700 transition-all"
              onclick="showModal()">
            + Add New Menu
        </button>
    </div>


    <!-- Card/Table -->
    <section class="bg-white shadow rounded-lg p-4">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
            <button class="px-3 py-1.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition mb-3 md:mb-0"
                onclick="printTable()">Print</button>

            <!-- Column Toggle Dropdown -->
            <div class="relative inline-block">
                <button type="button"
                    class="px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition"
                    id="filterColumnsBtn">Filter Columns</button>
                <ul class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg p-3 max-h-60 overflow-y-auto hidden"
                    id="columnToggleContainer">
                    {{-- Columns populated dynamically --}}
                </ul>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="DataTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">SL</th>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Parent ID</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Icon</th>
                        <th class="px-4 py-2">URL</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>

    <!-- Create/Edit Modal -->
    <div id="createModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold title">Add New Menu</h4>
                <button class="text-gray-500 hover:text-gray-700"
                    onclick="$('#createModal').addClass('hidden')">&times;</button>
            </div>
            <form id="createForm" class="space-y-4" onsubmit="return false">@csrf
                <input type="hidden" id="id" name="id" class="hidden" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700" for="parent_id">Parent Menu</label>
                        <select id="parent_id" name="parent_id" class="w-full border border-gray-300 rounded-lg p-2">
                            <option value="#">No Parent</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700" for="title">Title</label>
                        <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded-lg p-2"
                            placeholder="Title">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700" for="icon">Icon</label>
                        <input type="text" id="icon" name="icon" class="w-full border border-gray-300 rounded-lg p-2"
                            placeholder="Icon">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700" for="url">URL</label>
                        <input type="text" id="url" name="url" class="w-full border border-gray-300 rounded-lg p-2"
                            placeholder="URL">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700" for="status">Status</label>
                        <select id="status" name="status" class="w-full border border-gray-300 rounded-lg p-2">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300"
                        onclick="$('#createModal').addClass('hidden')">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                        onclick="save()">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    // Initialize DataTable
    var table1 = $('#DataTable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: '{!! route('all.menu') !!}', 
        columns: [
            {
                data: 'id',
                name: 'serial_number',
                render: function (data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                },
                orderable: false,
                searchable: false
            },
            { data: 'id', name: 'id' },
            { data: 'parent_id', name: 'parent_id' },
            { data: 'title', name: 'title' },
            { data: 'icon', name: 'icon' },
            { data: 'url', name: 'url' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
    });

    // Show Modal
    function showModal() {
        $('.title').text('Add Menu'); 
        $('#createForm')[0].reset();  
        $('#id').val(''); 
        $('#createModal').removeClass('hidden');
    }

    // Save Menu
    function save() {
        let url = "{{ url('menu') }}"; 
        let formData = new FormData($("#createForm")[0]);  
        let submitButton = $('#createForm button[type="submit"]');
        submitButton.prop('disabled', true);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    $('#createModal').addClass('hidden');
                    table1.ajax.reload();
                    swal("Success", response.statusMsg, "success");
                    loadParentMenus();
                    $('#createForm')[0].reset();
                } else {
                    swal("Error", response.statusMsg || "An unknown error occurred.", "error");
                }
            },
            error: function (xhr) {
                let errorMessage = xhr.responseJSON?.message || xhr.responseText || "Error occurred";
                swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500 });
            },
            complete: function () {
                submitButton.prop('disabled', false);
            }
        });
    }

    // Show Data
    function showData(id) {
        $.get(`{{ url('menu') }}/${id}`, function (data) {
            $('#createForm')[0].reset();
            $('.title').text('Update Menu');
            $('#id').val(data.id);
            $('#parent_id').val(data.parent_id);
            $('#title').val(data.title);
            $('#icon').val(data.icon);
            $('#url').val(data.url);
            $('#status').val(data.status);
            $('#createModal').removeClass('hidden');
        }).fail(() => swal({ title: "Oops", text: "Error occurred", icon: "error", timer: 1500 }));
    }

    // Delete Data
    function deleteData(id) {
        let csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure?",
            text: "Once deleted, this cannot be recovered!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.post(`{{ url('menu') }}/${id}`, {_method:'DELETE', _token: csrf_token}, function(response){
                    if(response.statusCode === 200){
                        table1.ajax.reload(null,false);
                        swal("Deleted!", "The record has been deleted!", "success");
                    } else {
                        swal("Error", response.statusMsg || "Failed to delete.", "error");
                    }
                });
            }
        });
    }

    // Load Parent Menus
    function loadParentMenus(){
        $.get("{{ route('getparentmenus') }}", function(response){
            if(response.statusCode === 200 && Array.isArray(response.data)){
                const parentSelect = $('#parent_id');
                parentSelect.empty();
                parentSelect.append('<option value="#">No Parent</option>');
                response.data.forEach(menu => parentSelect.append(`<option value="${menu.id}">${menu.title}</option>`));
            }
        });
    }
    $(document).ready(loadParentMenus);

    // Column Toggle
    $(document).ready(function () {
        let table = $("#DataTable");
        let container = $("#columnToggleContainer");
        let headers = table.find("thead th");

        headers.each(function (index) {
            container.append(`
                <li class="mb-1">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="toggle-column" data-column="${index}" checked>
                        <span>${$(this).text().trim()}</span>
                    </label>
                </li>
            `);
        });

        $(document).on("change", ".toggle-column", function () {
            let colIndex = $(this).data("column");
            let show = $(this).is(":checked");
            table.find("tr").each(function () {
                $(this).find("td, th").eq(colIndex).toggle(show);
            });
        });

        $("#filterColumnsBtn").click(function(){
            container.toggleClass("hidden");
        });
    });

    // Print
    function printTable() {
        let newWin = window.open("", "_blank");
        newWin.document.write(`<html><head><title>Print Table</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
            </head><body>${document.getElementById("DataTable").outerHTML}</body></html>`);
        newWin.document.close();
    }
</script>
@endsection