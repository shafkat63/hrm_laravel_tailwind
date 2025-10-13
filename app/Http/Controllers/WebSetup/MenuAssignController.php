<?php

namespace App\Http\Controllers\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\menu\MenuAssign;
use App\Models\WebSetup\SidebarNav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class MenuAssignController extends Controller
{


    public function getAssignedMenus($menuRole)
    {
        $assignedMenus = MenuAssign::where('role', $menuRole)->pluck('menu_id')->toArray();
        return response()->json(['menu_ids' => $assignedMenus]);
    }
    public function index()
    {
        return "Menu Assign";
    }
    public function create()
    {
        $roles = Role::all();
        $menu = SidebarNav::all();

        return view('WebSetup.menuassign.create', [
            'roles' => $roles,
            'menu' => $menu,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'menu_role' => 'required|exists:roles,id',
            'menu_id' => 'required|array',
        ]);

        foreach ($request->menu_id as $menuId) {
            MenuAssign::create([
                'role' => $request->menu_role,
                'menu_id' => $menuId,
                'status' => 'A',
                'create_by' => auth()->id(),
                'create_date' => now(),
            ]);
        }

        return response()->json([
            'statusCode' => 200,
            'statusMsg' => 'Menu Assign created successfully',
        ]);
    }
}
