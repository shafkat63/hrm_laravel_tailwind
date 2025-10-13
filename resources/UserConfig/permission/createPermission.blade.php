@extends('layout.appmain')
@section('title', '- New Permissions')

@section('main')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Branch Info</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item">User Config</li>
                <li class="breadcrumb-item active">Permissions</li>
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
                            <h5 class="card-title">Add Permissions</h5>
                        </div>
                        <div class="col-md-2 mt-3 ">
                            <a href="{{route('Permission.index')}}" type="button"
                                class="btn btn-outline-info btn-sm text-right"> Back <i
                                    class="bi bi-arrow-left-short"></i></a>
                        </div>
                    </div>

                    <!-- Multi Columns Form -->
                    <form id="addForm" class="row g-3">@csrf
                        <div class="col-md-9">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-3 mb-1">
                            <label class="form-label" for="type">Select Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="Single">Single</option>
                                <option value="Multiple">Multiple</option>
                            </select>
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

// function addData() {
//             url = "{{ url('Permission') }}";
//             $.ajax({
//                 url: url,
//                 type: "POST",
//                 data: new FormData($("#addFrom form")[0]),
//                 contentType: false,
//                 processData: false,
//                 success: function (data) {
//                     var dataResult = JSON.parse(data);
//                     if (dataResult.statusCode == 200) {
//                         swal("Success", dataResult.statusMsg);
//                         $('#addFrom form')[0].reset();
//                     }else if (dataResult.statusCode == 204) {
//                         showErrors(dataResult.errors);
//                     }else{
//                         swal({
//                             title: "Oops",
//                             text: dataResult.statusMsg,
//                             icon: "error",
//                             timer: '1500'
//                         });

//                     }
//                 }, error: function (data) {
//                     console.log(data);
//                     swal({
//                         title: "Oops",
//                         text: "Error occured",
//                         icon: "error",
//                         timer: '1500'
//                     });
//                 }
//             });
//             return false;
//         };




function addData() {
  var  url = "{{ url('Permission') }}";

    $.ajax({
        url: url,
        type: "POST",
        data: new FormData($("#addForm")[0]),
        contentType: false,
        processData: false,
        dataType: 'json', // Automatically parse JSON response
        success: function (dataResult) {
            if (dataResult.statusCode === 200) {
                swal("Success", dataResult.statusMsg, "success");
                $('#addForm')[0].reset();
            } else if (dataResult.statusCode === 204) {
                showErrors(dataResult.errors);
            } else if (dataResult.statusCode === 409) {
                swal("Warning", dataResult.statusMsg, "warning");
            } else if (dataResult.statusCode === 404) {
                swal("Error", "Permission not found", "error");
            } else {
                swal("Oops", dataResult.statusMsg, "error");
            }
        },
        error: function (xhr) {
            console.log(xhr);
            swal("Oops", "An error occurred. Please try again.", "error");
        }
    });

    return false;
}

</script>
@endsection