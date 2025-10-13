@extends('layout.appmain')
@section('title', '- User Profile')

@section('main')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>User Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item">User Config</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mt-4 mb-4">
                            <!-- User Photo -->
                            <!-- Profile Image, Default to 'profile-img.jpg' if no photo is found -->
                            <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/img/profile-img.jpg') }}" 
                                 alt="Profile" 
                                 class="rounded-circle"
                                 style="height: 150px; width: 150px; object-fit: cover; border: 2px solid #ddd;">

                            <h4 class="mt-3">{{ auth()->user()->name }}</h4>
                            <p class="text-muted">{{ auth()->user()->email }}</p>
                        </div>

                        <!-- User Details -->
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th>Full Name</th>
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ auth()->user()->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ auth()->user()->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-{{ auth()->user()->status == 'A' ? 'success' : 'danger' }}">
                                            {{ auth()->user()->status == 'A' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email Verified</th>
                                    <td>
                                        {{ auth()->user()->email_verified_at ? auth()->user()->email_verified_at->format('d M Y, h:i A') : 'Not Verified' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Latitude</th>
                                    <td>{{ auth()->user()->latitude ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Longitude</th>
                                    <td>{{ auth()->user()->longitude ?? 'N/A' }}</td>
                                </tr>
                                {{-- <tr>
                                    <th>Created At</th>
                                    <td>{{ auth()->user()->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ auth()->user()->updated_at->format('d M Y, h:i A') }}</td>
                                </tr> --}}
                            </tbody>
                        </table>

                        <!-- Back Button -->
                        <div class="text-center mt-4">
                            <a href="{{ route('Dashboard') }}" class="btn btn-outline-info btn-sm">
                                Back <i class="bi bi-arrow-left-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
@endsection

@section('script')

@endsection
    