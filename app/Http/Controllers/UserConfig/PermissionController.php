<?php

namespace App\Http\Controllers\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\WebSetup\SidebarNav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_permission', ['only' => ['create']]);
        $this->middleware('permission:view_permission', ['only' => ['index']]);
        $this->middleware('permission:update_permission', ['only' => ['edit']]);
        $this->middleware('permission:delete_permission', ['only' => ['destroy']]);
    }

    public function index()
    {
        // $this->checkLogin();
        return view('UserConfig.permission.showPermission');
    }

    public function create()
    {
        // $this->checkLogin();
        return view('UserConfig.permission.createPermission');
    }

    public function edit($id)
    {
        $this->checkLogin();
        $rowItem = Permission::where('id', $id)->first();
        return view('UserConfig.permission.editPermission', ['rowItem' => $rowItem]);
    }




    public function store(Request $request)
    {
        try {
            if (empty($request->id)) {
                $baseName = strtolower($request->name);
                if ($request->type != "Single") {
                    $permissions = [
                        "view_{$baseName}",
                        "create_{$baseName}",
                        "update_{$baseName}",
                        "delete_{$baseName}"
                    ];

                    foreach ($permissions as $permission) {
                        Permission::create(['name' => $permission]);
                    }

                    return response()->json([
                        "statusCode" => 200,
                        "statusMsg" => "Permissions Added Successfully"
                    ]);
                } else {
                    Permission::create([
                        'name' => $baseName
                    ]);


                    return response()->json([
                        "statusCode" => 200,
                        "statusMsg" => "Permissions Added Successfully"
                    ]);
                }
            } else {
                $id = $request->id;
                $permission = Permission::findById($id);
                $permission->update(['name' => strtolower($request->name)]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Permission Updated Successfully"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {
            $singleDataShow = DB::table('permissions')->where('id', $id)->get();
            //$singleDataShow = Permission::findById($id)->get();
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
            $permission = Permission::findById($id);
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
        $baseQuery = DB::table('permissions')
            ->select('id', 'name', 'guard_name', 'created_at', 'updated_at');

        $totalCount = $baseQuery->count();

        if (!empty($request->search['value'])) {
            $search = $request->search['value'];
            $baseQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('guard_name', 'like', "%{$search}%");
            });
        }

        $filteredCount = $baseQuery->count();

        if (!empty($request->order)) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderDirection = $request->order[0]['dir'];
            $orderColumn = $request->columns[$orderColumnIndex]['data'];
            $baseQuery->orderBy($orderColumn, $orderDirection);
        } else {
            $baseQuery->orderBy('id', 'desc');
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $data = $baseQuery->skip($start)->take($length)->get();

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ]);
    }
}
