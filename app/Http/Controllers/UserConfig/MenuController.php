<?php

namespace App\Http\Controllers\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\menu\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function __construct()
    {
        $type = 'menu';
        $this->middleware('permission:delete_' . $type, ['only' => ['destroy']]);
        $this->middleware('permission:view_' . $type, ['only' => ['index']]);
        $this->middleware('permission:update_' . $type, ['only' => ['show', 'store']]);
        $this->middleware('permission:create_' . $type, ['only' => ['create', 'store']]);
    }




    public function getMenuByRole($roleId)
    {
        // Get all menus assigned to the role

        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        $roleId = $user->roles->first()->id ?? null;

        if (!$roleId) {
            abort(403, 'No role assigned');
        }

        $menus = MenuModel::whereIn('id', function ($query) use ($roleId) {
            $query->select('menu')
                ->from('menu_assign')
                ->where('role_id', $roleId);
        })
            ->orderByRaw("CASE WHEN parent_id IS NULL OR parent_id = '#' THEN 0 ELSE 1 END") // Root menus first
            ->orderBy('id', 'asc') // Maintain sequential order
            ->get();

        // Prepare a lookup array for menu items
        $menuMap = [];
        $formattedMenu = [];

        // First, group all menus by their ID for easy lookup
        foreach ($menus as $menu) {
            $menuMap[$menu->id] = [
                'id' => $menu->id,
                'parent_id' => $menu->parent_id,
                'title' => $menu->title,
                'desc' => $menu->desc,
                'url' => $menu->url,
                'icon' => $menu->icon,
                'submenu' => [],
            ];
        }

        // Now, nest submenus under their respective parent
        foreach ($menuMap as $id => &$menu) {
            if (!empty($menu['parent_id']) && isset($menuMap[$menu['parent_id']])) {
                // If the menu has a parent, add it as a submenu
                $menuMap[$menu['parent_id']]['submenu'][] = &$menu;
            } else {
                // Otherwise, it's a top-level menu
                $formattedMenu[] = &$menu;
            }
        }

        return view("layout.test", ['formattedMenu' => $formattedMenu]);
    }


    public function index()
    {
        return view("admin.menu.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'parent_id' => 'nullable',
                'title' => 'required|string|max:255',
                'icon' => 'nullable|string|max:255',
                'url' => 'nullable|string|',
                'status' => 'required',
            ]);

            if ($request['id'] == !null) {
                $menu = DB::table('menu')->where('id', $request['id'])->first();

                if (!$menu) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Menu not found"
                    ], 404);
                }

                // Perform the update
                DB::table('menu')
                    ->where('id', $request['id'])
                    ->update([
                        'parent_id' => $validatedData['parent_id'] ? $validatedData['parent_id'] : '#',
                        'title' => $validatedData['title'],
                        'icon' => $validatedData['icon'] ? $validatedData['icon'] : '#',
                        'url' => $validatedData['url'] ? $validatedData['url'] : '#',
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Menu details updated successfully"
                ], 200);
            } else {
                $MenuModel = new MenuModel();
                $MenuModel->parent_id = $validatedData['parent_id'] ? $validatedData['parent_id'] : '#';
                $MenuModel->title = $validatedData['title'];
                $MenuModel->icon = $validatedData['icon'] ? $validatedData['icon'] : '#';
                $MenuModel->url = $validatedData['url'] ? $validatedData['url'] : '#';
                $MenuModel->status = $validatedData['status'];
                $MenuModel->create_by = auth()->id();
                $MenuModel->create_date = now();
                $MenuModel->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Menu added successfully!',
                    'data' => $MenuModel,
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "statusCode" => 422,
                "statusMsg" => $e->getMessage(),
                "errors" => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'statusCode' => 500,
                'statusMsg' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $menu = DB::table('menu')->where('id', $id)->first();
            if (!$menu) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Menu not found"
                ], 404);
            }
            return response()->json($menu, 200);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $MenuModel = MenuModel::findOrFail($id);

            $MenuModel->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Menu record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Menu record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }


    public function getMenuData()
    {
        $rawData = DB::select("SELECT id,parent_id,title,icon,url,status
        FROM menu;");

        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm"> <i class="bx bx-edit-alt"></i>
</a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }


    public function getParentMenus()
{
    try {
        // Fetch menus where parent_id is '#', meaning no parent
        $menus = DB::table('menu')
            ->select('id', 'title')
            ->where('parent_id', '#')
            ->get();

        return response()->json([
            'statusCode' => 200,
            'data' => $menus,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'statusCode' => 500,
            'statusMsg' => 'Failed to fetch parent menus',
            'error' => $e->getMessage(),
        ]);
    }
}

}
