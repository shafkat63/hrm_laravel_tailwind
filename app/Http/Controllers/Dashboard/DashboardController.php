<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $recentUsers = User::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $stats = [
            'totalUsers' => User::count(),
            'totalRoles' => \Spatie\Permission\Models\Role::count(),
        ];
        return view('Dashboard.dashboard', compact('recentUsers', 'stats'));
    }
}
