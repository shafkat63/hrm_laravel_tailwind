<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Make sure User model is imported
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data from database
        $totalUsers = User::count(); // counts total users
        $totalRoles = Role::count(); // if you're using Spatie roles


        // Recent users (latest 5)
        $recentUsers = User::with('roles') 
            ->latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'phone']); 

        $stats = [
            'totalUsers' => $totalUsers,
            'totalRoles' => $totalRoles,
           
        ];

        return view('Dashboard.dashboard', compact('stats', 'recentUsers'));
    }
}
