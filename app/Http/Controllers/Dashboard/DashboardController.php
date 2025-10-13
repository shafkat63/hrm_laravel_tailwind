<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        // Dummy data for now
        $stats = [
            'totalUsers' => 12,
            'totalRoles' => 5,
            'totalBranches' => 3,
            'pendingTasks' => 7,
        ];

        $recentUsers = [
            ['id' => 1, 'name' => 'Muhtasir Shafkat', 'email' => 'muhtasir@example.com', 'phone' => '+880123456789', 'role' => 'Admin'],
            ['id' => 2, 'name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '+880987654321', 'role' => 'Employee'],
            ['id' => 3, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone' => '+880112233445', 'role' => 'HR'],
            ['id' => 4, 'name' => 'Ali Ahmed', 'email' => 'ali@example.com', 'phone' => '+880556677889', 'role' => 'Manager'],
        ];

        return view('Dashboard.dashboard', compact('stats', 'recentUsers'));
    }
}
