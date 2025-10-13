@extends('layout.appmain')
@section('title', '- New Sidebar Nav')


<style>
    /* Custom file input label style */
.custom-file-label {
    display: inline-block;
    cursor: pointer;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.custom-file-label:hover {
    background-color: #0056b3;
}

/* Custom file input for modern browsers */
.custom-file-input {
    display: none;
}

/* Image preview container */
.preview-container img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 5px;
}

/* Image preview container when no image is selected */
.preview-container {
    display: none;
}

</style>
@section('main')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add User Info</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item">User Config</li>
                <li class="breadcrumb-item active">Side Menu</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-body" id="addFrom">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="card-title">Add User Info</h5>
                        </div>
                        <div class="col-md-2 mt-3 ">
                            <a href="{{route('User.index')}}" type="button"
                                class="btn btn-outline-info btn-sm text-right"> Back <i
                                    class="bi bi-arrow-left-short"></i></a>
                        </div>
                    </div>

                    <!-- Multi Columns Form -->
                    <form class="row g-3">@csrf

                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="col-md-6">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" class="custom-file-input" id="photo" name="photo"
                                accept=".jpg, .jpeg, .png , .webp" required onchange="previewImage(event)">
                            <label class="custom-file-label" for="photo">
                                <i class="fas fa-upload"></i> Choose Photo
                            </label>
                            <div class="preview-container" id="photo-preview-container">
                                <img id="photo-preview" alt="Photo Preview">
                            </div>

                            <div class="invalid-feedback">Please select a Employee Photo.</div>

                        </div>


                        <div class="col-md-4">
                            <label for="status" class="form-label">Roles</label>
                            <select class="form-control" id="roles" name="roles">
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select" name="status">
                                <option selected value="">Select Status</option>
                                <option value="A">Active</option>
                                <option value="I">InActive</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="text-center">
                            <button type="button" onclick="addData()" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <!-- End Multi Columns Form -->

                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
@endsection
@section('script')
<script>
    function previewImage(event) {
        const file = event.target.files[0]; 
        const preview = document.getElementById('photo-preview'); 
        const previewContainer = document.getElementById('photo-preview-container'); 

        if (file) {
            const reader = new FileReader(); 
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block'; 
            };
            reader.readAsDataURL(file); 
        } else {
            preview.src = ''; // Reset the image source
            previewContainer.style.display = 'none'; // Hide the preview container
        }
    }


        $.ajax({
            url: "{{ url('GetRoles') }}",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data.statusCode && data.statusCode === 400) {
                    swal({
                        text: data.statusMsg || "Roles Not Found",
                        timer: '1500'
                    });
                } else {
                    var selectRoles = $('#roles');
                    selectRoles.empty();
                    selectRoles.append('<option value="">Select Role</option>'); // Add default option
                    data.forEach(function(role) {
                        selectRoles.append('<option value="' + role.name + '">' + role.name + '</option>');
                    });
                }
            },
            error: function () {
                // Handle AJAX request error
                swal({
                    text: "Error occurred while fetching roles",
                    timer: '1500'
                });
            }
        });


        function addData() {
            url = "{{ url('User') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($("#addFrom form")[0]),
                contentType: false,
                processData: false,
                beforeSend: function() {
                swal("Submitting...", { button: false });
            },
                success: function (data) {
                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        swal("Success", dataResult.statusMsg);
                        $('#addFrom form')[0].reset();
                    }else if (dataResult.statusCode == 204) {
                        showErrors(dataResult.errors);
                    }else{
                        swal({
                            title: "Oops",
                            text: dataResult.statusMsg,
                            icon: "error",
                            timer: '1500'
                        });

                    }
                }, error: function (data) {
                    console.log(data);
                    swal({
                        title: "Oops",
                        text: "Error occured",
                        icon: "error",
                        timer: '1500'
                    });
                }
            });
            return false;
        };
</script>
@endsection