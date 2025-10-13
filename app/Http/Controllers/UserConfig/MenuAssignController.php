<?php

namespace App\Http\Controllers\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\menu\MenuAssign;
use App\Models\menu\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuAssignController extends Controller
{

    public function getMenus()
    {
        $MenuModel = MenuModel::select('id', 'title')->get();
        return response()->json($MenuModel);
    }

    public function getRoles()
    {
        $roles = DB::table('roles')->select('id', 'name')->get(); // Adjust table name if needed
        return response()->json($roles);
    }

    public function addRoleToMenu($id) {}
    public function index()
    {

        return view("admin.menuassign.index");
    }
    // public function store(Request $request)
    // {

    //     try {
    //         $validatedData = $request->validate([
    //             'menu_id' => 'required|string|max:255',
    //             'menu_id' => 'required|string|max:255',
    //         ]);

    //         if ($request['id'] == !null) {
    //             $MenuAssign = DB::table('menu_assign')->where('id', $request['id'])->first();

    //             if (!$MenuAssign) {
    //                 return response()->json([
    //                     "statusCode" => 404,
    //                     "statusMsg" => "menu assign not found"
    //                 ], 404);
    //             }

    //             DB::table('menu_assign')
    //                 ->where('id', $request['id'])
    //                 ->update([
    //                     'menu' => $validatedData['name'],
    //                     'status' => 'A',
    //                     'update_by' => auth()->user()->id,
    //                     'update_date' => now()
    //                 ]);

    //             return response()->json([
    //                 "statusCode" => 200,
    //                 "statusMsg" => "Menu assign updated successfully"
    //             ], 200);
    //         } else {
    //             $MenuAssign = new MenuAssign();
    //             $MenuAssign->menu = $validatedData['name'];

    //             $MenuAssign->status = 'A';
    //             $MenuAssign->create_by = auth()->id();
    //             $MenuAssign->create_date = now();
    //             $MenuAssign->save();

    //             return response()->json([
    //                 'statusCode' => 200,
    //                 'statusMsg' => 'Menu Assign added successfully!',
    //                 'data' => $MenuAssign,
    //             ]);
    //         }
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json([
    //             "statusCode" => 422,
    //             "statusMsg" => $e->getMessage(),
    //             "errors" => $e->errors()
    //         ], 422);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'statusCode' => 500,
    //             'statusMsg' => 'An error occurred: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }



    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'menu_id' => 'required|array|min:1',
                'menu_id.*' => 'integer|exists:menu,id',
                'role_id' => 'required|array|min:1',
                'role_id.*' => 'integer|exists:roles,id',
            ]);
    
            if ($request->has('id') && !empty($request->id)) {
                $menuAssign = DB::table('menu_assign')->where('id', $request->id)->first();
    
                if (!$menuAssign) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Menu assignment not found"
                    ], 404);
                }
    
                DB::table('menu_assign')->where('id', $request->id)->delete();
    
                // Re-insert the updated data
                foreach ($validatedData['menu_id'] as $menuId) {
                    foreach ($validatedData['role_id'] as $roleId) {
                        DB::table('menu_assign')->insert([
                            'menu' => $menuId,
                            'role_id' => $roleId,
                            'status' => 'A',
                            'create_by' => $menuAssign->create_by, 
                            'create_date' => $menuAssign->create_date, 
                            'update_by' => auth()->id(),
                            'update_date' => now(),
                        ]);
                    }
                }
    
                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Menu assignment updated successfully"
                ], 200);
    
            } else {
                // Insert new data
                foreach ($validatedData['menu_id'] as $menuId) {
                    foreach ($validatedData['role_id'] as $roleId) {
                        DB::table('menu_assign')->insert([
                            'menu' => $menuId,
                            'role_id' => $roleId,
                            'status' => 'A',
                            'create_by' => auth()->id(),
                            'create_date' => now(),
                            'update_by' => null,
                            'update_date' => null,
                        ]);
                    }
                }
    
                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Menu assignment added successfully!',
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
    


    public function show($id)
    {
        try {
            $menu_assign = DB::table('menu_assign')->where('id', $id)->first();
            if (!$menu_assign) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "menu_assign not found"
                ], 404);
            }
            return response()->json($menu_assign, 200);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function destroy($id)
    {
        try {
            $MenuAssign = MenuAssign::findOrFail($id);

            $MenuAssign->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Menu Assign record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Menu Assign record not found."
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
        $rawData = DB::select("SELECT id,menu,role_id,status
        FROM menu_assign;");

        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttton = '
                <div class="button-list">
                    <a onclick="addRoleToMenu(' . $rawData->id . ')" role="button" href="#" class="btn btn-info btn-sm">Add Role</a>
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">Edit</a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}