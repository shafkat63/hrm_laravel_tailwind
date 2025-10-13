@extends('layout.appmain')

@section('title', 'Role Management')

@section('mainContent')
<div class="container mx-auto mt-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Role Management</h2>
        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
            onclick="openModal('addRoleModal')">
            Add New Role
        </button>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200" id="rolesTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Roles loaded dynamically via AJAX -->
            </tbody>
        </table>
    </div>
</div>

<!-- ADD ROLE MODAL -->
<div class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" id="addRoleModal">
    <div class="bg-white rounded-lg shadow-lg w-96">
        <form id="addRoleForm" class="p-6">
            @csrf
            <h3 class="text-lg font-semibold mb-4">Add New Role</h3>
            <input type="text" name="name" placeholder="Role Name" class="w-full px-3 py-2 border rounded mb-4"
                required>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('addRoleModal')"
                    class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
                <button type="submit" id="btnSaveRole"
                    class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT ROLE MODAL -->
<div class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" id="editRoleModal">
    <div class="bg-white rounded-lg shadow-lg w-96">
        <form id="editRoleForm" class="p-6">
            @csrf
            @method('PUT')
            <input type="hidden" id="editRoleId">
            <h3 class="text-lg font-semibold mb-4">Edit Role</h3>
            <input type="text" name="name" id="editRoleName" placeholder="Role Name"
                class="w-full px-3 py-2 border rounded mb-4" required>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editRoleModal')"
                    class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
                <button type="submit" id="btnUpdateRole"
                    class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- PERMISSION MODAL -->
<div class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" id="permissionModal">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h3 class="text-lg font-semibold mb-4">Assign Permissions</h3>
        <input type="hidden" id="permRoleId">
        <div id="permissionList" class="space-y-2 max-h-64 overflow-y-auto"></div>
        <div class="flex justify-end space-x-2 mt-4">
            <button onclick="closeModal('permissionModal')"
                class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
            <button onclick="savePermissions()"
                class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
        </div>
    </div>
</div>

<!-- MENU MODAL -->
<div class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" id="menuModal">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h3 class="text-lg font-semibold mb-4">Assign Menus</h3>
        <input type="hidden" id="menuRoleId">
        <div id="menuList" class="space-y-2 max-h-64 overflow-y-auto"></div>
        <div class="flex justify-end space-x-2 mt-4">
            <button onclick="closeModal('menuModal')"
                class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
            <button onclick="saveMenus()"
                class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

$(document).ready(function () {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });

    // Load Roles
    function loadRoles() {
        $.get("/get/all/Roles", function(response){
            let rows = '';
            $.each(response.data, function(i, role){
                rows += `
                    <tr>
                        <td class="px-6 py-4">${i+1}</td>
                        <td class="px-6 py-4">${role.name}</td>
                        <td class="px-6 py-4 space-x-2">
                            <button class="editRole px-2 py-1 bg-blue-500 text-white rounded" data-id="${role.id}">Edit</button>
                            <button class="deleteRole px-2 py-1 bg-red-500 text-white rounded" data-id="${role.id}">Delete</button>
                            <button onclick="addMenuToRole(${role.id})" class="px-2 py-1 bg-yellow-500 text-white rounded">Add Menu</button>
                            <button onclick="addPermissionToRole(${role.id})" class="px-2 py-1 bg-teal-500 text-white rounded">Add Permission</button>
                        </td>
                    </tr>`;
            });
            $("#rolesTable tbody").html(rows);
        });
    }
    loadRoles();

    // Add Role
    $("#addRoleForm").submit(function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $("#btnSaveRole").prop("disabled", true).text("Saving...");
        $.post("/roles", formData)
            .done(() => { $("#btnSaveRole").prop("disabled", false).text("Save"); closeModal('addRoleModal'); loadRoles(); Swal.fire("Success","Role created!","success"); })
            .fail(xhr => { $("#btnSaveRole").prop("disabled", false).text("Save"); Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong","error"); });
    });

    // Edit Role
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
            .done(() => { $("#btnUpdateRole").prop("disabled", false).text("Update"); closeModal('editRoleModal'); loadRoles(); Swal.fire("Success","Role updated","success"); })
            .fail(xhr => { $("#btnUpdateRole").prop("disabled", false).text("Update"); Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong","error"); });
    });

    // Delete Role
    $(document).on("click", ".deleteRole", function(){
        let id = $(this).data("id");
        Swal.fire({title:"Delete?", text:"This role will be removed!", icon:"warning", showCancelButton:true, confirmButtonText:"Yes, delete"})
        .then((res) => {
            if(res.isConfirmed){
                $.ajax({url:`/roles/${id}`, type:"DELETE"})
                .done(() => { loadRoles(); Swal.fire("Deleted!","Role removed","success"); })
                .fail(() => Swal.fire("Error","Unable to delete","error"));
            }
        });
    });
});

// Permissions
function addPermissionToRole(roleId){
    $.get(`/addpermission/${roleId}`, function(resp){
        $('#permRoleId').val(resp.role.id);
        let html = '';
        resp.permissions.forEach(p => {
            let checked = resp.roleHavePermission[p.id] ? 'checked' : '';
            html += `<div><label class="flex items-center space-x-2"><input type="checkbox" class="permissionCheckbox" value="${p.id}" ${checked}><span>${p.name}</span></label></div>`;
        });
        $('#permissionList').html(html);
        openModal('permissionModal');
    });
}

function savePermissions(){
    let roleId = $('#permRoleId').val();
    let permissionIds = [];
    $('.permissionCheckbox:checked').each(function(){ permissionIds.push($(this).val()); });
    $.post('/GivePermissionToRole', { id: roleId, permission: permissionIds })
        .done(() => { closeModal('permissionModal'); Swal.fire('Success','Permissions assigned','success'); })
        .fail(xhr => { Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong','error'); });
}

// Menus
function addMenuToRole(roleId){
    $.get(`/addmenu/${roleId}`, function(resp){
        $('#menuRoleId').val(resp.role.id);
        let html = '';
        function renderMenu(menus, indent=0){
            menus.forEach(menu => {
                html += `<div style="margin-left:${indent*20}px;"><label class="flex items-center space-x-2"><input type="checkbox" class="menuCheckbox" value="${menu.id}" ${menu.menu_exists ? 'checked' : ''}><span>${menu.title}</span></label></div>`;
                if(menu.submenu && menu.submenu.length > 0){ renderMenu(menu.submenu, indent+1); }
            });
        }
        renderMenu(resp.menu);
        $('#menuList').html(html);
        openModal('menuModal');
    });
}

function saveMenus(){
    let roleId = $('#menuRoleId').val();
    let menuIds = [];
    $('.menuCheckbox:checked').each(function(){ menuIds.push($(this).val()); });
    $.post('/GiveMenuToRole', { role_id: roleId, menu_id: menuIds })
        .done(() => { closeModal('menuModal'); Swal.fire('Success','Menus assigned','success'); })
        .fail(xhr => { Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong','error'); });
}
</script>
@endsection