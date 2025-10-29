@extends('layout.appmain')

@section('title', 'Dashboard')

@section('mainContent')
<div class="flex flex-col md:flex-row min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100">

    {{-- Sidebar --}}
    {{-- @include('partials.sidebar') --}}

    <div class="flex-1 p-6 backdrop-blur-sm">
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
            <div
                class="bg-white/30 backdrop-blur-lg border border-white/40 shadow-lg rounded-2xl p-6 flex flex-col transition-all hover:scale-[1.02]">
                <span class="text-gray-700 font-medium">Total Users</span>
                <span class="text-3xl font-bold text-gray-900 mt-2" id="totalUsers">{{ $stats['totalUsers'] }}</span>
            </div>

            <div
                class="bg-white/30 backdrop-blur-lg border border-white/40 shadow-lg rounded-2xl p-6 flex flex-col transition-all hover:scale-[1.02]">
                <span class="text-gray-700 font-medium">Active Roles</span>
                <span class="text-3xl font-bold text-gray-900 mt-2" id="totalRoles">{{ $stats['totalRoles'] }}</span>
            </div>

            <div
                class="bg-white/30 backdrop-blur-lg border border-white/40 shadow-lg rounded-2xl p-6 flex flex-col transition-all hover:scale-[1.02]">
                <span class="text-gray-700 font-medium">Branches</span>
                <span class="text-3xl font-bold text-gray-900 mt-2" id="totalBranches">3</span>
            </div>

            <div
                class="bg-white/30 backdrop-blur-lg border border-white/40 shadow-lg rounded-2xl p-6 flex flex-col transition-all hover:scale-[1.02]">
                <span class="text-gray-700 font-medium">Pending Tasks</span>
                <span class="text-3xl font-bold text-gray-900 mt-2">7</span>
            </div>
        </div>

        {{-- Recent Users Table --}}
        <div
            class="bg-white/40 backdrop-blur-md border border-white/50 shadow-lg rounded-2xl p-6 transition-all hover:shadow-xl">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Recent Users</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="recentUsersTable">
                    <thead class="bg-white/40">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Roles</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white/30">
                        @foreach($recentUsers as $index => $user)
                        <tr>
                            <td class="px-6 py-4 text-gray-800">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @foreach($user->getRoleNames() as $roleName)
                                @php
                                // Map role name to color badge
                                $roleColor = match($roleName) {
                                'Admin' => 'green',
                                'Employee' => 'blue',
                                'HR' => 'yellow',
                                'Manager' => 'purple',
                                default => 'gray',
                                };
                                @endphp
                                <span
                                    class="bg-{{ $roleColor }}-100/70 text-{{ $roleColor }}-800 px-2 py-1 rounded-lg text-sm">{{
                                    $roleName }}</span>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    console.log('Dashboard loaded with dynamic recent users.');
</script>
@endsection