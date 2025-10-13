@extends('layout.appmain')

@section('title', 'Dashboard')

@section('mainContent')
<div class="flex flex-col md:flex-row min-h-screen">

    {{-- Sidebar --}}
    {{-- @include('partials.sidebar') Use your sidebar component --}}

    <div class="flex-1 bg-gray-100 p-6">
        {{-- Top header --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 font-medium">Super Admin</span>
                <a href="/logout"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all">Logout</a>
            </div>
        </div>

        {{-- Stats cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                <span class="text-gray-500">Total Users</span>
                <span class="text-2xl font-bold text-gray-800" id="totalUsers">12</span>
            </div>
            <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                <span class="text-gray-500">Active Roles</span>
                <span class="text-2xl font-bold text-gray-800" id="totalRoles">5</span>
            </div>
            <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                <span class="text-gray-500">Branches</span>
                <span class="text-2xl font-bold text-gray-800" id="totalBranches">3</span>
            </div>
            <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                <span class="text-gray-500">Pending Tasks</span>
                <span class="text-2xl font-bold text-gray-800">7</span>
            </div>
        </div>

        {{-- Recent Users Table --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="recentUsersTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Roles</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Dummy data --}}
                        <tr>
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">Muhtasir Shafkat</td>
                            <td class="px-6 py-4">muhtasir@example.com</td>
                            <td class="px-6 py-4">+880123456789</td>
                            <td class="px-6 py-4"><span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded">Admin</span></td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">2</td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">john@example.com</td>
                            <td class="px-6 py-4">+880987654321</td>
                            <td class="px-6 py-4"><span
                                    class="bg-blue-100 text-blue-800 px-2 py-1 rounded">Employee</span></td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">3</td>
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">jane@example.com</td>
                            <td class="px-6 py-4">+880112233445</td>
                            <td class="px-6 py-4"><span
                                    class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">HR</span></td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">4</td>
                            <td class="px-6 py-4">Ali Ahmed</td>
                            <td class="px-6 py-4">ali@example.com</td>
                            <td class="px-6 py-4">+880556677889</td>
                            <td class="px-6 py-4"><span
                                    class="bg-purple-100 text-purple-800 px-2 py-1 rounded">Manager</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // You can later replace this with AJAX calls
    console.log('Dashboard loaded with dummy data');
</script>
@endsection