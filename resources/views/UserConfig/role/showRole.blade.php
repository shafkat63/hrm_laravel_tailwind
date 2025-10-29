@extends('layout.appmain')

@section('title', 'Role Management')

@section('mainContent')
<div class="container mx-auto mt-10 px-4">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 drop-shadow-sm">Role Management</h2>
        <button
            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2.5 rounded-xl shadow-md hover:from-green-600 hover:to-emerald-700 transition-all"
            onclick="openModal('addRoleModal')">
            + Add New Role
        </button>
    </div>

    <div
        class="backdrop-blur-md bg-white/80 border border-white/50 shadow-lg rounded-2xl overflow-hidden transition-all hover:shadow-xl p-4">
        <table class="min-w-full divide-y divide-gray-200" id="rolesTable">
            <thead class="bg-white/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Role
                        Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white/30 text-gray-800">
            </tbody>
        </table>
    </div>
</div>


{{-- === ADD ROLE MODAL === --}}
<div class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50" id="addRoleModal">
    <div class="bg-white/80 backdrop-blur-md border border-white/60 rounded-2xl shadow-2xl w-96 p-6 transition-all">
        <form id="addRoleForm">
            @csrf
            <h3 class="text-lg font-semibold mb-4 text-gray-900">Add New Role</h3>
            <input type="text" name="name" placeholder="Role Name"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none mb-4"
                required>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addRoleModal')"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">Close</button>
                <button type="submit" id="btnSaveRole"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50" id="editRoleModal">
    {{-- ... content ... --}}
    <div class="bg-white/80 backdrop-blur-md border border-white/60 rounded-2xl shadow-2xl w-96 p-6 transition-all">
        <form id="editRoleForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editRoleId">
            <h3 class="text-lg font-semibold mb-4 text-gray-900">Edit Role</h3>
            <input type="text" name="name" id="editRoleName" placeholder="Role Name"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none mb-4"
                required>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal('editRoleModal')"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">Close</button>
                <button type="submit" id="btnUpdateRole"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">Update</button>
            </div>
        </form>
    </div>
</div>

{{-- === PERMISSION MODAL === --}}
<div id="permissionModal"
    class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 sm:p-6">
    <div class="bg-white/90 backdrop-blur-md border border-white/60 rounded-2xl shadow-2xl 
               w-full max-w-5xl p-6 sm:p-8 transition-all transform scale-100">
        <h3 class="text-2xl font-semibold mb-6 text-gray-900 text-center sm:text-left">
            Assign Permissions
        </h3>

        <input type="hidden" id="permRoleId">

        <!-- Select All -->
        <div class="flex items-center justify-between mb-4">
            <label class="flex items-center space-x-2 font-semibold text-gray-800">
                <input type="checkbox" id="selectAllPermissions" class="accent-blue-600">
                <span>Select / Unselect All</span>
            </label>
        </div>

        <div id="permissionList"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-h-[65vh] overflow-y-auto custom-scrollbar p-3 bg-white/60 rounded-xl">
        </div>

        <!-- Footer Buttons -->
        <div class="flex flex-col sm:flex-row justify-end mt-8 space-y-3 sm:space-y-0 sm:space-x-3">
            <button onclick="closeModal('permissionModal')"
                class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                Close
            </button>
            <button onclick="savePermissions()"
                class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </div>
</div>

{{-- === MENU MODAL === --}}

<div id="menuModal"
    class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 sm:p-6">
    <div class="bg-white/90 backdrop-blur-md border border-white/60 rounded-2xl shadow-2xl 
                w-full max-w-4xl p-6 sm:p-8 transition-all transform scale-100">
        <h3 class="text-2xl font-semibold mb-6 text-gray-900 text-center sm:text-left">
            Assign Menus
        </h3>

        <input type="hidden" id="menuRoleId">

        <!-- Menu List Section -->
        <div id="menuList" class="max-h-[65vh] overflow-y-auto custom-scrollbar p-3 bg-white/60 rounded-xl space-y-4">
            {{-- Parent menus will be rendered here --}}
            {{-- Example structure dynamically generated by JS:
            <div class="parent-menu">
                <label class="flex items-center space-x-2 font-semibold">
                    <input type="checkbox" class="menuCheckbox" value="parent_id">
                    <span>Parent Menu Title</span>
                </label>
                <div class="child-menus ml-6 mt-2 space-y-1">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="menuCheckbox" value="child_id">
                        <span>Child Menu Title</span>
                    </label>
                </div>
            </div>
            --}}
        </div>

        <!-- Footer Buttons -->
        <div class="flex flex-col sm:flex-row justify-end mt-8 space-y-3 sm:space-y-0 sm:space-x-3">
            <button onclick="closeModal('menuModal')"
                class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                Close
            </button>
            <button onclick="saveMenus()"
                class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- DataTables CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
{{-- DataTables JS --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    // Modal functions remain the same
    function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

    // DataTables instance variable
    let rolesTable;

    $(document).ready(function () {
        $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });

        // Initialize DataTables
        rolesTable = $('#rolesTable').DataTable({
            processing: true,
            serverSide: false, 
            ajax: {
                url: "/get/all/Roles",
                dataSrc: 'data' 
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Row number for the '#' column
                    },
                    orderable: false,
                    searchable: false,
                    className: 'px-6 py-4'
                },
                { data: 'name', className: 'px-6 py-4 font-medium' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <div class="space-x-2">
                                <button class="editRole px-3 py-1.5 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition" data-id="${row.id}">Edit</button>
                                <button class="deleteRole px-3 py-1.5 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition" data-id="${row.id}">Delete</button>
                                <button onclick="addMenuToRole(${row.id})" class="px-3 py-1.5 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600 transition">Add Menu</button>
                                <button onclick="addPermissionToRole(${row.id})" class="px-3 py-1.5 bg-teal-500 text-white text-sm rounded-lg hover:bg-teal-600 transition">Add Permission</button>
                            </div>`;
                    },
                    orderable: false,
                    searchable: false,
                    className: 'px-6 py-4'
                }
            ],
            "dom": '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>'
        });

        function reloadRolesTable() {
            rolesTable.ajax.reload(null, false); // Reloads the table data without resetting the current page
        }


        // Add Role
        $("#addRoleForm").submit(function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $("#btnSaveRole").prop("disabled", true).text("Saving...");
            $.post("/roles", formData)
                .done(() => {
                    $("#btnSaveRole").prop("disabled", false).text("Save");
                    closeModal('addRoleModal');
                    reloadRolesTable(); // Use the DataTables reload function
                    Swal.fire("Success","Role created successfully!","success");
                    $("#addRoleForm")[0].reset(); // Clear the form
                })
                .fail(xhr => {
                    $("#btnSaveRole").prop("disabled", false).text("Save");
                    Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong","error");
                });
        });

        // Edit Role - Populating the modal
        $(document).on("click", ".editRole", function(){
            let id = $(this).data("id");
            $.get(`/roles/${id}/edit`, function(resp){
                $("#editRoleId").val(resp.id);
                $("#editRoleName").val(resp.name);
                openModal('editRoleModal');
            }).fail(() => Swal.fire("Error","Unable to fetch role","error"));
        });

        // Update Role
        $("#editRoleForm").submit(function(e){
            e.preventDefault();
            let id = $("#editRoleId").val();
            let data = $(this).serialize();
            $("#btnUpdateRole").prop("disabled", true).text("Updating...");
            $.ajax({ url:`/roles/${id}`, type:"PUT", data })
                .done(() => {
                    $("#btnUpdateRole").prop("disabled", false).text("Update");
                    closeModal('editRoleModal');
                    reloadRolesTable(); // Use the DataTables reload function
                    Swal.fire("Success","Role updated successfully!","success");
                })
                .fail(xhr => {
                    $("#btnUpdateRole").prop("disabled", false).text("Update");
                    Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong","error");
                });
        });

        // Delete Role
        $(document).on("click", ".deleteRole", function(){
            let id = $(this).data("id");
            Swal.fire({
                title:"Delete?",
                text:"This role will be permanently removed!",
                icon:"warning",
                showCancelButton:true,
                confirmButtonColor:"#e53e3e",
                confirmButtonText:"Yes, delete it!"
            }).then((res) => {
                if(res.isConfirmed){
                    $.ajax({url:`/roles/${id}`, type:"DELETE"})
                        .done(() => { reloadRolesTable(); Swal.fire("Deleted!","Role removed","success"); }) // Use the DataTables reload function
                        .fail(() => Swal.fire("Error","Unable to delete","error"));
                }
            });
        });
    });

function addPermissionToRole(roleId) {
    $.get(`/addpermission/${roleId}`, function (resp) {
        $('#permRoleId').val(resp.role.id);

        // Define your main categories
        const groups = {
            view: [],
            edit: [],
            create: [],
            delete: [],
            others: []
        };

        // Sort each permission into a group based on its name
        resp.permissions.forEach(p => {
            const name = p.name.toLowerCase();
            if (name.includes('view')) groups.view.push(p);
            else if (name.includes('edit') || name.includes('update')) groups.edit.push(p);
            else if (name.includes('create') || name.includes('add')) groups.create.push(p);
            else if (name.includes('delete') || name.includes('remove')) groups.delete.push(p);
            else groups.others.push(p);
        });

        // Render HTML for each group
        let html = '';
        Object.keys(groups).forEach(group => {
            if (groups[group].length === 0) return;

            const title = group.charAt(0).toUpperCase() + group.slice(1);
            html += `
                <div class="permission-group border border-gray-200 rounded-xl bg-white/70 shadow-sm p-4">
                    <h4 class="permission-group-header text-base font-semibold mb-2 text-gray-800 border-b pb-1 cursor-pointer">
                        ${title}
                    </h4>
                    <div class="space-y-1">
                        ${groups[group].map(p => {
                            const checked = resp.roleHavePermission[p.id] ? 'checked' : '';
                            return `
                                <label class="flex items-center space-x-2 text-sm text-gray-700">
                                    <input type="checkbox" class="permissionCheckbox accent-blue-600" value="${p.id}" ${checked}>
                                    <span>${p.name}</span>
                                </label>`;
                        }).join('')}
                    </div>
                </div>`;
        });

        $('#permissionList').html(html);
        $('#selectAllPermissions').prop('checked', false); // reset select all
        openModal('permissionModal');
    });
}

// Save Permissions
function savePermissions(){
    let roleId = $('#permRoleId').val();
    let permissionIds = [];
    $('.permissionCheckbox:checked').each(function(){ permissionIds.push($(this).val()); });
    $.post('/GivePermissionToRole', { id: roleId, permission: permissionIds })
        .done(() => { closeModal('permissionModal'); Swal.fire('Success','Permissions assigned successfully!','success'); })
        .fail(xhr => { Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong','error'); });
}

// Select / Unselect All
$(document).on('change', '#selectAllPermissions', function() {
    const isChecked = $(this).is(':checked');
    $('.permissionCheckbox').prop('checked', isChecked);
});

// Group header click to select/unselect all in that group
$(document).on('click', '.permission-group-header', function() {
    const groupDiv = $(this).closest('.permission-group');
    const checkboxes = groupDiv.find('.permissionCheckbox');
    const allChecked = checkboxes.filter(':checked').length === checkboxes.length;
    checkboxes.prop('checked', !allChecked);
});


function addMenuToRole(roleId){
    $.get(`/addmenu/${roleId}`, function(resp){
        $('#menuRoleId').val(resp.role.id);
        let html = '';

        // Loop through top-level menus (parent_id = null or '#')
        resp.menu.forEach(parent => {
            html += `<div class="parent-menu p-2 bg-white/70 rounded-lg">
                        <label class="flex items-center space-x-2 font-semibold">
                            <input type="checkbox" class="menuCheckbox" value="${parent.id}" ${parent.menu_exists ? 'checked' : ''}>
                            <span>${parent.title}</span>
                        </label>`;

            if(parent.submenu && parent.submenu.length > 0){
                html += `<div class="child-menus ml-6 mt-2 space-y-1">`;
                parent.submenu.forEach(child => {
                    html += `<label class="flex items-center space-x-2">
                                <input type="checkbox" class="menuCheckbox" value="${child.id}" ${child.menu_exists ? 'checked' : ''}>
                                <span>${child.title}</span>
                             </label>`;
                });
                html += `</div>`;
            }

            html += `</div>`; // end parent menu
        });

        $('#menuList').html(html);
        openModal('menuModal');
    });
}



// === Checkbox Linking Logic ===
$(document).on('change', '.menuCheckbox', function () {
    const isChecked = $(this).is(':checked');
    const currentId = $(this).val();

    // 1️⃣ Cascade change to all children recursively
    const changeChildren = (id, checked) => {
        $(`.menuCheckbox[data-parent="${id}"]`).each(function () {
            $(this).prop('checked', checked);
            changeChildren($(this).val(), checked); // recursive cascade
        });
    };
    changeChildren(currentId, isChecked);

    // 2️⃣ If checked, ensure all parents are also checked
    if (isChecked) {
        let parentId = $(this).data('parent');
        while (parentId) {
            const parentCheckbox = $(`.menuCheckbox[value="${parentId}"]`);
            parentCheckbox.prop('checked', true);
            parentId = parentCheckbox.data('parent');
        }
    }
});



    function saveMenus(){
        let roleId = $('#menuRoleId').val();
        let menuIds = [];
        $('.menuCheckbox:checked').each(function(){ menuIds.push($(this).val()); });
        $.post('/GiveMenuToRole', { role_id: roleId, menu_id: menuIds })
            .done(() => { closeModal('menuModal'); Swal.fire('Success','Menus assigned successfully!','success'); })
            .fail(xhr => { Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong','error'); });
    }


    // Close modal when clicking outside the modal content
['addRoleModal', 'editRoleModal', 'permissionModal', 'menuModal'].forEach(id => {
    const modal = document.getElementById(id);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) { // only if click is outside modal content
            closeModal(id);
        }
    });
});

</script>
@endsection