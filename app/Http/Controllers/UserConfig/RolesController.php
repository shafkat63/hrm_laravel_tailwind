<?php

namespace App\Http\Controllers\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\WebSetup\SidebarNav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:create_roles', ['only' => ['create']]);
    //     $this->middleware('permission:view_roles', ['only' => ['index']]);
    //     $this->middleware('permission:update_roles', ['only' => ['edit']]);
    //     $this->middleware('permission:delete_roles', ['only' => ['destroy']]);
    // }
    public function index()
    {
        // $this->checkLogin();
        return view('UserConfig.role.showRole');
    }

    public function create()
    {
        // $this->checkLogin();
        return view('UserConfig.role.createRole');
    }

    public function edit($id)
    {
        // $this->checkLogin();
        $rowItem = Role::where('id', $id)->first();
        return view('UserConfig.role.editRole', ['rowItem' => $rowItem]);
    }

    public function store(Request $request)
    {
        try {
            if ($request['id'] == "") {

                Role::create([
                    'name' => $request->name
                ]);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ));
            } else {
                $id = $request['id'];
                $permission = Role::findById($id);
                $permission->update([
                    'name' => $request->name
                ]);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Update Successfully"
                ));
            }
        } catch (\Exception $e) {
            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }

    public function GivePermissionToRole(Request $request)
    {
        try {
            if (!empty($request['id'])) {
                $role = Role::findOrFail($request['id']);

                $validPermissions = Permission::whereIn('id', $request->permission)
                    ->where('guard_name', 'web') // Ensure guard matches
                    ->pluck('id')->toArray();

                $invalidPermissions = array_diff($request->permission, $validPermissions);

                if (!empty($invalidPermissions)) {
                    return json_encode([
                        "statusCode" => 400,
                        "statusMsg" => "Invalid permission IDs: " . implode(', ', $invalidPermissions)
                    ]);
                }

                $role->syncPermissions($validPermissions);

                return json_encode([
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ]);
            } else {
                return json_encode([
                    "statusCode" => 201,
                    "statusMsg" => "Failed To Give Permission To Role"
                ]);
            }
        } catch (\Exception $e) {
            return json_encode([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {
            $singleDataShow = DB::table('roles')->where('id', $id)->get();

            //$singleDataShow = Role::findById($id)->get();
            return $singleDataShow;
        } catch (\Exception $e) {
            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }

    public function destroy($id)
    {
        try {
            $permission = Role::findById($id);
            $permission->delete();
            return json_encode(array(
                "statusCode" => 200
            ));
        } catch (\Exception $e) {

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }
    public function getData(Request $request)
    {
        $query = DB::table('roles')
            ->select('id', 'name', 'guard_name', 'created_at', 'updated_at')
            ->where('name', '!=', 'Root');

        // Search
        if (isset($request->search['value']) && $request->search['value'] != '') {
            $query->where('name', 'like', '%' . $request->search['value'] . '%');
        }

        // Ordering
        if ($request->has('order') && !empty($request->order)) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderDir = $request->order[0]['dir'];
            $orderColumn = $request->columns[$orderColumnIndex]['data'];
            $query->orderBy($orderColumn, $orderDir);
        }

        $totalCount = DB::table('roles')->where('name', '!=', 'Root')->count();
        $filteredCount = $query->count();

        $data = $query->skip($request->input('start', 0))
            ->take($request->input('length', 10))
            ->get();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ]);
    }


    // public function getData(Request $request)
    // {
    //     $singleDataShow = Role::where('name', '!=', 'Root')->get();

    //     $query = DB::table('roles')
    //         ->select('id', 'name', 'guard_name', 'created_at', 'updated_at');
    //     //  ->where('name', '!=', 'Root');

    //     if (isset($request->search['value'])) {
    //         $query->where('name', 'like', '%' . $request->search['value'] . '%');
    //     }

    //     // Ordering
    //     if ($request->has('order')) {
    //         $query->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);
    //     }

    //     // Pagination
    //     $totalCount = $query->count();
    //     $filteredCount = $query->count();

    //     $data = $query->skip($request->input('start', 0))
    //         ->take($request->input('length', 10))
    //         ->get();

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalCount,
    //         'recordsFiltered' => $filteredCount,
    //         'data' => $data,
    //     ]);
    // }
    public function getRoleData()
    {

        $rawData = DB::select("SELECT id,name,guard_name,created_at,updated_at
        FROM roles;");

        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttton = '
                <div class="button-list">
                    <a onclick="addMenuToRole(' . $rawData->id . ')" role="button" href="#" class="btn btn-warning btn-sm">Add Menu</a>
                    <a onclick="addPermissionToRole(' . $rawData->id . ')" role="button" href="#" class="btn btn-info btn-sm">Add Permission</a>
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">Edit</a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function addPermissionToRole($id)
    {
        $permission = Permission::get();
        $role = Role::findOrFail($id);
        $roleHavePermission = DB::table("role_has_permissions")
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return [
            'role' => $role,
            'permissions' => $permission,
            'roleHavePermission' => $roleHavePermission
        ];
    }


    public function addMenuToRole($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        // Fetch all menus and check if they are assigned to the role
        $menus = DB::table('menu as m')
            ->leftJoin('menu_assign as ma', function ($join) use ($id) {
                $join->on('m.id', '=', 'ma.menu')
                    ->where('ma.role_id', '=', $id);
            })
            ->select('m.id', 'm.title', 'm.parent_id', DB::raw('CASE WHEN ma.id IS NOT NULL THEN 1 ELSE 0 END AS menu_exists'))
            ->orderByRaw("CASE WHEN m.parent_id IS NULL OR m.parent_id = '#' THEN 0 ELSE 1 END")
            ->orderBy('m.id', 'asc')
            ->get();

        // Prepare hierarchical menu
        $menuMap = [];
        $formattedMenus = [];

        // Normalize parent_id and prepare mapping
        foreach ($menus as $menu) {
            $parentId = ($menu->parent_id === '#' || $menu->parent_id === null) ? null : $menu->parent_id;

            $menuMap[$menu->id] = [
                'id' => $menu->id,
                'parent_id' => $parentId,
                'title' => $menu->title,
                'menu_exists' => (bool) $menu->menu_exists,
                'submenu' => []
            ];
        }

        // Assign submenus under respective parents
        foreach ($menuMap as $id => &$menu) {
            if ($menu['parent_id'] !== null && isset($menuMap[$menu['parent_id']])) {
                $menuMap[$menu['parent_id']]['submenu'][] = &$menu;
            } else {
                $formattedMenus[] = &$menu; // Top-level menus
            }
        }

        return response()->json([
            'role' => $role,
            'menu' => $formattedMenus
        ]);
    }

    public function GiveMenuToRole(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'role_id' => 'required|exists:roles,id',
                'menu_id' => 'array',
                // 'menu_id.*' => 'exists:menu,id'
            ]);

            // Get role ID and menu IDs from the request
            $roleId = $request->input('role_id');
            $menuIds = $request->input('menu_id', []); // Default to empty array if no menu selected

            // Delete existing menu assignments for the role
            DB::table('menu_assign')->where('role_id', $roleId)->delete();

            // Insert new menu assignments
            foreach ($menuIds as $menuId) {
                DB::table('menu_assign')->insert([
                    'menu' => $menuId,
                    'role_id' => $roleId,
                    'status' => 1, // You can adjust the status as needed
                    'create_by' => auth()->user()->id,
                    'create_date' => now(),
                    'update_by' => null,
                    'update_date' => null
                ]);
            }

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Menus assigned to role successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ]);
        }
    }
}
