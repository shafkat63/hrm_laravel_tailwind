@extends('layout.appmain')
@section('title', '- Edit User')

@section('main')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit User Info</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">User Config</li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="card-title">Edit User Info</h5>
                        </div>
                        <div class="col-md-2 mt-3">
                            <a href="{{ route('User.index') }}" class="btn btn-outline-info btn-sm"> Back <i
                                    class="bi bi-arrow-left-short"></i></a>
                        </div>
                    </div>

                    <form id="editUserForm" class="row g-3">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $rowItem->id }}">

                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $rowItem->name) }}">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $rowItem->email) }}">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone"
                                value="{{ old('phone', $rowItem->phone) }}">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="roles" class="form-label">Roles</label>
                            <select class="form-control" id="roles" multiple name="roles[]">
                                <option value="">Select Role</option>
                            </select>

                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="text-center">
                            <button type="button" onclick="submitForm()" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        loadRoles();
    });

    function loadRoles() {
        $.ajax({
            url: "{{ url('GetRoles') }}",
            type: "GET",
            dataType: "JSON",
            // beforeSend: function() {
            //     swal("Submitting...", { button: false });
            // },
            success: function(data) {
                const selectRoles = $('#roles');
                selectRoles.empty().append('<option value="">Select Role</option>');
                data.forEach(role => {
                    const isSelected = role.name == "{{ $rowItem->name }}" ? 'selected' : '';
                    selectRoles.append(`<option value="${role.name}" ${isSelected}>${role.name}</option>`);
                });
            },
            error: function() {
                swal({ text: "Error occurred while fetching roles", timer: '1500' });
            }
        });
    }




//     function loadRoles() {
//     const selectRoles = $('#roles');
//     selectRoles.html('<option>Loading...</option>'); // Show loading indicator

//     $.ajax({
//         url: "{{ url('GetRoles') }}",
//         type: "GET",
//         dataType: "JSON",
//         success: function(data) {
//             selectRoles.empty().append('<option value="">Select Role</option>');
//             const oldValue = "{{ old('roles', $rowItem->role_id) }}";

//             data.forEach(role => {
//                 const isSelected = role.id == oldValue ? 'selected' : '';
//                 selectRoles.append(`<option value="${role.id}" ${isSelected}>${role.name}</option>`);
//             });
//         },
//         error: function() {
//             selectRoles.html('<option value="">Error loading roles</option>');
//             swal({ text: "Error occurred while fetching roles", timer: 1500 });
//         }
//     });
// }


    function submitForm() {
        const formData = new FormData(document.getElementById("editUserForm"));
        $.ajax({
            url: "{{ url('User') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                swal("Submitting...", { button: false });
            },
            success: function(data) {
                const dataResult = JSON.parse(data);
                if (dataResult.statusCode === 200) {
                    swal("Success", dataResult.statusMsg, "success").then(() => {
                        window.location.href = "{{ url('User') }}";
                    });
                } else if (dataResult.statusCode === 204) {
                    showValidationErrors(dataResult.errors);
                } else {
                    swal("Oops", dataResult.statusMsg, "error");
                }
            },
            error: function() {
                swal("Oops", "Error occurred", "error");
            }
        });
    }

    function showValidationErrors(errors) {
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
        
        $.each(errors, function(field, messages) {
            const input = $(`#${field}`);
            input.addClass('is-invalid');
            input.next('.invalid-feedback').text(messages[0]);
        });
    }
</script>
@endsection