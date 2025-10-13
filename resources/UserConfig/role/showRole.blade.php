@extends('layout.appmain')
@section('title', '- Role')

@section('main')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item">User Config</li>
                <li class="breadcrumb-item active">Role</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="card-title">Role</h5>
                        </div>
                        <div class="col-md-2 mt-3 ">
                            <a href="{{route('Roles.create')}}" type="button"
                                class="btn btn-outline-success btn-sm text-right"> Add New <i
                                    class="bi bi-plus"></i></a>
                        </div>
                    </div>
                    <form action="#" id="fromData" style="display: none">@csrf</form>
                    <table class="table table-hover table-responsive table-sm" id="dataTableItem">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Guard Name</th>
                                <th>Create At</th>
                                <th>Update At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- End Table with hoverable rows -->

                </div>
            </div>
        </div>
    </section>
    {{-- permission modal --}}
    <div class="modal fade" id="addRolePermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="role-title">Add Role To Permission</h3>
                    </div>
                    <!-- Add role form -->
                    <form id="addRoleForm" class="row g-3" onsubmit="return false">@csrf
                        <div class="col-12 mb-4">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="hidden" id="addId" name="id">
                            <input type="text" id="addName" name="name" class="form-control"
                                placeholder="Enter a role name" tabindex="-1" readonly />
                        </div>
                        <div class="col-12 RolePermissions">
                            <h4>Role Permissions</h4>
                            <div class="row" id="permissions-list">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1"
                                onclick="givePermissionToRole()">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>


    {{-- menu modal --}}

    <div class="modal fade" id="assignMenuToRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="role-title">Add New Role</h3>
                        <p>Set Menu To Rule</p>
                    </div>
                    <!-- Add role form -->
                    <form id="assignMenuForm" class="row g-3" onsubmit="return false">@csrf
                        <div class="col-12 mb-4">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="hidden" id="addIdm" name="id">
                            <input type="text" id="addNamem" name="name" class="form-control"
                                placeholder="Enter a role name" tabindex="-1" readonly />
                        </div>
                        <div class="col-12 RolePermissions">
                            <h4>Role Permissions</h4>
                            <div class="row" id="menus-list">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1"
                                onclick="giveMenuToRole()">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End #main -->
@endsection
@section('script')
<script>
    var TableData;
        var url = "{{ route('all.Roles') }}";

        function LoadDataTable() {
            TableData = $('#dataTableItem').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.form_data = $("#fromData").serialize(); // Send form data as POST data
                    }
                },
                columns: [
                    { 
                    data: 'id', 
                    name: 'serial_number', 
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    },
                    orderable: false, 
                    searchable: false
                },
                    { data: 'name' },
                    { data: 'guard_name' },
                    { data: 'created_at' },
                    { data: 'updated_at' },
                    {
                        data: null,
                        orderable: false,
                        defaultContent: "NO Data",
                        render: function(data, type, row) {
                            return `<button type="button" class="btn btn-outline-info btn-sm permission-button" data-id="${row.id}"><i class="bi bi-person-plus-fill"></i></button>
                            <button type="button" class="btn btn-outline-info btn-sm Menu-button" data-id="${row.id}"><i class="bi bi-pencil-fill"></i> Menu</button>
                            <button type="button" class="btn btn-outline-info btn-sm edit-button" data-id="${row.id}"><i class="bi bi-pencil-fill"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm delete-button" data-id="${row.id}"><i class="bi bi-x-circle-fill"></i></button>`;
                        }
                    }
                ],
                // Expandable rows
                rowCallback: function(row, data) {
                    if (data.parent_id) {
                        $(row).addClass('child-row');
                    }
                }
            });

            // Event delegation to handle click events
            $('#dataTableItem').on('click', '.edit-button', function() {
                var id = $(this).data('id');
                showData(id);
            });

            $('#dataTableItem').on('click', '.delete-button', function() {
                var id = $(this).data('id');
                deleteData(id);
            });

            $('#dataTableItem').on('click', '.permission-button', function() {
                var id = $(this).data('id');
                addPermissionToRole(id);
            });
            $('#dataTableItem').on('click', '.Menu-button', function() {
                var id = $(this).data('id');
                addMenuToRole(id);
            });
        }

        $(document).ready(function() {
            LoadDataTable();
        });

        function showData(id) {
            var url = "{{ route('Roles.edit', ':id') }}"; // Use named route with placeholder
            var fullUrl = url.replace(':id', id); // Replace placeholder with actual ID
            window.location.href = fullUrl; // Redirect to the constructed URL
        }

        function addPermissionToRole(id) {
                    $.ajax({
                        url: "{{ url('addpermission') }}/" + id,
                        type: "GET",
                        dataType: "JSON",
                        success: function (data) {
                            console.log(data);
                            $('#addRoleForm')[0].reset();
                            $('.role-title').text('Add Role Permission');
                            $('#addRolePermissionModal').modal('show');
                            $('#addId').val(data.role.id);
                            $('#addName').val(data.role.name);

                            var roleHavePermissionIds = Object.keys(data.roleHavePermission);

                            var permissionGroups = {
                                view: [],
                                create: [],
                                delete: [],
                                update: [],
                                other: []
                            };

                            $.each(data.permissions, function (index, permission) {
                                if (permission.name.includes('view')) {
                                    permissionGroups.view.push(permission);
                                } else if (permission.name.includes('create')) {
                                    permissionGroups.create.push(permission);
                                } else if (permission.name.includes('delete')) {
                                    permissionGroups.delete.push(permission);
                                } else if (permission.name.includes('update')) {
                                    permissionGroups.update.push(permission);
                                } else {
                                    permissionGroups.other.push(permission);
                                }
                            });

                            function generatePermissionColumn(type, permissions) {
                                if (permissions.length === 0) return '';
                                
                                var typeCapitalized = type.charAt(0).toUpperCase() + type.slice(1);
                                var columnHtml = `<div class="col-md-3 permission-group">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <input class="form-check-input select-all-group" type="checkbox" id="selectAll${typeCapitalized}">
                                            <label class="form-check-label fw-bold" for="selectAll${typeCapitalized}"> Select All ${typeCapitalized}</label>
                                        </div>
                                        <button class="btn btn-sm btn-link toggle-section" data-type="${type}">Collapse</button>
                                    </div>
                                    <hr>
                                    <div class="search-box">
                                        <input type="text" class="form-control search-permission" placeholder="Search ${typeCapitalized}...">
                                    </div>
                                    <div class="permission-list" data-type="${type}">`;

                                $.each(permissions, function (index, permission) {
                                    var isChecked = roleHavePermissionIds.includes(permission.id.toString()) ? 'checked' : '';
                                    columnHtml += `<div class="form-check">
                                        <input class="form-check-input permission-checkbox ${type}-checkbox" type="checkbox" name="permission[]" value="${permission.id}" ${isChecked}>
                                        <label class="form-check-label"> ${permission.name}</label>
                                    </div>`;
                                });

                                columnHtml += '</div></div>'; 
                                return columnHtml;
                            }

                            var permissionsHtml = '<div class="row">';
                            
                            Object.keys(permissionGroups).forEach(type => {
                                permissionsHtml += generatePermissionColumn(type, permissionGroups[type]);
                            });

                            permissionsHtml += '</div>';
                            $('#permissions-list').html(permissionsHtml);

                            // Select All Functionality
                            $('.select-all-group').on('change', function () {
                                var type = $(this).attr('id').replace('selectAll', '').toLowerCase();
                                $(`.${type}-checkbox`).prop('checked', $(this).prop('checked')).trigger('change');
                            });

                            // Toggle Sections
                            $('.toggle-section').on('click', function () {
                                var type = $(this).data('type');
                                $(`.permission-list[data-type="${type}"]`).toggle();
                                $(this).text($(this).text() === 'Collapse' ? 'Expand' : 'Collapse');
                            });

                            // Search Permissions
                            $('.search-permission').on('input', function () {
                                var query = $(this).val().toLowerCase();
                                var type = $(this).closest('.permission-group').find('.permission-list').data('type');
                                $(`.${type}-checkbox`).each(function () {
                                    var label = $(this).next('label').text().toLowerCase();
                                    $(this).closest('.form-check').toggle(label.includes(query));
                                });
                            });

                            // Track Checked Permissions
                            $('.permission-checkbox').on('change', function () {
                                var type = $(this).attr('class').match(/(view|create|delete|update|other)-checkbox/)[1];
                                var count = $(`.${type}-checkbox:checked`).length;
                                $(`#selectAll${type.charAt(0).toUpperCase() + type.slice(1)}`).prop('checked', count === $(`.${type}-checkbox`).length);
                                
                                // Show selected count
                                $(`#selectAll${type.charAt(0).toUpperCase() + type.slice(1)}`).next('label').text(` Select All ${type.charAt(0).toUpperCase() + type.slice(1)} (${count} selected)`);
                            });
                        },
                        error: function (xhr) {
                            var errorMessage = xhr.responseJSON?.message || xhr.responseText || "An error occurred";
                            swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500 });
                        }
                    });
                }

// Reset Form
$('#resetPermissionForm').on('click', function () {
    $('#addRoleForm')[0].reset();
    $('.permission-checkbox').prop('checked', false).trigger('change');
});

// Trigger Modal
$('#dataTableItem').on('click', '.permission-button', function () {
    var id = $(this).data('id');
    addPermissionToRole(id);
});



$('#dataTableItem').on('click', '.permission-button', function() {
    var id = $(this).data('id');
    addPermissionToRole(id);
});



        function  deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('Roles') }}" + '/' + id,
                            type: "POST",
                            data: {'_method': 'DELETE', '_token': csrf_token},
                            success: function (data) {
                                console.log(data);
                                var dataResult = JSON.parse(data);
                                if (dataResult.statusCode == 200) {
                                    $('#dataTableItem').DataTable().ajax.reload();
                                    swal({
                                        title: "Delete Done",
                                        text: "Poof! Your data file has been deleted!",
                                        icon: "success",
                                        button: "Done"
                                    });
                                } else {
                                    swal("Error occured !!");
                                }
                            }, error: function (data) {
                                console.log(data);
                                swal({
                                    title: "Opps...",
                                    text: "Error occured !",
                                    icon: "error",
                                    button: 'Ok ',
                                });
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        }

        function givePermissionToRole() {
            const check = new FormData($("#addRolePermissionModal form")[0]);
            console.log(check);
            
            url = "{{ url('GivePermissionToRole') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($("#addRolePermissionModal form")[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    //console.log(data);
                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $('#addRolePermissionModal').modal('hide');
                        $('#dataInfo-dataTable').DataTable().ajax.reload();
                        swal("Success", dataResult.statusMsg);
                        $('#addRolePermissionModal form')[0].reset();
                    }else {
                        swal("Failed", dataResult.statusMsg);

                    }
                }, error: function (xhr, status, error) {
                    var errorMessage = "Error occurred";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                    swal({
                        title: "Oops",
                        text: errorMessage,
                        icon: "error",
                        timer: '1500'
                    });
                }
            });
            return false;
        };

        function addMenuToRole(id) {
        $.ajax({
        url: "{{ url('addmenu') }}/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            console.log(data);

            $('#assignMenuToRole form')[0].reset();
            $('.role-title').text('Assign Menu To Role');
            $('#assignMenuToRole').modal('show');

            $('#addIdm').val(data.role.id);
            $('#addNamem').val(data.role.name);

            function buildMenuTree(menuList) {
                let menusHtml = '<div class="row">';

                $.each(menuList, function (index, menu) {
                    menusHtml += `
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input menu-checkbox" type="checkbox" name="menu_id[]" value="${menu.id}" id="menu_${menu.id}">
                                <label class="form-check-label fw-bold" for="menu_${menu.id}">${menu.title}</label>
                            </div>`;

                    if (menu.submenu.length > 0) {
                        menusHtml += `
                            <div class="ms-4 border-start ps-3 mt-2 submenu-container"> 
                                ${buildMenuTree(menu.submenu)}
                            </div>
                        `;
                    }

                    menusHtml += `</div>`;
                });

                menusHtml += '</div>';
                return menusHtml;
            }

            $('#menus-list').html(buildMenuTree(data.menu));

            $('#menus-list').prepend(`
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="selectAllMenus">
                    <label class="form-check-label fw-bold text-primary" for="selectAllMenus">Select All Menus</label>
                </div>
                <input type="text" id="menuSearch" class="form-control mb-3" placeholder="Search menu...">
                <button id="resetMenus" class="btn btn-warning mb-3">Reset Selection</button>
                <p class="selected-count text-success"></p>
            `);

            $.each(data.menu, function (index, menu) {
                if (menu.menu_exists) {
                    $(`.menu-checkbox[value="${menu.id}"]`).prop('checked', true);
                }

                if (menu.submenu.length > 0) {
                    $.each(menu.submenu, function (subIndex, subMenu) {
                        if (subMenu.menu_exists) {
                            $(`.menu-checkbox[value="${subMenu.id}"]`).prop('checked', true);
                        }
                    });
                }
            });

            $('#selectAllMenus').on('change', function () {
                $('.menu-checkbox').prop('checked', $(this).prop('checked'));
                updateSelectedCount();
            });

            $('.menu-checkbox').on('change', function () {
                if ($('.menu-checkbox:checked').length === $('.menu-checkbox').length) {
                    $('#selectAllMenus').prop('checked', true);
                } else {
                    $('#selectAllMenus').prop('checked', false);
                }
                
                const parentCheckbox = $(this).closest('.submenu-container').prev('.form-check').find('.menu-checkbox');
                if ($(this).is(':checked')) {
                    parentCheckbox.prop('checked', true);
                }
                updateSelectedCount();
            });

            $('#menuSearch').on('keyup', function () {
                const searchValue = $(this).val().toLowerCase();
                $('.menu-checkbox').each(function () {
                    const labelText = $(this).next('label').text().toLowerCase();
                    if (labelText.includes(searchValue)) {
                        $(this).closest('.col-md-6').show();
                    } else {
                        $(this).closest('.col-md-6').hide();
                    }
                });
            });

            $('#resetMenus').on('click', function () {
                $('.menu-checkbox').prop('checked', false);
                $('#selectAllMenus').prop('checked', false);
                updateSelectedCount();
            });

            function updateSelectedCount() {
                const count = $('.menu-checkbox:checked').length;
                $('.selected-count').text(`${count} menus selected`);
            }

            updateSelectedCount();
        },
        error: function (xhr, status, error) {
            var errorMessage = "Error occurred";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                errorMessage = xhr.responseText;
            }
            swal({
                title: "Oops",
                text: errorMessage,
                icon: "error",
                timer: 1500
            });
        }
    });
}

   

            function giveMenuToRole() {
                    var url = "{{ url('GiveMenuToRole') }}";

                    var formData = {
                        role_id: $('#addIdm').val(), 
                        menu_id: [] 
                    };

                    $('#menus-list input[type="checkbox"]:checked').each(function () {
                        formData.menu_id.push($(this).val());
                    });

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            ...formData,
                            _token: $('input[name="_token"]').val() 
                        },
                        dataType: 'json', 
                        success: function (data) {
                            if (data.statusCode == 200) {
                                $('#assignMenuToRole').modal('hide');
                                $('#dataInfo-dataTable').DataTable().ajax.reload();
                                swal("Success", data.statusMsg);
                                $('#assignMenuForm')[0].reset(); // Reset the form
                            } else {
                                swal("Failed", data.statusMsg);
                            }
                        },
                        error: function (xhr, status, error) {
                            var errorMessage = "Error occurred";
                            if (xhr.responseJSON && xhr.responseJSON.statusMsg) {
                                errorMessage = xhr.responseJSON.statusMsg;
                            } else if (xhr.responseText) {
                                errorMessage = xhr.responseText;
                            }
                            swal({
                                title: "Oops",
                                text: errorMessage,
                                icon: "error",
                                timer: 1500
                            });
                        }
                    });
                    return false;
}


   
</script>
@endsection